<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    protected $fillable = [
        'user_id',
        'character_name',
        'room_id',
        'story_step',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function pocket()
    {
        return $this->hasOne(Pocket::class);
    }

    public function logEntries()
    {
        return $this->hasMany(Log_entry::class);
    }

    /** @use HasFactory<\Database\Factories\PlayerFactory> */
    use HasFactory;
}
