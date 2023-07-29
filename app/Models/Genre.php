<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    use HasFactory;
    protected $table = "genres";

    protected $fillable = [
        'user_id',
        'name',
        'img_url',
        'description',
        'created_at',
        'updated_at'
    ];

    public function songs()
    {
        return $this->belongsToMany(Song::class, 'genre_song', 'genre_id', 'song_id');
    }


}
