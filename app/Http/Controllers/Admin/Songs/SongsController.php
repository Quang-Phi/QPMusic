<?php

namespace App\Http\Controllers\Admin\Songs;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Songs\StoreManyRequest;
use App\Http\Requests\Admin\Songs\StoreRequest;
use App\Http\Requests\Admin\Songs\UpdateRequest;
use App\Models\Album;
use App\Models\AlbumSong;
use App\Models\Artist;
use App\Models\ArtistSong;
use App\Models\Favorite;
use App\Models\Genre;
use App\Models\GenreSong;
use App\Models\History;
use App\Models\PlaylistSong;
use App\Models\Review;
use App\Models\Song;
use Carbon\Carbon;
use DateTime;
use getID3;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use Yoeunes\Toastr\Facades\Toastr;
use ZipArchive;

class SongsController extends Controller
{
    public function formatNumber($number)
    {
        if ($number >= 1000000000) {
            $formattedNumber = round($number / 1000000000, 1) . 'B';
        } elseif ($number >= 1000000) {
            $formattedNumber = round($number / 1000000, 1) . 'M';
        } elseif ($number >= 1000) {
            $formattedNumber = round($number / 1000, 1) . 'K';
        } else {
            $formattedNumber = $number;
        }

        return $formattedNumber;
    }
    public function downloadSong(Request $request, $id)
    {
        $song = Song::find($id);
        if (!$song) {
            Toastr::info('Song Not Found');
            return back();
        }
        $pathToFile = public_path('music/' . $song->url);
        if (!File::exists($pathToFile)) {
            Toastr::info('Song Not Found');
            return back();
        }
        $song->downloads = $song->downloads + 1;
        $song->save();
        // $headers['Content-Type'] = 'audio/mpeg';
        $headers = [
            'Content-Type' => 'audio/mpeg',
            'Cache-Control' => 'no-cache, no-store, must-revalidate',
            'Pragma' => 'no-cache',
            'Expires' => '0',
        ];
        return response()->download($pathToFile, $song->name . '.mp3', $headers);
    }


    public function getAll()
    {
        $songs = Song::where('status', '<>', '3')
            ->get();
        return view('modules.admin.songs.index', ['songs' => $songs]);
    }

    public function getData()
    {
        $songs = Song::with('artists', 'genres')->get();
        return DataTables::of($songs)->addIndexColumn()
            ->addColumn('name', function ($song) {
                return '<a class="" href="' . route('admin.songs.details', $song->id) . '">' . $song->name . '</a>';
            })
            ->addColumn('status', function ($song) {
                $checked1 = ($song->status == 1) ? 'checked' : '';
                $checked2 = ($song->status == 2) ? 'checked' : '';
                $checked3 = ($song->status == 3) ? 'checked' : '';
                return '
                <label class="song-status"><input type="radio" class="status-radio" data-song-status="' . $song->status . '" data-song-id="' . $song->id . '" name="status_' . $song->id . '" value="1" ' . $checked1 . '> <span>OLD</span> </label>
                <label class="song-status"><input type="radio" class="status-radio" data-song-status="' . $song->status . '" data-song-id="' . $song->id . '" name="status_' . $song->id . '" value="2" ' . $checked2 . '> <span>NEW</span> </label>
                <label class="song-status"><input type="radio" class="status-radio" data-song-status="' . $song->status . '" data-song-id="' . $song->id . '" name="status_' . $song->id . '" value="3" ' . $checked3 . '> <span>C.SOON</span></label>';
            })
            ->addColumn('edit', function ($song) {
                return
                    '<a class="btn edit-btn button" href="' . route('admin.songs.edit', $song->id) . '">
                    <span class="button_lg">
                        <span class="edit-btn button_sl"></span>
                        <span class="button_text">Edit</span>
                    </span>
                 </a>';
            })
            ->addColumn('delete', function ($song) {
                return
                    '<a 
                    onclick="return confirm(\'Are you sure you want to delete this Song?\')"
                    class="btn delete-btn button" href="' . route('admin.songs.delete', $song->id) . '">
                    <span class="button_lg">
                        <span class="delete-btn button_sl"></span>
                        <span class="button_text">Delete</span>
                    </span>
                 </a>';
            })
            ->addColumn('artists', function ($song) {
                $artists = $song->artists->pluck('name')->toArray();
                return implode(', ', $artists);
            })
            ->addColumn('genres', function ($song) {
                $genres = $song->genres->pluck('name')->toArray();
                return implode(', ', $genres);
            })
            ->rawColumns(['name', 'status', 'edit', 'delete'])
            ->make(true);
    }

