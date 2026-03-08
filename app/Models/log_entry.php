<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class log_entry extends Model
{
    protected $fillable = [
        'player_id',
        'event_id'
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function player()
    {
        return $this->belongsTo(Player::class);
    }
    
    /** @use HasFactory<\Database\Factories\LogEntryFactory> */
    use HasFactory;
}
