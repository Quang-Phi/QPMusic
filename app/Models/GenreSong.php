<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GenreSong extends Model
{
    use HasFactory;
    protected $table = 'genre_song';

    protected $fillable = [
        'genre_id',
        'song_id',
    ];

    public $timestamps = false;
}