    public function getSongbyRequest(Request $request)
    {
        $genre_ids = $request->input('genre_ids');
        $artist_ids = $request->input('artist_ids');
        $genre_songs = collect();
        $artist_songs = collect();
        if (isset($genre_ids)) {
            $genre_songs = GenreSong::whereIn('genre_id', $genre_ids)->get();
        }
        if (isset($artist_ids)) {
            $artist_songs = ArtistSong::whereIn('artist_id', $artist_ids)->get();
        }
        $song_ids = collect();
        if ($genre_songs->isNotEmpty() && $artist_songs->isNotEmpty()) {
            $genre_song_ids = $genre_songs->pluck('song_id');
            $artist_song_ids = $artist_songs->pluck('song_id');
            $song_ids = $genre_song_ids->intersect($artist_song_ids);
        } elseif ($genre_songs->isNotEmpty()) {
            $song_ids = $genre_songs->pluck('song_id');
        } elseif ($artist_songs->isNotEmpty()) {
            $song_ids = $artist_songs->pluck('song_id');
        }
        $songs = Song::whereIn('id', $song_ids)
            ->with(['artists', 'genres', 'albums' => function ($query) {
                $query->distinct();
            }])
            ->get();

        $related_artists = collect();
        $related_genres = collect();
        if ($genre_songs->isNotEmpty() && $artist_songs->isEmpty()) {
            $related_artist_ids = ArtistSong::whereIn('song_id', $song_ids)->get()->pluck('artist_id')->unique();
            $related_artists = Artist::whereIn('id', $related_artist_ids)->get();
        }
        if ($genre_songs->isEmpty() && $artist_songs->isNotEmpty()) {
            $related_genre_ids = GenreSong::whereIn('song_id', $song_ids)->get()->pluck('genre_id')->unique();
            $related_genres = Genre::whereIn('id', $related_genre_ids)->get();
        }
        if ($genre_songs->isNotEmpty() && $artist_songs->isNotEmpty()) {
            $related_artist_ids = ArtistSong::whereIn('song_id', $song_ids)->get()->pluck('artist_id')->unique();
            $related_artists = Artist::whereIn('id', $related_artist_ids)->get();

            $related_genre_ids = GenreSong::whereIn('song_id', $song_ids)->get()->pluck('genre_id')->unique();
            $related_genres = Genre::whereIn('id', $related_genre_ids)->get();
        }
        $genres = Genre::get();
        $artists = Artist::get();
        $data = [
            'songs' => $songs,
            'genres' => $genres,
            'artists' => $artists,
            'related_artists' => $related_artists,
            'related_genres' => $related_genres,
        ];
        return response()->json($data);
    }


