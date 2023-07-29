<?php

namespace App\Http\Controllers\Admin\Albums;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Albums\StoreRequest;
use App\Http\Requests\Admin\Albums\UpdateRequest;
use App\Models\Album;
use App\Models\AlbumSong;
use App\Models\Artist;
use App\Models\Favorite;
use App\Models\Genre;
use App\Models\History;
use App\Models\Review;
use App\Models\Song;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use Yoeunes\Toastr\Facades\Toastr;

class AlbumsController extends Controller
{
    public function index()
    {
        $albums = Album::limit(100)->get();
        return view('modules.home.album.index', [
            'albums' => $albums,
        ]);
    }

    public function getData()
    {
        $albums = Album::get();
        return DataTables::of($albums)->addIndexColumn()
            ->addColumn('name', function ($album) {
                return '<a class="" href="' . route('admin.albums.details', $album->id) . '">' . $album->name . '</a>';
            })
            ->addColumn('edit', function ($album) {

                return
                    '<a class="btn edit-btn button" href="' . route('admin.albums.edit', $album->id) . '">
                    <span class="button_lg">
                        <span class="edit-btn button_sl"></span>
                        <span class="button_text">Edit</span>
                    </span>
                 </a>';
            })
            ->addColumn('delete', function ($album) {
                return '<a class="btn delete-btn button" 
                href="' . route('admin.albums.delete', $album->id) . '" 
                onclick="return confirm(\'Are you sure you want to delete this Album?\')"> 
                    <span class="button_lg"> <span class="delete-btn button_sl"></span> <span class="button_text">Delete</span> </span> 
                </a>';
            })
            ->rawColumns(['name', 'edit', 'delete'])
            ->make(true);
    }

    public function getAll()
    {
        $albums = Album::all();
        return view('modules.admin.albums.index', ['albums' => $albums]);
    }

    public function albumDetails($id)
    {
        $album = Album::find($id);
        $lastMonth  = Carbon::now()->subMonth();
        $albumReviewsQuantity = Review::where('album_id', $id)->get();
        $albumReviewsQuantityLastMonth = Review::where('album_id', $id)->where('created_at', '>=', $lastMonth)->get();
        $albumLikesStarLastMonth = Favorite::where('album_id', $id)->where('created_at', '>=', $lastMonth)->count();
        $star = 0;
        $starLastMonth = 0;
        if ($albumReviewsQuantity->count() > 0) {
            foreach ($albumReviewsQuantity as $key => $value) {
                $star += $value->rating;
                $albumReviewsStar = round($star / $albumReviewsQuantity->count(), 1);
            }
        } else {
            $albumReviewsStar = 0;
        }

        if ($albumReviewsQuantityLastMonth->count() > 0) {
            foreach ($albumReviewsQuantityLastMonth as $key => $value) {
                $starLastMonth += $value->rating;
                $albumReviewsStarLastMonth = round($starLastMonth / $albumReviewsQuantityLastMonth->count(), 1);
            }
        } else {
            $albumReviewsStarLastMonth = 0;
        }

        $songs = $album->songs()->where('status', '<>', '3')->get();
        $otherAlbums = Album::where('id', '<>', $id)->get();
        $fvrQuantity = Favorite::where('album_id', $id)->count();
        return view('modules.home.album.details', [
            'album' => $album,
            'otherAlbums' => $otherAlbums,
            'songs' => $songs,
            'fvrQuantity' => $fvrQuantity,
            'albumReviewsQuantity' => $albumReviewsQuantity,
            'albumReviewsStar' => $albumReviewsStar,
            'lastMonth' => $lastMonth,
            'albumReviewsStarLastMonth' => $albumReviewsStarLastMonth,
           'albumLikesStarLastMonth' => $albumLikesStarLastMonth

        ]);
    }

    public function getArtistInAlbum($id)
    {
        $album = Album::find($id);
        $songs = $album->songs()->where('status', '<>', '3')->with('artists')->limit(5)->get();

        return response()->json($songs);
    }

    public function adminAlbumDetails($id)
    {
        $album = Album::find($id);
        $lastMonth  = Carbon::now()->subMonth();
        $albumReviewsQuantity = Review::where('album_id', $id)->get();
        $albumReviewsQuantityLastMonth = Review::where('album_id', $id)->where('created_at', '>=', $lastMonth)->get();
        $albumLikesStarLastMonth = Favorite::where('album_id', $id)->where('created_at', '>=', $lastMonth)->count();
        $star = 0;
        $starLastMonth = 0;
        if ($albumReviewsQuantity->count() > 0) {
            foreach ($albumReviewsQuantity as $key => $value) {
                $star += $value->rating;
                $albumReviewsStar = round($star / $albumReviewsQuantity->count(), 1);
            }
        } else {
            $albumReviewsStar = 0;
        }

        if ($albumReviewsQuantityLastMonth->count() > 0) {
            foreach ($albumReviewsQuantityLastMonth as $key => $value) {
                $starLastMonth += $value->rating;
                $albumReviewsStarLastMonth = round($starLastMonth / $albumReviewsQuantityLastMonth->count(), 1);
            }
        } else {
            $albumReviewsStarLastMonth = 0;
        }

        $songs = $album->songs()->where('status', '<>', '3')->get();
        $otherAlbums = Album::where('id', '<>', $id)->get();
        $fvrQuantity = Favorite::where('album_id', $id)->count();
        return view('modules.admin.albums.details', [
            'album' => $album,
            'otherAlbums' => $otherAlbums,
            'songs' => $songs,
            'fvrQuantity' => $fvrQuantity,
            'albumReviewsQuantity' => $albumReviewsQuantity,
            'albumReviewsStar' => $albumReviewsStar,
            'lastMonth' => $lastMonth,
            'albumReviewsStarLastMonth' => $albumReviewsStarLastMonth,
           'albumLikesStarLastMonth' => $albumLikesStarLastMonth
        ]);
    }

