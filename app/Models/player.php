<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class player extends Model
{
protected $fillable = ['character_name','room_id','pocket_id'];

    /** @use HasFactory<\Database\Factories\PlayerFactory> */
    use HasFactory;


}
