<?php

namespace App\Http\Controllers\Admin\Genres;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Genres\StoreRequest;
use App\Http\Requests\Admin\Genres\UpdateRequest;
use App\Models\Artist;
use App\Models\Genre;
use App\Models\GenreSong;
use DateTime;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Yoeunes\Toastr\Facades\Toastr;

class GenresController extends Controller
{
    public function index()
    {
        $genres = Genre::limit(10)->get();
        return view('modules.home.genres.index', ['genres' => $genres]);
    }
    public function getAll()
    {
        $genres = Genre::all();
        return view('modules.admin.genres.index', ['genres' => $genres]);
    }
    public function getData()
    {
        $genres = Genre::get();
        return DataTables::of($genres)->addIndexColumn()
            ->addColumn('name', function ($genre) {
                return '<a class="" href="' . route('admin.genres.details', $genre->id) . '">' . $genre->name . '</a>';
            })->addColumn('edit', function ($genre) {
                return '<a class="btn edit-btn button" href="' . route('admin.genres.edit', $genre->id) . '"> <span class="button_lg"> <span class="edit-btn button_sl"></span> <span class="button_text">Edit</span> </span> </a>';
            })->addColumn('delete', function ($genre) {
                return '<a class="btn delete-btn button" href="' . route('admin.genres.delete', $genre->id) . '" data-id="' . $genre->id . '" > <span class="button_lg"> <span class="delete-btn button_sl"></span> <span class="button_text">Delete</span> </span> </a>';
            })->rawColumns(['name', 'edit', 'delete'])->make(true);
    }
    public function genreDetails($id)
    {
        $genre = Genre::find($id);
        $otherGenres = Genre::where('id', '!=', $id)->get();
        $songs = $genre->songs()->where('status', '<>', '3')->get();
        return view('modules.home.genres.details', [
            'genre' => $genre,
            'otherGenres' => $otherGenres,
            'songs' => $songs
        ]);
    }
    public function adminGenreDetails($id)
    {
        $genre = Genre::where('id', $id)->first();
        return view('modules.admin.genres.details', ['genre' => $genre,]);
    }
    public function adminDataGenreDetails($id)
    {
        $genre = Genre::where('id', $id)->first();
        $songs = $genre->songs()->select('songs.id', 'songs.name', 'songs.img_url', 'songs.description')->with(['artists' => function ($query) {
            $query->select('artists.id', 'artists.name');
        }, 'albums' => function ($query) {
            $query->select('albums.id', 'albums.name');
        }])->get();
        return DataTables::of($songs)
            ->addColumn('name', function ($song) {
                return '<a class="" href="' . route('admin.songs.details', $song->id) . '">' . $song->name . '</a>';
            })
            ->addColumn('artists', function ($song) {
                $artists = $song->artists->pluck('name', 'id')->toArray();
                return $artists;
            })->addColumn('albums', function ($song) {
                $albums = $song->albums->pluck('name', 'id')->toArray();
                return $albums;
            })->addColumn('delete', function ($song) use ($id) {
                return '
            <a class="btn button delete-song-btn" 
            onclick="return confirm(\'Are you sure you want to delete this Song from Genre?\')"
            href="' . route('admin.genres.delete-song-from-genre', [$id, $song->id]) . '" 
            data-genre-id="' . $id . '" 
            data-id="' .  $song->id . '"> 
                <span class="button_lg"> 
                    <span class="delete-btn button_sl"></span>
                    <span class="button_text">Delete</span>
                </span> 
            </a>';
            })->rawColumns(['name', 'delete'])->make(true);
    }
    public function add()
    {
        $artists = Artist::all();
        $songsGenre = collect();

        return view(
            'modules.admin.genres.add',
            [
                'artists' => $artists,
                'songsGenre' => $songsGenre
            ]
        );
    }
    public function store(StoreRequest $request)
    {
        $user = auth()->user();
        $genre = $request->all();
        $genre['user_id'] = $user->id;
        $genre['created_at'] = new DateTime();
        if ($request->img_url) {
            $file = $request->img_url;
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('img/genre'), $filename);
            $genre['img_url'] = $filename;
        }
        if (!$request->description) {
            $genre['description'] = 'No Description';
        }
        $newGenre = Genre::create($genre);
        $checkedSong = json_decode($request->input('checkedSong'));
        foreach ($checkedSong as $item) {
            $newGenre->songs()->attach($item->id, ['created_at' => now()]);
        }
        Toastr::success('The Genre has been created successfully.', 'Success!');
        return redirect()->route('admin.genres.all');
    }
    public function edit($id)
    {
        $genre = Genre::find($id);
        $artists = Artist::all();
        $songsGenre = $genre->songs;
        return view('modules.admin.genres.edit', [
            'genre' => $genre,
            'artists' => $artists,
            'songsGenre' => $songsGenre
        ]);
    }
    public function update($id, UpdateRequest $request)
    {
        $user = auth()->user();
        $genre = Genre::find($id);
        $data = $request->except(
            '_token',
            'artist',
            'songs',
            'select-artist',
            'checkedSong',
            'checkedArtist'
        );
        $data['user_id'] = $user->id;
        if ($request->img_url) {
            $request->validate([
                'img_url' => 'mimes:jpeg,png,gif|max:500000',
            ]);
            $file = $request->file('img_url');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('img/genre'), $filename);
            $data['img_url'] = $filename;
        }
        if (!$request->description) {
            $data['description'] = 'No Description';
        }
        $data['updated_at'] = new DateTime();
        $genre->songs()->detach();
        $checkedSong = json_decode($request->input('checkedSong'));
        if (count($checkedSong)) {
            foreach ($checkedSong as $item) {
                $genre->songs()->attach($item->id, ['created_at' => now()]);
            }
        }
        $genre->update($data);
        Toastr::success('The Genre has been updated successfully.', 'Success!');
        return redirect()->route('admin.genres.all');
    }
    public function delete($id)
    {
        $genre = Genre::find($id);
        GenreSong::where('genre_id', $id)->delete();
        Genre::destroy($id);
        Toastr::success('The Genre has been deleted successfully.', 'Success!');
        return redirect()->route('admin.genres.all');
    }
    public function changeSongGenre($id)
    {
        $genres = Genre::where('id', '<>', $id)->get();
        return response()->json($genres);
    }
    public function updateSongGenre(Request $request, $id)
    {
        $genre = Genre::find($id);
        $songs = $genre->songs()->get();
        $checkedGenres = $request->input('checkedGenres');
        foreach ($songs as $song) {
            $songGenres = $song->genres()->pluck('genres.id')->toArray();
            $song->genres()->detach($genre->id);
            foreach ($checkedGenres as $genreId) {
                if (!in_array($genreId, $songGenres)) {
                    $newGenres = Genre::find($genreId);
                    $song->genres()->attach($newGenres, ['created_at' => now()]);
                }
            }
        }
        Genre::destroy($id);
        return response()->json(['message' => 'success']);
    }

    public function deleteSongFromGenre($genre_id, $song_id)
    {
        GenreSong::where('genre_id', $genre_id)->where('song_id', $song_id)->delete();
        Toastr::success('Song has been successfully removed from the Genre.', 'Success!');
        return redirect()->route('admin.genres.details', $genre_id);
    }
}
