<?php

use App\Http\Controllers\Admin\Accounts\AccountsController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Albums\AlbumsController;
use App\Http\Controllers\Admin\Artists\ArtistsController;
use App\Http\Controllers\Admin\Favorites\FavoritesController;
use App\Http\Controllers\Admin\Genres\GenresController;
use App\Http\Controllers\Admin\Histories\HistoriesController;
use App\Http\Controllers\Admin\SendNotify\SenNotifyController;
use App\Http\Controllers\Admin\Songs\SongsController;
use App\Http\Controllers\Admin\Telegram\TelegramController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Home\PayController;
use App\Http\Controllers\Home\PlaylistsController;
use App\Http\Controllers\Home\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthController::class, 'index'])->name('index')->middleware('authen');

Route::prefix('/')->group(function () {
    Route::prefix('auth')->controller(AuthController::class)->name('auth.')->group(function () {
        Route::get('login', 'login')->name('login')->middleware('authen');
        Route::get('login/{social}', 'getSocialSignInUrl')->name('get-social-sign-in-url')->middleware('authen');
        Route::get('login/{social}/callback', 'loginCallback')->name('login-callback')->middleware('authen');
        Route::post('authenticate', 'authenticate')->name('authenticate');
        Route::get('register', 'register')->name('register')->middleware('authen');
        Route::post('store', 'store')->name('store');
        Route::get('logout', 'logout')->name('logout');
        Route::get('forgot-password', 'showLinkRequestForm')->name('password.request');
        Route::post('forgot-password', 'sendResetLinkEmail')->name('password.email');
        Route::get('reset-password', 'showResetForm')->name('password.reset');
        Route::post('reset-password', 'reset')->name('password.update');
    });

    Route::prefix('user')->controller(UserController::class)->name('user.')->middleware('client')->group(function () {
        Route::get('profile', 'profile')->name('profile');
        Route::get('profile/edit', 'edit')->name('profile.edit');
        Route::post('profile/update', 'update')->name('profile.update');
        Route::get('premium', 'premium')->name('premium');
    });

    Route::get('send-notify', [SenNotifyController::class, 'sendNotify'])->name('send-notify')->middleware('client');
    Route::get('send-massage/{data}/{type}', [TelegramController::class, 'sendMassage'])->name('send-massage')->middleware('client');

    Route::prefix('payment')->controller(PayController::class)->name('payment.')->middleware('client')->group(function () {
        Route::post('request', 'requestPayment')->name('request');
        Route::get('success/{package}', 'paymentSuccess')->name('success');
        Route::get('cancel/{package}', 'paymentCancel')->name('cancel');
    });
});

Route::prefix('home')->controller(HomeController::class)->name('home.')->middleware('client')->group(function () {
    Route::get('index', 'index')->name('index');

    Route::get('genres', [GenresController::class, 'index'])->name('genres');
    Route::get('genre-details/{id}', [GenresController::class, 'genreDetails'])->name('genre-details');

    Route::get('song-details/{id}', [SongsController::class, 'songDetails'])->name('song-details');
    Route::get('song-in-queue', [SongsController::class, 'songInQueue'])->name('song-in-queue');
    Route::get('download-song/{id}', [SongsController::class, 'downloadSong'])->name('download-song');

    Route::get('albums', [AlbumsController::class, 'index'])->name('albums');
    Route::get('album-details/{id}', [AlbumsController::class, 'albumDetails'])->name('album-details');
    Route::get('get-artsist-in-album/{id}', [AlbumsController::class, 'getArtistInAlbum'])->name('get-artsist-in-album');

    Route::get('artists', [ArtistsController::class, 'index'])->name('artists');
    Route::get('artist-details/{id}', [ArtistsController::class, 'artistDetails'])->name('artist-details');

    Route::get('playlists', [PlaylistsController::class, 'index'])->name('playlists');
    Route::get('playlist-details/{id}', [PlaylistsController::class, 'playlistDetails'])->name('playlist-details');
    Route::post('create-playlist', [PlaylistsController::class, 'createPlaylist'])->name('create-playlist');
    Route::post('update-playlist/{id}', [PlaylistsController::class, 'updatePlaylist'])->name('update-playlist');
    Route::get('delete-playlist/{id}', [PlaylistsController::class, 'deletePlaylist'])->name('delete-playlist');
    Route::get('get-artsist-in-playlist/{id}', [PlaylistsController::class, 'getArtistInPlaylist'])->name('get-artsist-in-playlist');
    Route::post('add-song-to-playlist/{playlistId}/{idSuggest}', [PlaylistsController::class, 'addSongToPlaylist'])->name('add-song-to-playlist');
    Route::get('remove-song-from-playlist/{id}', [PlaylistsController::class, 'removeSongFromPlaylist'])->name('remove-song-from-playlist');

    Route::get('favorites', [FavoritesController::class, 'index'])->name('favorites');
    Route::post('favorites-item/{id}', [FavoritesController::class, 'addFavorite'])->name('favorites-item');
    Route::post('data-favorites-item/{id}', [FavoritesController::class, 'dataFavoriteItem'])->name('data-favorites-item');

    Route::get('histories', [HistoriesController::class, 'index'])->name('histories');
    Route::post('histories-add/{id}', [HistoriesController::class, 'addHistories'])->name('histories-add');

    Route::get('load-more', 'loadMore')->name('load-more');
    Route::post('review/{id}', 'review')->name('review');
    Route::get('search', 'search')->name('search');
});

