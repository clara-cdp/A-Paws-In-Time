<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
    'name', 
    'css_id', 
    'description', 
    'image_url', 
    'is_portable', 
    'is_visible', 
    'room_id',
    'event_id',
    'css_id',
    'pos_x',
    'pos_y'];

    /** @use HasFactory<\Database\Factories\ObjectFactory> */
    use HasFactory;

    public static function starter(): self
    {
        return self::where('css_id', 'fish')->firstOrFail();
    }

    public function pockets()
    {
        return $this->belongsToMany(Pocket::class, 'pocket_items');
    }
}
