<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Http\Requests\Home\Playlists\UpdateRequest;
use App\Models\Playlist;
use App\Models\PlaylistSong;
use App\Models\Song;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;

class PlaylistsController extends Controller
{
    public function index()
    {
        $playlists = Playlist::where('user_id', auth()->user()->id)->get();
        return view('modules.home.playlist.index', [
            'playlists' => $playlists
        ]);
    }
    public function playlistDetails($id)
    {
        $user = auth()->user();
        $playlist = Playlist::where('user_id', $user->id)
            ->where('id', $id)
            ->first();
        $songs = $playlist->songs()->get();

        $timeNow = now();
        $playelistSongIds = PlaylistSong::where('playlist_id', $id)
            ->orderByDesc('created_at')
            ->pluck('song_id')
            ->filter();
        if ($playelistSongIds->isNotEmpty()) {
            $playlistSongs = Song::whereIn('id', $playelistSongIds)
                ->orderByRaw('FIELD(id, ' . implode(',', $playelistSongIds->toArray()) . ')')
                ->with('artists')
                ->limit(21)
                ->get();
        } else {
            $playlistSongs = collect();
        }

        $songsWithRelativeTime = [];
        foreach ($playlistSongs as $item) {
            $song = PlaylistSong::where('song_id', $item->id)->first();
            $created_at = Carbon::parse($song->created_at);
            $diff = $created_at->diffForHumans($timeNow);
            $songsWithRelativeTime[] = [
                'song' => $item,
                'relative_time' => $diff,
            ];
        };

        $songSuggests = Song::whereNotIn('id', $songs->pluck('id'))
            ->with('artists')
            ->limit(21)
            ->get()
            ->shuffle();
        return view('modules.home.playlist.details', [
            'songsWithRelativeTime' => $songsWithRelativeTime,
            'songs' => $songs,
            'playlist' => $playlist,
            'songSuggests' => $songSuggests,
        ]);
    }
    public function createPlaylist(Request $request)
    {
        $user = auth()->user();
        $change = $request->input('change');
        $playlists = Playlist::where('user_id', $user->id)->get();
        $index = count($playlists) + 1;
        $playlist = Playlist::create([
            'user_id' => $user->id,
            'name' => 'New Playlist #' . $index,
            'img_url' => 'https://i.postimg.cc/B6tXsrKz/image.png',
            'description' => 'New Playlist #' . $index,
            'created_at' => new DateTime(),
        ]);
        if ($change == "false") {
            $songId = $request->input('songId');
            PlaylistSong::create([
                'playlist_id' => $playlist->id,
                'song_id' => $songId
            ]);
            return response()->json([
                'playlist' => $playlist
            ]);
        }
        return response()->json(
            [
                'playlist' => $playlist,
            ]
        );
    }

    public function updatePlaylist(UpdateRequest $request)
    {
        $user = auth()->user();
        $data = $request->except('_token', 'img_url');
        $data['user_id']  = $user->id;
        $data['created_at'] = new DateTime();

        if ($request->img_url) {
            $img = $request->img_url;
            $imgname = time() . '_' .  $img->getClientOriginalName();
            if (!file_exists(public_path('img/playlist/' . $img))) {
                $img->move(public_path('img/playlist'), $imgname);
            }
            $data['img_url'] = $imgname;
        }
        if (!$request->description) {
            $data['description'] = 'No Description';
        }
        Playlist::where('id', $request->id)->update($data);
        return response()->json($data);
    }

    public function deletePlaylist($id)
    {
        $user = auth()->user();
        PlaylistSong::where('playlist_id', $id)->delete();
        Playlist::where('user_id', $user->id)->where('id', $id)->delete();
        // Toastr::success('Playlist deleted successfully.', 'Success!');
        return redirect()->route('home.playlists');
    }

    public function addSongToPlaylist($idPlaylist, $idSuggest)
    {
        $song = Song::find($idSuggest);
        $exist = PlaylistSong::where('playlist_id', $idPlaylist)->where('song_id', $song->id)->first();
        if (!$exist) {
            PlaylistSong::create([
                'playlist_id' => $idPlaylist,
                'song_id' => $song->id
            ]);
        }
        $playlist = Playlist::where('id', $idPlaylist)->first();
        $songsInPlaylist = $playlist->songs()->get();
        return response()->json([
            'exist' => $exist,
            'song' => $song,
            'playlist' => $playlist,
            'songsInPlaylist' => $songsInPlaylist
        ]);
    }

    public function getArtistInPlaylist($id)
    {
        $playlist = Playlist::find($id);
        $songs = $playlist->songs()->where('status', '<>', '3')->with('artists')->limit(5)->get();
        return response()->json($songs);
    }


    public function removeSongFromPlaylist(Request $request)
    {
        $songId = $request->idSong;
        $playlistId = $request->idPlaylist;
        PlaylistSong::where('playlist_id', $playlistId)->where('song_id', $songId)->delete();
        return response()->json([
            'success' => true
        ]);
    }
}
