<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements CanResetPassword
{
    use HasFactory, HasApiTokens, Notifiable;
    protected $table = "users";
    public function getAuthIdentifierName()
    {
        return 'id';
    }
    public function getAuthIdentifier()
    {
        return $this->getKey();
    }
    public function getAuthPassword()
    {
        return $this->password;
    }
    public function getRememberToken()
    {
        return $this->remember_token;
    }
    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }
    public function getRememberTokenName()
    {
        return 'remember_token';
    }

    protected $fillable = [
        'email',
        'password',
        'is_premium',
        'is_active',
        'role',
        'created_at',
        'updated_at'
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function info()
    {
        return $this->hasOne(UserInfo::class);
    }

    public function favoriteSongs()
    {
        return $this->belongsToMany(Song::class, 'favorites')->with('artists');;
    }

    public function favoriteAlbums()
    {
        return $this->belongsToMany(Album::class, 'favorites')->with('artists');;
    }

    public function favoriteArtists()
    {
        return $this->belongsToMany(Artist::class, 'favorites')->with('artists');;
    }


    public function listenedSongs()
    {
        return $this->belongsToMany(Song::class, 'histories')->with('artists');;
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function premiumMember()
    {
        return $this->hasOne(Premium::class);
    }

    public function playlists()
    {
        return $this->hasMany(Playlist::class);
    }
};
