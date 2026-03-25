<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PocketItem extends Model
{
    protected $fillable = [
        'pocket_id',
        'item_id'
    ];
    /** @use HasFactory<\Database\Factories\PocketItemFactory> */
    use HasFactory;
}