    public function adminDataAlbumsDetails($id)
    {
        $album = Album::where('id', $id)->first();
        $songs = $album->songs()
            ->select(
                'songs.id',
                'songs.name',
                'songs.img_url',
                'songs.description'
            )
            ->with(['genres' => function ($query) {
                $query->select('genres.id', 'genres.name');
            }, 'artists' => function ($query) {
                $query->select('artists.id', 'artists.name');
            }])
            ->get();
        return DataTables::of($songs)
            ->addColumn('name', function ($song) {
                return '<a class="" href="' . route('admin.songs.details', $song->id) . '">' . $song->name . '</a>';
            })
            ->addColumn('artists', function ($song) {
                $artists = $song->artists->pluck('name', 'id')->toArray();
                return $artists;
            })
            ->addColumn('genres', function ($song) {
                $genres = $song->genres->pluck('name', 'id')->toArray();
                return $genres;
            })
            ->addColumn('delete', function ($song) use ($id) {
                return
                    '<a class="btn delete-btn button" 
                    onclick="return confirm(\'Are you sure you want to delete this Song from Album?\')"
                        href="' . route('admin.albums.delete-song-from-album', [$id, $song->id]) . '">
                            <span class="button_lg">
                                <span class="delete-btn button_sl"></span>
                                <span class="button_text">Delete</span>
                            </span>
                    </a>';
            })
            ->rawColumns(['name', 'delete'])
            ->make(true);
    }

    public function deleteSongFromAlbum($album_id, $song_id)
    {
        AlbumSong::where('album_id', $album_id)->where('song_id', $song_id)->delete();
        Toastr::success('Song has been successfully removed from the Album.', 'Success!');
        return redirect()->route('admin.albums.details', $album_id);
    }

    public function add()
    {
        $artists = Artist::all();
        $songs = Song::all();
        $genres = Genre::all();
        $songsAlbum = [];
        return view('modules.admin.albums.add', [
            'artists' => $artists,
            'songs' => $songs,
            'genres' => $genres,
            'songsAlbum' => $songsAlbum,
        ]);
    }

    public function store(StoreRequest $request)
    {
        $user = Auth::user();
        $album = $request->all();
        $album['user_id'] = $user->id;
        if ($request->img_url) {
            $file = $request->img_url;
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('img/album'), $filename);
            $album['img_url'] = $filename;
        }
        if (!$request->description) {
            $album['description'] = 'No Description';
        }
        $album['created_at'] = new DateTime();
        $newAlbum = Album::create($album);
        $checkedSong = json_decode($request->input('checkedSong'));
        foreach ($checkedSong as $item) {
            $newAlbum->songs()->attach($item->id, ['created_at' => now()]);
        }
        $validator = Validator::make($request->all(), $request->rules());
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }
        Toastr::success('The Album has been created successfully.', 'Success!');
        return response()->json(['message' => 'success']);
    }

    public function edit($id)
    {
        $album = Album::findOrFail($id);
        $song_ids = AlbumSong::whereIn('album_id', [$id])->pluck('song_id');
        $songsAlbum = Song::whereIn('id', $song_ids)
            ->with(['artists', 'genres', 'albums' => function ($query) {
                $query->distinct();
            }])
            ->get();
        $artists = Artist::all();
        $songs = Song::with('artists', 'genres', 'albums')->get();
        $genres = Genre::all();

        return view('modules.admin.albums.edit', [
            'album' => $album,
            'artists' => $artists,
            'songs' => $songs,
            'genres' => $genres,
            'songsAlbum' => $songsAlbum,
        ]);
    }

    public function update($id, UpdateRequest $request)
    {
        $user = Auth::user();
        $album = Album::findOrFail($id);
        $album['user_id'] = $user->id;
        $album->fill($request->except('_token'));
        if ($request->img_url) {
            $request->validate([
                'img_url' => 'mimes:jpeg,png,gif|max:500000',
            ]);
            $file = $request->img_url;
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('img/album'), $filename);
            $album['img_url'] = $filename;
        }
        $album->songs()->detach();
        $checkedSong = json_decode($request->input('checkedSong'));
        foreach ($checkedSong as $item) {
            $album->songs()->attach($item->id, ['created_at' => now()]);
        }
        $validator = Validator::make($request->all(), $request->rules());
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }
        $album->save();
        Toastr::success('The Album has been updated successfully.', 'Success!');
        return redirect()->route('admin.albums.all');
    }

    public function delete($id)
    {
        AlbumSong::where('album_id', $id)->delete();
        History::where('album_id', $id)->delete();
        Favorite::where('album_id', $id)->delete();
        Review::where('album_id', $id)->delete();
        Album::destroy($id);
        Toastr::success('The Album has been deleted successfully.', 'Success!');
        return redirect()->route('admin.albums.all');
    }
}