    public function changeStatus(Request $request)
    {
        $songId = $request->input('song_id');
        $status = $request->input('status');
        $song = Song::findOrFail($songId);
        $song->status = $status;
        $song->save();
        return response()->json(['message' => 'success']);
    }
    public function songDetails($id)
    {
        $song = Song::find($id);
        $songDownloads = $this->formatNumber($song->downloads);
        $lastMonth  = Carbon::now()->subMonth();
        $songReviewsQuantity = Review::where('song_id', $id)->get();
        $songReviewsQuantityLastMonth = Review::where('song_id', $id)->where('created_at', '>=', $lastMonth)->get();
        $songLikesStarLastMonth = Favorite::where('song_id', $id)->where('created_at', '>=', $lastMonth)->count();
        $star = 0;
        $starLastMonth = 0;
        if ($songReviewsQuantity->count() > 0) {
            foreach ($songReviewsQuantity as $key => $value) {
                $star += $value->rating;
                $songReviewsStar = round($star / $songReviewsQuantity->count(), 1);
            }
        } else {
            $songReviewsStar = 0;
        }
        if ($songReviewsQuantityLastMonth->count() > 0) {
            foreach ($songReviewsQuantityLastMonth as $key => $value) {
                $starLastMonth += $value->rating;
                $songReviewsStarLastMonth = round($starLastMonth / $songReviewsQuantityLastMonth->count(), 1);
            }
        } else {
            $songReviewsStarLastMonth = 0;
        }
        $fvrQuantity = Favorite::where('song_id', $id)->count();
        $otherSongs = Song::where('id', '<>', $id)->get();
        return view('modules.home.songs.details', [
            'song' => $song,
            'fvrQuantity' => $fvrQuantity,
            'otherSongs' => $otherSongs,
            'songReviewsStar' => $songReviewsStar,
            'songReviewsQuantity' => $songReviewsQuantity,
            'songReviewsStarLastMonth' => $songReviewsStarLastMonth,
            'songLikesStarLastMonth' => $songLikesStarLastMonth,
            'songDownloads' => $songDownloads
        ]);
    }

    public function adminSongDetails($id)
    {
        $song = Song::find($id);
        $songDownloads = $this->formatNumber($song->downloads);
        $lastMonth  = Carbon::now()->subMonth();
        $songReviewsQuantity = Review::where('song_id', $id)->get();
        $songReviewsQuantityLastMonth = Review::where('song_id', $id)->where('created_at', '>=', $lastMonth)->get();
        $songLikesStarLastMonth = Favorite::where('song_id', $id)->where('created_at', '>=', $lastMonth)->count();
        $star = 0;
        $starLastMonth = 0;
        if ($songReviewsQuantity->count() > 0) {
            foreach ($songReviewsQuantity as $key => $value) {
                $star += $value->rating;
                $songReviewsStar = round($star / $songReviewsQuantity->count(), 1);
            }
        } else {
            $songReviewsStar = 0;
        }
        if ($songReviewsQuantityLastMonth->count() > 0) {
            foreach ($songReviewsQuantityLastMonth as $key => $value) {
                $starLastMonth += $value->rating;
                $songReviewsStarLastMonth = round($starLastMonth / $songReviewsQuantityLastMonth->count(), 1);
            }
        } else {
            $songReviewsStarLastMonth = 0;
        }
        $fvrQuantity = Favorite::where('song_id', $id)->count();
        $otherSongs = Song::where('id', '<>', $id)->get();
        return view('modules.admin.songs.details', [
            'song' => $song,
            'fvrQuantity' => $fvrQuantity,
            'otherSongs' => $otherSongs,
            'songReviewsStar' => $songReviewsStar,
            'songReviewsQuantity' => $songReviewsQuantity,
            'songReviewsStarLastMonth' => $songReviewsStarLastMonth,
            'songLikesStarLastMonth' => $songLikesStarLastMonth,
            'songDownloads' => $songDownloads
        ]);
    }

    public function add()
    {
        $artists = Artist::all();
        $genres = Genre::all();
        $albums = Album::all();
        return view('modules.admin.songs.add', [
            'artists' => $artists,
            'genres' => $genres,
            'albums' => $albums
        ]);
    }

    public function addMany()
    {
        return view('modules.admin.songs.add-many');
    }

