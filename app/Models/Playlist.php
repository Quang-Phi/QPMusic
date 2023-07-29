<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    use HasFactory;
    protected $table = 'playlists';
    protected $fillable = [
        'id',
        'user_id',
        'name',
        'img_url',
        'description',
        'created_at',
        'updated_at',
    ];

    public function songs()
    {
        return $this->belongsToMany(Song::class, 'playlist_song', 'playlist_id', 'song_id');
    }
}
