<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class event extends Model
{
    protected $fillable = [
    'step_number',
    'verb_trigger', 
    'object_id', 
    'required_object_id', 
    'unlocked_object_id', 
    'target_room_id', 
    'next_step'];
    /** @use HasFactory<\Database\Factories\EventFactory> */
    use HasFactory;
}