Route::prefix('admin')->name('admin.')->controller(AdminController::class)->middleware('admin')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::post('add-todo', 'addTodo')->name('add-todo');
    Route::post('delete-todo/{id}', 'deleteTodo')->name('delete-todo');
    Route::post('update-todo/{id}', 'updateTodo')->name('update-todo');
    Route::post('change-status-todo/{id}', 'changeStatusTodo')->name('change-status-todo');
    Route::get('get-event', 'getEvent')->name('get-event');
    Route::post('create-event', 'createEvent')->name('create-event');
    Route::get('delete-event/{id}', 'deleteEvent')->name('delete-event');
    Route::post('update-event/{id}', 'updateEvent')->name('update-event');
    Route::prefix('accounts')->controller(AccountsController::class)->name('accounts.')->group(function () {
        Route::get('all', 'getAll')->name('all');
        Route::get('data', 'getData')->name('data');
        Route::get('add', 'add')->name('add');
        Route::post('store', 'store')->name('store');
        Route::get('profile/{id}', 'profile')->name('profile');
        Route::get('data-transactions/{id}', 'dataTransactions')->name('data-transactions');
        Route::get('edit/{id}', 'edit')->name('edit');
        Route::post('update/{id}', 'update')->name('update');
        Route::post('change-status/{id}', 'changeStatus')->name('change-status');
        Route::post('change-role/{id}', 'changeRole')->name('change-role');
    });
    Route::prefix('genres')->controller(GenresController::class)->name('genres.')->group(function () {
        Route::get('all', 'getAll')->name('all');
        Route::get('data', 'getData')->name('data');
        Route::get('details/{id}', 'adminGenreDetails')->name('details');
        Route::get('data-genre-details/{id}', 'adminDataGenreDetails')->name('data-genre-details');
        Route::get('add', 'add')->name('add');
        Route::post('store', 'store')->name('store');
        Route::get('edit/{id}', 'edit')->name('edit');
        Route::post('update/{id}', 'update')->name('update');
        Route::POST('update-song-genre/{id}', 'updateSongGenre')->name('update-song-genre');
        Route::get('delete/{id}', 'delete')->name('delete');
        Route::get('delete-song-from-genre/{genre_id}/{song_id}', 'deleteSongFromGenre')->name('delete-song-from-genre');
        Route::get('change-song-genre/{id}', 'changeSongGenre')->name('change-song-genre');
    });
    Route::prefix('albums')->controller(AlbumsController::class)->name('albums.')->group(function () {
        Route::get('data', 'getData')->name('data');
        Route::get('all', 'getAll')->name('all');
        Route::get('details/{id}', 'adminAlbumDetails')->name('details');
        Route::get('data-albums-details/{id}', 'adminDataAlbumsDetails')->name('data-albums-details');
        Route::get('add', 'add')->name('add');
        Route::post('store', 'store')->name('store');
        Route::get('edit/{id}', 'edit')->name('edit');
        Route::post('update/{id}', 'update')->name('update');
        Route::get('delete/{id}', 'delete')->name('delete');
        Route::get('delete-song-from-album/{album_id}/{song_id}', 'deleteSongFromAlbum')->name('delete-song-from-album');
    });
    Route::prefix('artists')->controller(ArtistsController::class)->name('artists.')->group(function () {
        Route::get('all', 'getAll')->name('all');
        Route::get('data', 'getData')->name('data');
        Route::get('details/{id}', 'adminArtistDetails')->name('details');
        Route::get('data-artist-details/{id}', 'adminDataArtistDetails')->name('data-artist-details');
        Route::get('add', 'add')->name('add');
        Route::post('store', 'store')->name('store');
        Route::get('edit/{id}', 'edit')->name('edit');
        Route::post('update/{id}', 'update')->name('update');
        Route::POST('update-one-song-artist/{artist_id}/{song_id}', 'updateOneSongArtist')->name('update-one-song-artist');
        Route::POST('update-song-artist/{id}', 'updateSongArtist')->name('update-song-artist');
        Route::get('delete/{id}', 'delete')->name('delete');
        Route::get('delete-song-from-artist/{artist_id}/{song_id}', 'deleteSongFromArtist')->name('delete-song-from-artist');
        Route::get('change-song-artist/{id}', 'changeSongArtist')->name('change-song-artist');
    });
    Route::prefix('songs')->controller(SongsController::class)->name('songs.')->group(function () {
        Route::get('all', 'getAll')->name('all');
        Route::get('data', 'getData')->name('data');
        Route::get('details/{id}', 'adminSongDetails')->name('details');
        Route::post('song-by-request', 'getSongbyRequest')->name('song-by-request');
        Route::get('albums/{artistId}', 'getAlbums')->name('getalbums');
        Route::post('change-status', 'changeStatus')->name('change-status');
        Route::get('add', 'add')->name('add');
        Route::get('add-many', 'addMany')->name('add-many');
        Route::post('store', 'store')->name('store');
        Route::post('info-song', 'infoSong')->name('info-song');
        Route::post('store-many-song', 'storeManySong')->name('store-many-song');
        Route::get('edit/{id}', 'edit')->name('edit');
        Route::post('update/{id}', 'update')->name('update');
        Route::get('delete/{id}', 'delete')->name('delete');
    });
});