    public function infoSong(Request $request)
    {
        $song = $request->file('song');
        $artistsMulti = [];
        $genresMulti = [];
        $albumsMulti = [];
        $fileName = $song->getClientOriginalName();
        $filePath = public_path('music') . DIRECTORY_SEPARATOR . $fileName;
        $getID3 = new getID3();
        $fileInfo = $getID3->analyze($filePath);
        $tags = isset($fileInfo['tags']) ? $fileInfo['tags'] : null;
        $title = isset($tags['id3v2']['title'][0]) ? $tags['id3v2']['title'][0] : null;
        $genresArr = isset($tags['id3v2']['genre']) ? $tags['id3v2']['genre'] : null;
        $artistsArr = isset($tags['id3v2']['artist']) ? $tags['id3v2']['artist'] : null;
        $albumsArr = isset($tags['id3v2']['album']) ? $tags['id3v2']['album'] : null;
        if (is_array($artistsArr)) {
            $artistsMulti[] = $artistsArr;
        }
        if (is_array($genresArr)) {
            $genresMulti[] = $genresArr;
        }
        if (is_array($albumsArr)) {
            $albumsMulti[] = $albumsArr;
        }
        $duration = '00:00:00';
        if (isset($fileInfo['playtime_seconds'])) {
            $duration = gmdate('H:i:s', $fileInfo['playtime_seconds']);
        }

        $flatArtistsMulti = array_merge(...$artistsMulti);
        $artistsSongFile = [];
        foreach ($flatArtistsMulti as $item) {
            $subArray = explode(', ', $item);
            $artistsSongFile = array_merge($artistsSongFile, $subArray);
        }
        $artistsSongFile = array_unique($artistsSongFile);

        $flatGenresMulti = array_merge(...$genresMulti);
        $genresSongFile = [];
        foreach ($flatGenresMulti as $item) {
            $subArray = explode(', ', $item);
            $genresSongFile = array_merge($genresSongFile, $subArray);
        }
        $genresSongFile = array_unique($genresSongFile);

        $flatAlbumsMulti = array_merge(...$albumsMulti);
        $albumsSongFile = [];
        foreach ($flatAlbumsMulti as $item) {
            $subArray = explode(', ', $item);
            $albumsSongFile = array_merge($albumsSongFile, $subArray);
        }
        $albumsSongFile = array_unique($albumsSongFile);

        $songGenreIdInDB = Genre::whereIn('name', $genresSongFile)->pluck('id')->toArray();
        $songArtistIdInDB = Artist::whereIn('name', $artistsSongFile)->pluck('id')->toArray();
        $songAlbumIdInDB = Album::whereIn('name', $albumsSongFile)->pluck('id')->toArray();

        return response()->json([
            'title' => $title,
            'fileName' => $fileName,
            'duration' => $duration,
            'artistsSongFile' => $artistsSongFile,
            'genresSongFile' => $genresSongFile,
            'albumsSongFile' => $albumsSongFile,
            'songGenreIdInDB' => $songGenreIdInDB,
            'songArtistIdInDB' => $songArtistIdInDB,
            'songAlbumIdInDB' => $songAlbumIdInDB
        ]);
    }

