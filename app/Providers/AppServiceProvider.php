<?php

namespace App\Providers;

use App\Models\Playlist;
use App\Models\User;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */

    public function boot()
    {
        view()->composer('*', function ($view) {
            if (auth()->check()) {
                $user_id = auth()->user()->id;
                $user = User::join('users_info', 'users.id', '=', 'users_info.user_id')
                    ->select(
                        'users.is_active',
                        'users.is_premium',
                        'users.role',
                        'users.id',
                        'users.email',
                        'users_info.name',
                        'users_info.address',
                        'users_info.phone',
                        'users_info.gender',
                        'users_info.avatar'
                    )
                    ->where('users.id', $user_id)
                    ->first();
                $checkPremium = $user->is_premium;
                $playlists = Playlist::where('user_id', $user_id)->orderBy('created_at', 'desc')->get();
                $view->with([
                    'user' => $user,
                    '$checkPremium' => $checkPremium,
                    'playlists' => $playlists
                ]);
            }
        });
    }
}
