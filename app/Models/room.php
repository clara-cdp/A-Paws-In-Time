<?php

namespace App\Models;

use App\Enums\RoomType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = ['name', 'description', 'image_url', 'room_type'];

    protected $casts = [
        'room_type' => RoomType::class,
    ];

    public static function startingRoom()
    {
        return self::where('name', 'Intro')->firstOrFail();
    }

    /** @use HasFactory<\Database\Factories\RoomFactory> */
    use HasFactory;
}
