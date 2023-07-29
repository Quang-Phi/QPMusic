<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    use HasFactory;
    protected $table = "users_info";
    protected $fillable = [
        'name',
        'address',
        'phone',
        'gender',
        'avatar',
        'user_id',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
    ];

    public function user()
    {
        return $this->belongsTo(Users::class);
    }
}
