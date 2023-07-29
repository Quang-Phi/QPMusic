<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;
    protected $table = "albums";
    protected $fillable = [
        'user_id',
        'name',
        'release_date',
        'description',
        'img_url',
        'created_at',
        'updated_at'
    ];
    public function songs()
    {
        return $this->belongsToMany(Song::class, 'album_song', 'album_id', 'song_id');
    }
    
    public function artists()
    {
        return $this->songs()->with('artists');
    }

    public function reviews (){
        return $this->hasMany(Review::class);
    }
}
