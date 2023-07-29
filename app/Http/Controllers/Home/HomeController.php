<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\Artist;
use App\Models\Favorite;
use App\Models\Genre;
use App\Models\History;
use App\Models\Playlist;
use App\Models\Review;
use App\Models\Song;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function formatNumber($number) {
        if ($number >= 1000) {
            $formattedNumber = round($number / 1000, 1).'M';
        }
        elseif ($number >= 1000000) {
            $formattedNumber = round($number / 1000000, 1).'K';
        }
        elseif ($number >= 1000000000) {
            $formattedNumber = round($number / 1000000000, 1).'B';
        }
        else {
            $formattedNumber = $number;
        }
    
        return $formattedNumber;
    }
    public function index()
    {
        $user = auth()->user();
        $songs = Song::where('status', '<>', '3')->orderBy('created_at', 'desc')->limit(100)->get();

        $songsOrderbyRate = Song::select(
            'songs.id',
            'songs.name',
            'songs.img_url',
            'songs.url',
            'songs.musician',
            'songs.lyric',
            'songs.duration',
            'songs.status',
            'songs.description',
            'songs.release_date',
            'songs.downloads',
            DB::raw('AVG(CASE WHEN reviews.created_at >= DATE_SUB(NOW(), INTERVAL 30 DAY) THEN reviews.rating ELSE NULL END) as average_rating'),
        )
            ->leftJoin('reviews', 'reviews.song_id', '=', 'songs.id')
            ->groupBy(
                'songs.id',
                'songs.name',
                'songs.img_url',
                'songs.url',
                'songs.musician',
                'songs.lyric',
                'songs.duration',
                'songs.status',
                'songs.description',
                'songs.release_date',
                'songs.downloads',
            )
            ->orderByDesc('average_rating')
            ->limit(100)
            ->get();

        $songsOrderbyLike = Song::select(
            'songs.id',
            'songs.name',
            'songs.img_url',
            'songs.url',
            'songs.musician',
            'songs.lyric',
            'songs.duration',
            'songs.status',
            'songs.description',
            'songs.release_date',
            'songs.downloads',
            DB::raw('SUM(CASE WHEN favorites.created_at >= DATE_SUB(NOW(), INTERVAL 30 DAY) THEN 1 ELSE 0 END) as likes')
        )
            ->leftJoin('favorites', 'favorites.song_id', '=', 'songs.id')
            ->groupBy(
                'songs.id',
                'songs.name',
                'songs.img_url',
                'songs.url',
                'songs.musician',
                'songs.lyric',
                'songs.duration',
                'songs.status',
                'songs.description',
                'songs.release_date',
                'songs.downloads',
            )
            ->orderByDesc('likes')
            ->limit(100)
            ->get();


        $comingsongs = Song::where('status', '=', '3')->orderBy('created_at', 'desc')->get();

        $historySong = $user->listenedSongs()
            ->limit(100)
            ->get();
        if (!$historySong->isEmpty()) {
            $genresByHistorySongId = $historySong->flatMap(function ($song) {
                return $song->genres;
            })->pluck('id')->unique();

            $songSuggests = Song::where('status', '<>', '3')
                ->whereNotIn('id', $historySong->pluck('id')->filter())
                ->whereHas('genres', function ($query) use ($genresByHistorySongId) {
                    $query->whereIn('genres.id', $genresByHistorySongId);
                })
                ->get();
        } else {
            $songSuggests = Song::where('status', '<>', '3')->orderBy('created_at', 'desc')->get();
        }

       $songSuggests = $songSuggests->shuffle();

        $playedSongIds = History::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->pluck('song_id')->filter();
        if ($playedSongIds->isNotEmpty()) {
            $playedSongs = Song::whereIn('id', $playedSongIds)
                ->orderByRaw('FIELD(id, ' . implode(',', $playedSongIds->toArray()) . ')')
                ->get();
        } else {
            $playedSongs = collect();
        }

        $albumsOrderbyRate = Album::select(
            'albums.id',
            'albums.name',
            'albums.img_url',
            'albums.description',
            'albums.release_date',
            DB::raw('AVG(CASE WHEN reviews.created_at >= DATE_SUB(NOW(), INTERVAL 30 DAY) THEN reviews.rating ELSE NULL END) as average_rating'),
        )
            ->leftJoin('reviews', 'reviews.album_id', '=', 'albums.id')
            ->groupBy(
                'albums.id',
                'albums.name',
                'albums.img_url',
                'albums.description',
                'albums.release_date',
            )
            ->orderByDesc('average_rating')
            ->limit(10)
            ->get();

        $artistsOrderbyRate = Artist::select(
            'artists.id',
            'artists.name',
            'artists.img_url',
            'artists.bio',
            DB::raw('AVG(CASE WHEN reviews.created_at >= DATE_SUB(NOW(), INTERVAL 30 DAY) THEN reviews.rating ELSE NULL END) as average_rating'),
        )
            ->leftJoin('reviews', 'reviews.artist_id', '=', 'artists.id')
            ->groupBy(
                'artists.id',
                'artists.name',
                'artists.img_url',
                'artists.bio',
            )
            ->orderByDesc('average_rating')
            ->limit(100)
            ->get();



        return view('modules.home.index', [
            'songs' => $songs,
            'comingsongs' => $comingsongs,
            'songsOrderbyRate' => $songsOrderbyRate,
            'songsOrderbyLike' => $songsOrderbyLike,
            'albumsOrderbyRate' => $albumsOrderbyRate,
            'artistsOrderbyRate' => $artistsOrderbyRate,
            'songSuggests' => $songSuggests,
            'playedSongs' => $playedSongs,

        ]);
    }

    public function loadMore(Request $request)
    {
        $user = Auth::user();
        $quantityLoad = $request->quantityLoad;
        $dataId = $request->dataId;
        $dataType = $request->dataType;
        if (!$dataId) {
            $data = $this->getDataByType($dataType, $quantityLoad, $user);
        } else {
            $data = $this->getDataByIdAndType($dataId, $dataType, $quantityLoad, $user);
        }
        return response()->json([
            'data' => $data
        ]);
    }

    private function getDataByType($dataType, $quantityLoad, $user)
    {
        switch ($dataType) {
            case 'genre':
                return Genre::limit($quantityLoad)->get();
            case 'album':
                $albums = Album::limit($quantityLoad)->get();
                $albumIds = $albums->pluck('id');
                $albumFvr = Favorite::where('user_id', $user->id)->whereIn('album_id', $albumIds)->get();
                return [
                    'albums' => $albums,
                    'albumFvr' => $albumFvr
                ];
            case 'artist':
                return Artist::limit($quantityLoad)->get();
            case 'playlist':
                return Playlist::limit($quantityLoad)->orderBy('created_at', 'desc')->get();
            default:
                return null;
        }
    }

    private function getDataByIdAndType($dataId, $dataType, $quantityLoad, $user)
    {
        switch ($dataType) {
            case 'genre':
                $genre = Genre::where('id', $dataId)->first();
                if (!$quantityLoad) {
                    $songs = $genre->songs()->with('artists')->get();
                } else {
                    $songs = $genre->songs()->with('artists')->limit($quantityLoad)->get();
                }
                $songIds = $songs->pluck('id');
                $songFvr = Favorite::where('user_id', $user->id)->whereIn('song_id', $songIds)->get();
                $playlists = $user->playlists()->get();
                return [
                    'songs' => $songs,
                    'songFvr' => $songFvr,
                    'playlists' => $playlists
                ];
            case 'album':
                $album = Album::where('id', $dataId)->first();
                if (!$quantityLoad) {
                    $songs = $album->songs()->with('artists')->get();
                } else {
                    $songs = $album->songs()->with('artists')->limit($quantityLoad)->get();
                }
                $songIds = $songs->pluck('id');
                $songFvr = Favorite::where('user_id', $user->id)->whereIn('song_id', $songIds)->get();
                $playlists = $user->playlists()->get();
                return [
                    'songs' => $songs,
                    'songFvr' => $songFvr,
                    'playlists' => $playlists
                ];
            case 'artist':
                $artist = Artist::where('id', $dataId)->first();
                if (!$quantityLoad) {
                    $songs = $artist->songs()->with('artists')->get();
                } else {
                    $songs = $artist->songs()->with('artists')->limit($quantityLoad)->get();
                }
                $songIds = $songs->pluck('id');
                $songFvr = Favorite::where('user_id', $user->id)->whereIn('song_id', $songIds)->get();
                $playlists = $user->playlists()->get();
                return [
                    'songs' => $songs,
                    'songFvr' => $songFvr,
                    'playlists' => $playlists
                ];
            case 'favorite':
                return $this->getFavoriteSongs($quantityLoad, $user);
            case 'history':
                return $this->getHistorySongs($quantityLoad, $user);
            case 'playlist':
                $playlist = Playlist::where('user_id', $user->id)->where('id', $dataId)->first();
                if (!$quantityLoad) {
                    $songs = $playlist->songs()->with('artists')->get();
                } else {
                    $songs = $playlist->songs()->with('artists')->limit($quantityLoad)->get();
                }
                $songIds = $songs->pluck('id');
                $songFvr = Favorite::where('user_id', $user->id)->whereIn('song_id', $songIds)->get();
                $playlists = $user->playlists()->get();
                return [
                    'songs' => $songs,
                    'songFvr' => $songFvr,
                    'playlists' => $playlists
                ];
            default:
                return null;
        }
    }

    private function getFavoriteSongs($quantityLoad, $user)
    {
        $timeNow = now();
        $favoriteSongIds = Favorite::where('user_id', $user->id)
            ->orderByDesc('created_at')
            ->where('song_id', '!=', null)
            ->pluck('song_id');

        if ($favoriteSongIds->isNotEmpty()) {
            $favoriteSongs = Song::whereIn('id', $favoriteSongIds)
                ->orderByRaw('FIELD(id, ' . implode(',', $favoriteSongIds->toArray()) . ')')
                ->with('artists')
                ->limit($quantityLoad)
                ->get();
        } else {
            $favoriteSongs = collect();
        }
        $songsWithRelativeTime = [];
        $playlists = $user->playlists()->get();
        foreach ($favoriteSongs as $item) {
            $song = Favorite::where('song_id', $item->id)->first();
            $created_at = Carbon::parse($song->created_at);
            $diff = $created_at->diffForHumans($timeNow);
            $songsWithRelativeTime[] = [
                'song' => $item,
                'playlists' => $playlists,
                'relative_time' => $diff,
            ];
        };

        return $songsWithRelativeTime;
    }

    private function getHistorySongs($quantityLoad, $user)
    {
        $timeNow = now();
        $historySongIds = History::where('user_id', $user->id)
            ->orderByDesc('created_at')
            ->where('song_id', '!=', null)
            ->pluck('song_id');

        if ($historySongIds->isNotEmpty()) {
            $historySongs = Song::whereIn('id', $historySongIds)
                ->orderByRaw('FIELD(id, ' . implode(',', $historySongIds->toArray()) . ')')
                ->with('artists')
                ->limit($quantityLoad)
                ->get();
        } else {
            $historySongs = collect();
        }
        $songsWithRelativeTime = [];
        $playlists = $user->playlists()->get();
        foreach ($historySongs as $item) {
            $song = History::where('song_id', $item->id)->first();
            $created_at = Carbon::parse($song->created_at);
            $diff = $created_at->diffForHumans($timeNow);
            $songFvr = Favorite::where('user_id', $user->id)->where('song_id', $item->id)->first();
            $songsWithRelativeTime[] = [
                'song' => $item,
                'songFvr' => $songFvr,
                'playlists' => $playlists,
                'relative_time' => $diff,
            ];
        };

        return $songsWithRelativeTime;
    }

    public function review($id, Request $request)
    {
        $user = Auth::user();
        $data = $request->all();
        $type = $request->type;
        $exist = Review::where('user_id', $user->id)->where($type . '_id', $id)->first();
        if (!$exist) {
            Review::create([
                'user_id' => $user->id,
                $type . '_id' => $id,
                'rating' => $data['rating'],
                'review' => $data['review'],
                'created_at' => now()
            ]);

            return response()->json([
                'success' => true
            ]);
        }
        return response()->json([
            'success' => false
        ]);
    }

    public function search(Request $request)
    {
        $user = Auth::user();
        $dataTab = $request->dataTab;
        $key = $request->key;

        $type = [
            'artists' => Artist::class,
            'albums' => Album::class,
            'songs' => Song::class
        ];

        if ($dataTab == 'songs') {
            $songs = $type[$dataTab]::where('name', 'like', '%' . $key . '%')->with('artists')->get();
            $songIds = $songs->pluck('id');
            $songFvr = Favorite::where('user_id', $user->id)->whereIn('song_id', $songIds)->get();
            $playlists = $user->playlists()->get();
            return response()->json($result[] = [
                'songs' => $songs,
                'songFvr' => $songFvr,
                'playlists' => $playlists
            ]);
        } else {
            $data = $type[$dataTab]::where('name', 'like', '%' . $key . '%')->get();
            return response()->json($result[] = [
                $dataTab => $data
            ]);
        }
    }
};
