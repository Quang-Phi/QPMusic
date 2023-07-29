<?php

namespace App\Http\Controllers\Admin\Histories;

use App\Http\Controllers\Controller;
use App\Models\Album;
use App\Models\History;
use App\Models\Song;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoriesController extends Controller
{
    public function index()
    {

        $user = Auth::user();
        $timeNow = now();
        $playedSongIds = History::where('user_id', $user->id)
            ->orderByDesc('created_at')
            ->pluck('song_id')
            ->filter();
        if ($playedSongIds->isNotEmpty()) {
            $historySongs = Song::whereIn('id', $playedSongIds)
                ->orderByRaw('FIELD(id, ' . implode(',', $playedSongIds->toArray()) . ')')
                ->limit(21)
                ->get();
        } else {
            $historySongs = collect();
        }

        $songsWithRelativeTime = [];
        foreach ($historySongs as $item) {
            $song = History::where('song_id', $item->id)->first();
            $created_at = Carbon::parse($song->created_at);
            $diff = $created_at->diffForHumans($timeNow);
            $songsWithRelativeTime[] = [
                'song' => $item,
                'relative_time' => $diff,
            ];
        };


        $historyAlbumIds = History::where('user_id', $user->id)
            ->orderByDesc('created_at')
            ->where('album_id', '!=', null)
            ->pluck('album_id');
        if ($historyAlbumIds->isNotEmpty()) {
            $historyAlbums = Album::whereIn('id', $historyAlbumIds)
                ->orderByRaw('FIELD(id, ' . implode(',', $historyAlbumIds->toArray()) . ')')
                ->get();
        } else {
            $historyAlbums = collect();
        }
        $albumsWithRelativeTime = [];
        foreach ($historyAlbums as $item) {
            $album = History::where('album_id', $item->id)->first();
            $created_at = Carbon::parse($album->created_at);
            $diff = $created_at->diffForHumans($timeNow);
            $albumsWithRelativeTime[] = [
                'album' => $item,
                'relative_time' => $diff,
            ];
        };


        return view('modules.home.histories.index', [
            'songsWithRelativeTime' => $songsWithRelativeTime,
            'albumsWithRelativeTime' => $albumsWithRelativeTime
        ]);
    }

    public function addHistories(Request $request)
    {
        $user_id = Auth::user()->id;
        $collection = $request->input('collection');
        if ($collection == 'album') {
            $albumId = $request->input('albumId');
            $histories = History::where('user_id', $user_id)->where('album_id', $albumId)->first();
            if (!$histories) {
                History::create([
                    'user_id' => $user_id,
                    'album_id' => $albumId,
                    'created_at' => new DateTime(),
                ]);
                dd($histories);
            } else {
                $histories->created_at = new DateTime();
                $histories->updated_at = new DateTime();
                $histories->save();
            }
        } else {
            $song_id = $request->input('song_id');
            $histories = History::where('user_id', $user_id)->where('song_id', $song_id)->first();
            if (!$histories) {
                History::create([
                    'user_id' => $user_id,
                    'song_id' => $song_id,
                    'created_at' => new DateTime(),
                ]);
            } else {
                $histories->created_at = new DateTime();
                $histories->updated_at = new DateTime();
                $histories->save();
            }
        }
        return response()->json(['success' => true, 'action' => 'added']);
    }
}