    public function store(StoreRequest $request)
    {
        $user = auth()->user();
        $song = $request->only(
            'name',
            'url',
            'musician',
            'status',
            'img_url',
            'lyric',
            'duration',
            'description'
        );
        $artistsSongFile = json_decode($request->input('artistsSongFile'));
        if (!$artistsSongFile && !$request->artist) {
            $request->validate(
                [
                    'artist' => 'required',
                ]
            );
        }
        $idNewArtist = [];
        if ($artistsSongFile) {
            foreach ($artistsSongFile as $key => $item) {
                $checkExist = Artist::where('name', $item)->first();
                if (!$checkExist) {
                    $idNew = Artist::insertGetId([
                        'user_id' => $user->id,
                        'name' => $item,
                        'img_url' => null,
                        'bio' => 'No Info!!',
                        'created_at' => now()
                    ]);
                    $idNewArtist[] = $idNew;
                }
            }
        }

        $genresSongFile = json_decode($request->input('genresSongFile'));
        if (!$genresSongFile && !$request->genre) {
            $request->validate(
                [
                    'genre' => 'required',
                ]
            );
        }
        $idNewGenre = [];
        if ($genresSongFile) {
            foreach ($genresSongFile as $key => $item) {
                $checkExist = Genre::where('name', $item)->first();
                if (!$checkExist) {
                    $idNew = Genre::insertGetId([
                        'user_id' => $user->id,
                        'name' => $item,
                        'description' => 'No Description',
                        'img_url' => null,
                        'created_at' => now()
                    ]);
                    $idNewGenre[] = $idNew;
                }
            }
        }

        $albumsSongFile = json_decode($request->input('albumsSongFile'));
        $idNewAlbum = [];
        if ($albumsSongFile) {
            foreach ($albumsSongFile as $key => $item) {
                $checkExist = Album::where('name', $item)->first();
                if (!$checkExist) {
                    $idNew = Album::insertGetId([
                        'user_id' => $user->id,
                        'name' => $item,
                        'release_date' => null,
                        'description' => 'No Description',
                        'img_url' => null,
                        'created_at' => now()
                    ]);
                    $idNewAlbum[] = $idNew;
                }
            }
        }

        $song['user_id'] = $user->id;
        if ($request->status == "3") {
            $request->validate(
                [
                    'release_date' => 'required',
                ]
            );
        }
        if ($request->url) {
            $mp3 = $request->url;
            $mp3name = $mp3->getClientOriginalName();
            if (!file_exists(public_path('music/' . $mp3name))) {
                $mp3name->move(public_path('music/'), $mp3name);
            }

            $filePath = public_path('music') . DIRECTORY_SEPARATOR . $mp3name;
            $getID3 = new \getID3();
            $fileInfo = $getID3->analyze($filePath);
            if (array_key_exists('playtime_seconds', $fileInfo)) {
                $duration = gmdate('H:i:s', $fileInfo['playtime_seconds']);
            } else {
                $duration = 0;
            }
            $song['duration'] = $duration;
            $song['url'] = $mp3name;
        }
        if ($request->img_url) {
            $img = $request->img_url;
            $imgname = time() . '_' .  $img->getClientOriginalName();
            if (!file_exists(public_path('img/song/' . $img))) {
                $img->move(public_path('img/song'), $imgname);
            }
            $song['img_url'] = $imgname;
        }
        $song['created_at'] = new DateTime();
        if (!$request->input('musician')) {
            $song['musician'] = 'No Information';
        }
        if (!$request->input('lyric')) {
            $song['lyric'] = 'No Information';
        }
        if (!$request->input('description')) {
            $song['description'] = 'No Description';
        }


        $song = Song::create($song);
        $checkedGenres = json_decode($request->input('checkedGenres'));
        foreach ($idNewGenre as $key => $id) {
            array_push($checkedGenres, $id);
        }
        foreach ($checkedGenres as $item) {
            $song->genres()->attach($item, ['created_at' => now()]);
        }

        $checkedArtists = json_decode($request->input('checkedArtists'));
        foreach ($idNewArtist as $key => $id) {
            array_push($checkedArtists, $id);
        }
        foreach ($checkedArtists as $item) {
            $song->artists()->attach($item, [
                'created_at' => now()
            ]);
        }


        $checkedAlbums = json_decode($request->input('checkedAlbums'));
        foreach ($idNewAlbum as $key => $id) {
            array_push($checkedAlbums, $id);
        }
        foreach ($checkedAlbums as $item) {
            $song->albums()->attach($item, [
                'created_at' => now()
            ]);
        }


        $validator = Validator::make($request->all(), $request->rules());
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        Toastr::success('The Song has been created successfully.', 'Success!');
        return redirect()->route('admin.songs.all');
    }

