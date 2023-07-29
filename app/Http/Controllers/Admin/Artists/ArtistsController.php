<?php

namespace App\Http\Controllers\Admin\Artists;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Artists\StoreRequest;
use App\Http\Requests\Admin\Artists\UpdateRequest;
use App\Models\Album;
use App\Models\AlbumSong;
use App\Models\Artist;
use App\Models\ArtistSong;
use App\Models\Favorite;
use App\Models\Review;
use App\Models\Song;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Termwind\Components\Dd;
use Yajra\DataTables\DataTables;
use Yoeunes\Toastr\Facades\Toastr;

class ArtistsController extends Controller
{
    public function index()
    {
        $artists = Artist::limit(100)->get();
        return view('modules.home.artist.index', ['artists' => $artists]);
    }

    public function getAll()
    {
        $artists = Artist::all();
        return view('modules.admin.artists.index', ['artists' => $artists]);
    }

    public function getData()
    {
        $artists = Artist::get();
        return DataTables::of($artists)->addIndexColumn()
            ->addColumn('name', function ($artist) {
                return '<a class="" href="' . route('admin.artists.details', $artist->id) . '">' . $artist->name . '</a>';
            })
            ->addColumn('edit', function ($artist) {
                return
                    '<a class="btn edit-btn button" href="' . route('admin.artists.edit', $artist->id) . '">
                    <span class="button_lg">
                        <span class="edit-btn button_sl"></span>
                        <span class="button_text">Edit</span>
                    </span>
                 </a>';
            })
            ->addColumn('delete', function ($artist) {
                return
                    '<a class="btn delete-btn button" 
                        href="' . route('admin.artists.delete', $artist->id) . '"
                        data-artist-id="' .  $artist->id . '">
                            <span class="button_lg">
                                <span class="delete-btn button_sl"></span>
                                <span class="button_text">Delete</span>
                            </span>
                 </a>';
            })
            ->rawColumns(['name', 'edit', 'delete'])
            ->make(true);
    }


    public function artistDetails($id)
    {
        $artist = Artist::find($id);
        $lastMonth  = Carbon::now()->subMonth();
        $songs = $artist->songs()->where('song_id', '<>', '3')
            ->get();

        $artistReviewsQuantity = Review::where('artist_id', $id)->get();
        $artistReviewsQuantityLastMonth = Review::where('artist_id', $id)->where('created_at', '>=', $lastMonth)->get();
        $artistLikesStarLastMonth = Favorite::where('artist_id', $id)->where('created_at', '>=', $lastMonth)->count();
        $star = 0;
        $starLastMonth = 0;
        if ($artistReviewsQuantity->count() > 0) {
            foreach ($artistReviewsQuantity as $key => $value) {
                $star += $value->rating;
                $artistReviewsStar = round($star / $artistReviewsQuantity->count(), 1);
            }
        }else {
            $artistReviewsStar = 0;
        }

        if ($artistReviewsQuantityLastMonth->count() > 0) {
            foreach ($artistReviewsQuantityLastMonth as $key => $value) {
                $starLastMonth += $value->rating;
                $artistReviewsStarLastMonth = round($starLastMonth / $artistReviewsQuantityLastMonth->count(), 1);
            }
        }else {
            $artistReviewsStarLastMonth = 0;
        }

        $songIdsFromArtist = ArtistSong::where('artist_id', $id)->get('song_id');
        $albumIds = AlbumSong::whereIn('song_id', $songIdsFromArtist)->get('album_id');
        $albums = Album::whereIn('id', $albumIds)->get();
        $otherArtist = Artist::where('id', '<>', $id)->get();
        $fvrQuantity = Favorite::where('artist_id', $id)->count();
        return view('modules.home.artist.details', [
            'artist' => $artist,
            'otherArtist' => $otherArtist,
            'songs' => $songs,
            'albums' => $albums,
            'fvrQuantity' => $fvrQuantity,
            'artistReviewsStar' => $artistReviewsStar,
            'artistReviewsQuantity' => $artistReviewsQuantity,
            'artistReviewsStarLastMonth' => $artistReviewsStarLastMonth,
            'artistLikesStarLastMonth' => $artistLikesStarLastMonth
        ]);
    }

    public function adminArtistDetails($id)
    {
        {
            $artist = Artist::find($id);
            $lastMonth  = Carbon::now()->subMonth();
            $songs = $artist->songs()->where('song_id', '<>', '3')
                ->get();
    
            $artistReviewsQuantity = Review::where('artist_id', $id)->get();
            $artistReviewsQuantityLastMonth = Review::where('artist_id', $id)->where('created_at', '>=', $lastMonth)->get();
            $artistLikesStarLastMonth = Favorite::where('artist_id', $id)->where('created_at', '>=', $lastMonth)->count();
            $star = 0;
            $starLastMonth = 0;
            if ($artistReviewsQuantity->count() > 0) {
                foreach ($artistReviewsQuantity as $key => $value) {
                    $star += $value->rating;
                    $artistReviewsStar = round($star / $artistReviewsQuantity->count(), 1);
                }
            }else {
                $artistReviewsStar = 0;
            }
    
            if ($artistReviewsQuantityLastMonth->count() > 0) {
                foreach ($artistReviewsQuantityLastMonth as $key => $value) {
                    $starLastMonth += $value->rating;
                    $artistReviewsStarLastMonth = round($starLastMonth / $artistReviewsQuantityLastMonth->count(), 1);
                }
            }else {
                $artistReviewsStarLastMonth = 0;
            }
    
            $songIdsFromArtist = ArtistSong::where('artist_id', $id)->get('song_id');
            $albumIds = AlbumSong::whereIn('song_id', $songIdsFromArtist)->get('album_id');
            $albums = Album::whereIn('id', $albumIds)->get();
            $otherArtist = Artist::where('id', '<>', $id)->get();
            $fvrQuantity = Favorite::where('artist_id', $id)->count();
            return view('modules.admin.artists.details', [
                'artist' => $artist,
                'otherArtist' => $otherArtist,
                'songs' => $songs,
                'albums' => $albums,
                'fvrQuantity' => $fvrQuantity,
                'artistReviewsStar' => $artistReviewsStar,
                'artistReviewsQuantity' => $artistReviewsQuantity,
                'artistReviewsStarLastMonth' => $artistReviewsStarLastMonth,
                'artistLikesStarLastMonth' => $artistLikesStarLastMonth
            ]);
        }
    }

