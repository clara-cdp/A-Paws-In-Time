<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\RoomType;

class room extends Model
{
    protected $fillable = ['name', 'description', 'image_url','room_type'];

    protected $casts = [
        'room_type' => RoomType::class,
    ];

    public static function startingRoom()
{
    return self::where('name', 'The Garden')->firstOrFail();
}
    
    /** @use HasFactory<\Database\Factories\RoomFactory> */
    use HasFactory;
}
