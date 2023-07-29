<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    use HasFactory;
    protected $table = "songs";
    protected $fillable = [
        'user_id',
        'name',
        'img_url',
        'url',
        'musician',
        'lyric',
        'duration',
        'status',
        'description',
        'release_date',
        'downloads',
        'created_at',
        'updated_at'
    ];

    public function albums()
    {
        return $this->belongsToMany(Album::class, 'album_song', 'song_id', 'album_id');
    }

    public function artists()
    {
        return $this->belongsToMany(Artist::class, 'artist_song', 'song_id', 'artist_id');
    }

    public function genres()
    {
        return $this->belongsToMany(Genre::class, 'genre_song', 'song_id', 'genre_id');
    }

    public function histories()
    {
        return $this->hasMany(History::class);
    }

    public function playlists(){
        return $this->belongsToMany(Playlist::class, 'playlist_song', 'playlist_id', 'song_id');
    }

    public function reviews(){
        return $this->hasMany(Review::class);
    }
}
