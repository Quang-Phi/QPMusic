<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;
    protected $table = "histories";
    protected $fillable = [
        'user_id',
        'song_id',
        'album_id',
        'created_at',
        'updated_at'
    ];

    public function song()
    {
        return $this->belongsTo(Song::class);
    }
}
