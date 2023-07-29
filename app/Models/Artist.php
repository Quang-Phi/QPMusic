<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    use HasFactory;
    protected $table = "artists";
    protected $fillable = [
        'user_id',
        'name',
        'img_url',
        'bio',
        'created_at',
        'updated_at'
    ];
    public function songs()
    {
        return $this->belongsToMany(Song::class, 'artist_song', 'artist_id', 'song_id');
    }

    public function artists()
    {
        return $this->songs()->with('artists');
    }

    public function reviews () {
        return $this->hasMany(Review::class);
    }
}