    public function storeManySong(StoreManyRequest $request)
    {
        $user = auth()->user();
        if (!$request->hasFile('url')) {
            return back()->withErrors('url','The File Field Is Required.');
        }
        foreach ($request->file('url') as $song) {
            $artistsMulti = [];
            $genresMulti = [];
            $fileName = $song->getClientOriginalName();
            $filePath = public_path('music') . DIRECTORY_SEPARATOR . $fileName;
            $getID3 = new getID3();
            $fileInfo = $getID3->analyze($filePath);
            $tags = isset($fileInfo['tags']) ? $fileInfo['tags'] : null;
            $title = isset($tags['id3v2']['title'][0]) ? $tags['id3v2']['title'][0] : null;
            $genresArr = isset($tags['id3v2']['genre']) ? $tags['id3v2']['genre'] : null;
            $artistsArr = isset($tags['id3v2']['artist']) ? $tags['id3v2']['artist'] : null;
            if (is_array($artistsArr)) {
                $artistsMulti[] = $artistsArr;
            }
            if (is_array($genresArr)) {
                $genresMulti[] = $genresArr;
            }
            $duration = '00:00:00';
            if (isset($fileInfo['playtime_seconds'])) {
                $duration = gmdate('H:i:s', $fileInfo['playtime_seconds']);
            }

            if (!file_exists(public_path('music/' . $fileName))) {
                $song->move(public_path('music/'), $fileName);
            }

            Song::insert([
                'user_id' => $user->id,
                'name' =>  $title ? $title : $fileName,
                'img_url' => 'https://i.postimg.cc/mrg9mz3N/image.png',
                'url' =>  $fileName,
                'duration' => $duration,
                'description' => $fileName,
                'lyric' => 'No Information',
                'musician' => /* isset($tags['id3v2']['artist']) ? implode(', ', $tags['id3v2']['artist']) : */ 'No Information',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $flatArtistsMulti = array_merge(...$artistsMulti);
            $artistsSongFile = [];
            foreach ($flatArtistsMulti as $item) {
                $subArray = explode(', ', $item);
                $artistsSongFile = array_merge($artistsSongFile, $subArray);
            }
            $artistsSongFile = array_unique($artistsSongFile);
            foreach ($artistsSongFile as $item) {
                $artistName = mb_strtolower($item);
                $exists = Artist::where('name', $artistName)->first();
                if (!$exists) {
                    Artist::insertGetId([
                        'user_id' => $user->id,
                        'name' => $artistName,
                        'img_url' => 'https://i.postimg.cc/mrg9mz3N/image.png',
                        'bio' => 'No Information',
                        'created_at' => now(),
                    ]);
                    Album::insertGetId([
                        'user_id' => $user->id,
                        'name' => 'album ' . $artistName,
                        'release_date' => '2021-01-01',
                        'img_url' => 'https://i.postimg.cc/mrg9mz3N/image.png',
                        'created_at' => now(),
                    ]);
                }
            }

            $idAtists = Artist::whereIn('name', $artistsSongFile)->pluck('id');
            $idSong = Song::where('name', $title ? $title : $fileName)->pluck('id');

            foreach ($idAtists as $id) {
                if ($id != null) {
                    ArtistSong::insert([
                        'artist_id' => $id,
                        'song_id' => $idSong[0],
                        'created_at' => now(),
                    ]);
                }
            }

            $flatGenresMulti = array_merge(...$genresMulti);
            $genresSongFile = [];
            foreach ($flatGenresMulti as $item) {
                $subArray = explode(', ', $item);
                $genresSongFile = array_merge($genresSongFile, $subArray);
            }
            $genresSongFile = array_unique($genresSongFile);
            foreach ($genresSongFile as $genreName) {
                $exists = Genre::where('name', $genreName)->first();
                if (!$exists) {
                    Genre::insertGetId([
                        'user_id' => $user->id,
                        'name' => $genreName,
                        'img_url' => 'https://i.postimg.cc/KzY53psb/image.png',
                        'description' => 'No Description',
                        'created_at' => now(),
                    ]);
                }
            }

            $idGenres = Genre::whereIn('name', $genresArr)->pluck('id');
            foreach ($idGenres as $id) {
                if ($id != null) {
                    GenreSong::insert([
                        'genre_id' => $id,
                        'song_id' => $idSong[0],
                        'created_at' => now(),
                    ]);
                }
            }

            $artistsSongFile = array_map(function ($artist) {
                return 'album ' . $artist;
            }, $artistsSongFile);
            $idAlbums = Album::whereIn('name',  $artistsSongFile)->pluck('id');
            foreach ($idAlbums as $id) {
                AlbumSong::insert([
                    'album_id' => $id,
                    'song_id' => $idSong[0],
                    'created_at' => now(),
                ]);
            }
        }

        Toastr::success('Add Songs successfully', 'Success!');
        return redirect()->route('admin.songs.all');
    }

    public function edit($id)
    {
        $artists = Artist::all();
        $genres = Genre::all();
        $albums = Album::all();
        $song = Song::where('id', $id)->with('artists', 'genres')->first();
        $songArtists = $song->artists;
        $songGenres = $song->genres;
        $songAlbums = $song->albums;
        return view('modules.admin.songs.edit', [
            'song' => $song,
            'artists' => $artists,
            'albums' => $albums,
            'genres' => $genres,
            'songArtists' => $songArtists,
            'songGenres' => $songGenres,
            'songAlbums' => $songAlbums
        ]);
    }

    public function update($id, UpdateRequest $request)
    {
        $user = auth()->user();
        $song = Song::find($id);
        $data = $request->except(
            '_token',
            'url',
            'img_url',
            'genre',
            'artist',
            'select-artist',
            'select-genre',
            'checkedGenres',
            'checkedArtists'
        );
        $data['user_id'] = $user->id;

        if ($request->url || $request->img_url) {
            $request->validate([
                'url' => 'mimes:mp3|max:500000',
                'img_url' => 'mimes:jpeg,png,gif|max:500000',

            ]);
        }
        if ($song->status == "3") {
            $request->validate(
                [
                    'release_date' => 'required',
                ]
            );
        }
        if ($request->url) {
            $mp3 = $request->url;
            $mp3name = time() . '_' .  $mp3->getClientOriginalName();
            if (!file_exists(public_path('music/' . $mp3))) {
                $mp3->move(public_path('music/'), $mp3name);
            }

            $filePath = public_path('music') . DIRECTORY_SEPARATOR . $mp3name;
            $getID3 = new \getID3();
            $fileInfo = $getID3->analyze($filePath);
            if (array_key_exists('playtime_seconds', $fileInfo)) {
                $duration = gmdate('H:i:s', $fileInfo['playtime_seconds']);
            } else {
                $duration = 0;
            }
            $data['duration'] = $duration;
            $data['url'] = $mp3name;
        }
        if ($request->img_url) {
            $img = $request->file('img_url');
            $imgname = time() . '_' .  $img->getClientOriginalName();
            $img->move(public_path('img/song'), $imgname);
            $data['img_url'] = $imgname;
        }
        if (!$request->input('musician')) {
            $data['musician'] = 'No Information';
        }
        if (!$request->input('lyric')) {
            $data['lyric'] = 'No Information';
        }
        $data['updated_at'] = new DateTime();
        $song->update($data);
        $song->genres()->detach();
        $song->artists()->detach();
        $song->albums()->detach();
        $checkedGenres = json_decode($request->input('checkedGenres'));
        foreach ($checkedGenres as $item) {
            $song->genres()->attach($item, ['created_at' => now()]);
        }

        $checkedArtist = json_decode($request->input('checkedArtists'));
        foreach ($checkedArtist as $item) {
            $song->artists()->attach($item, ['created_at' => now()]);
        }

        $checkedAlbums = json_decode($request->input('checkedAlbums'));
        foreach ($checkedAlbums as $item) {
            $song->albums()->attach($item, ['created_at' => now()]);
        }

        $validator = Validator::make($request->all(), $request->rules());
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        Toastr::success('The Song has been updated successfully.', 'Success!');
        return response()->json(['success' => true]);
    }

    public function delete($id)
    {
        AlbumSong::where('song_id', $id)->delete();
        GenreSong::where('song_id', $id)->delete();
        ArtistSong::where('song_id', $id)->delete();
        Favorite::where('song_id', $id)->delete();
        History::where('song_id', $id)->delete();
        PlaylistSong::where('song_id', $id)->delete();
        Review::where('song_id', $id)->delete();
        Song::where('id', $id)->delete();
        Toastr::success('The Song has been deleted successfully.', 'Success!');
        return redirect()->route('admin.songs.all');
    }


    public function songInQueue()
    {
        $user = auth()->user();
        $songIds = Favorite::where('user_id', $user->id)->pluck('song_id')->toArray();
        return response()->json($songIds);
    }

    public function getAlbums($artistId)
    {
        $albums = Album::where('artist_id', $artistId)->get();
        return response()->json($albums);
    }
}
