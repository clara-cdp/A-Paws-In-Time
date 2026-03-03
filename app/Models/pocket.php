<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pocket extends Model
{
    protected $fillable = ['player_id'];

    public function player()
    {
        return $this->belongsTo(Player::class);
    }
    /** @use HasFactory<\Database\Factories\PocketFactory> */
    use HasFactory;
}