    public function adminDataArtistDetails($id)
    {
        $artist = Artist::where('id', $id)->first();
        $songs = $artist->songs()
            ->select(
                'songs.id',
                'songs.name',
                'songs.img_url',
                'songs.description'
            )
            ->with(['genres' => function ($query) {
                $query->select('genres.id', 'genres.name');
            }, 'albums' => function ($query) {
                $query->select('albums.id', 'albums.name');
            }])
            ->get();
        return DataTables::of($songs)
            ->addColumn('name', function ($song) {
                return '<a class="" href="' . route('admin.songs.details', $song->id) . '">' . $song->name . '</a>';
            })
            ->addColumn('genres', function ($song) {
                $genres = $song->genres->pluck('name', 'id')->toArray();
                return $genres;
            })
            ->addColumn('albums', function ($song) {
                $albums = $song->albums->pluck('name', 'id')->toArray();
                return $albums;
            })
            ->addColumn('delete', function ($song) use ($id) {
                return
                    '<a class="btn delete-song-btn button" 
                    onclick="return confirm(\'Are you sure you want to delete this Song from Artist?\')"
                    href="' . route('admin.artists.delete-song-from-artist', [$id, $song->id]) . '" 
                    data-artist-id="' . $id . '" data-id="' .  $song->id . '">
                        <span class="button_lg">
                            <span class="delete-btn button_sl"></span>
                            <span class="button_text">Delete</span>
                        </span>
                     </a>';
            })
            ->rawColumns(['name', 'delete'])
            ->make(true);
    }

    public function add()
    {
        return view('modules.admin.artists.add');
    }

    public function store(StoreRequest $request)
    {
        $user = auth()->user();
        $artist = $request->all();
        $artist['user_id'] = $user->id;
        if ($request->img_url) {
            $file = $request->img_url;
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('img/artist'), $filename);
            $artist['img_url'] = $filename;
        }
        if (!$request->bio) {
            $artist['bio'] = 'No Information.';
        }
        $artist['created_at'] = new DateTime();
        Artist::create($artist);
        Album::insert([
            'user_id' => $user->id,
            'name' => 'Album ' . $artist['name'],
            'release_date' => '2021-01-01',
            'img_url' =>  $artist['img_url'],
            'created_at' => now(),
        ]);
        Toastr::success('The artist has been created successfully.', 'Success!');
        return redirect()->route('admin.artists.all');
    }

    public function edit($id)
    {
        $artist = Artist::find($id);
        return view('modules.admin.artists.edit', ['artist' => $artist]);
    }

    public function update($id, UpdateRequest $request)
    {
        $user = auth()->user();
        $data = $request->except('_token');
        $data['user_id'] = $user->id;
        if ($request->img_url) {
            $request->validate([
                'img_url' => 'mimes:jpeg,png,gif|max:500000',
            ]);
            $file = $request->img_url;
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('img/artist'), $filename);
            $data['img_url'] = $filename;
        }
        $data['updated_at'] = new DateTime();
        Artist::where('id', $id)->update($data);
        Toastr::success('The Artist has been updated successfully.', 'Success!');
        return redirect()->route('admin.artists.all');
    }

    public function delete($id)
    {
        ArtistSong::where('artist_id', $id)->delete();
        Artist::destroy($id);
        Toastr::success('The Artist has been deleted successfully.', 'Success!');
        return redirect()->route('admin.artists.all');
    }

    public function changeSongArtist($id)
    {
        $artists = Artist::where('id', '<>', $id)->get();
        return response()->json($artists);
    }

    public function updateOneSongArtist(Request $request, $artist_id, $song_id)
    {
        $checkedArtists = $request->input('checkedArtists');
        $song = Song::findOrFail($song_id);
        $song->artists()->detach($artist_id);
        $songArtists = $song->artists->pluck('id')->toArray();
        foreach ($checkedArtists as $artistId) {
            if (!in_array($artistId, $songArtists)) {
                $newArtists = Artist::findOrFail($artistId);
                $song->artists()->attach($newArtists, ['created_at' => now()]);
            }
        }

        return response()->json(['message' => 'success']);
    }

    public function updateSongArtist(Request $request, $id)
    {
        $artist = Artist::find($id);
        $songs = $artist->songs()->get();
        $checkedArtists = $request->input('checkedArtists');
        foreach ($songs as $song) {
            $songArtists = $song->artists()->pluck('artists.id')->toArray();
            $song->artists()->detach($artist->id);
            foreach ($checkedArtists as $artistId) {
                if (!in_array($artistId, $songArtists)) {
                    $newArtists = Artist::find($artistId);
                    $song->artists()->attach($newArtists, ['created_at' => now()]);
                }
            }
        }
        Artist::destroy($id);
        return response()->json(['message' => 'success']);
    }

    public function deleteSongFromArtist($artist_id, $song_id)
    {
        ArtistSong::where('artist_id', $artist_id)->where('song_id', $song_id)->delete();
        Toastr::success('Song has been successfully removed from the Artist.', 'Success!');
        return redirect()->route('admin.artists.details', $artist_id);
    }
}
