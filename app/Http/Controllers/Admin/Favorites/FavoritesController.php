<?php

namespace App\Http\Controllers\Admin\Favorites;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Favorite;
use App\Models\Song;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yoeunes\Toastr\Facades\Toastr;

class FavoritesController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $artists = $user->favoriteArtists()->get();

        $favoriteSongIds = Favorite::where('user_id', $user->id)
            ->orderByDesc('created_at')
            ->where('song_id', '!=', null)
            ->pluck('song_id');
        if ($favoriteSongIds->isNotEmpty()) {
            $favoriteSongs = Song::whereIn('id', $favoriteSongIds)
                ->orderByRaw('FIELD(id, ' . implode(',', $favoriteSongIds->toArray()) . ')')
                ->limit(21)
                ->get();
        } else {
            $favoriteSongs = collect();
        }

        $favoriteAlbumIds = Favorite::where('user_id', $user->id)
            ->orderByDesc('created_at')
            ->where('album_id', '!=', null)
            ->pluck('album_id');
        if ($favoriteAlbumIds->isNotEmpty()) {
            $favoriteAlbums = Album::whereIn('id', $favoriteAlbumIds)
                ->orderByRaw('FIELD(id, ' . implode(',', $favoriteAlbumIds->toArray()) . ')')
                ->get();
        } else {
            $favoriteAlbums = collect();
        }

        $timeNow = now();
        $songsWithRelativeTime = [];
        foreach ($favoriteSongs as $item) {
            $song = Favorite::where('song_id', $item->id)->first();
            $created_at = Carbon::parse($song->created_at);
            $diff = $created_at->diffForHumans($timeNow);
            $songsWithRelativeTime[] = [
                'song' => $item,
                'relative_time' => $diff,
            ];
        };

        $albumsWithRelativeTime = [];
        foreach ($favoriteAlbums as $item) {
            $album = Favorite::where('album_id', $item->id)->first();
            $created_at = Carbon::parse($album->created_at);
            $diff = $created_at->diffForHumans($timeNow);
            $albumsWithRelativeTime[] = [
                'album' => $item,
                'relative_time' => $diff,
            ];
        };

        return view('modules.home.favorite.index', [
            'songsWithRelativeTime' => $songsWithRelativeTime,
            'albumsWithRelativeTime' => $albumsWithRelativeTime,
            'artists' => $artists
        ]);
    }

    public function addFavorite(Request $request)
    {
        $user_id = Auth::user()->id;
        $idItem = $request->input('idItem');
        $typeItem = $request->input('typeItem');
        if ($typeItem == 'song') {
            $favorite = Favorite::where('user_id', $user_id)->where('song_id', $idItem)->first();
        } elseif ($typeItem == 'album') {
            $favorite = Favorite::where('user_id', $user_id)->where('album_id', $idItem)->first();
        } elseif ($typeItem == 'artist') {
            $favorite = Favorite::where('user_id', $user_id)->where('artist_id', $idItem)->first();
        }
        if ($favorite) {
            $favorite->delete();
            return response()->json(['success' => true, 'action' => 'removed', 'idItem' => $idItem]);
        } else {
            $favorite = new Favorite();
            $favorite->user_id = $user_id;
            if ($typeItem == 'song') {
                $favorite->song_id = $idItem;
                $favorite->save();
            } elseif ($typeItem == 'album') {
                $favorite->album_id = $idItem;
                $favorite->save();
            } elseif ($typeItem == 'artist') {
                $favorite->artist_id = $idItem;
                $favorite->save();
            }
            return response()->json(['success' => true, 'action' => 'added', 'idItem' => $idItem]);
        }
    }

}
