<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
//protected $fillable = ['character_name','room_id','pocket_id'];

    protected $fillable = [
        'user_id',
        'character_name',
        'room_id',
        'story_step',
    ];

    /** @use HasFactory<\Database\Factories\PlayerFactory> */
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pocket()
    {
        return $this->hasOne(Pocket::class);
    }
}
