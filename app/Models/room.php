<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class room extends Model
{
    protected $fillable = ['name', 'description', 'image_url'];
    
    /** @use HasFactory<\Database\Factories\RoomFactory> */
    use HasFactory;
}
