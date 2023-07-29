<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    
    use HasFactory;
    protected $table = "favorites";
    protected $fillable = [
        'user_id',
        'artist_id', 
        'song_id', 
        'album_id'
    ];

    public function songs()
    {
        return $this->hasMany(Song::class);
    }

    public function albums()
    {
        return $this->hasMany(Album::class);
    }
}
