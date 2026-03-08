<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
    'description', 
    'image_url', 
    'is_portable', 
    'is_visible', 
    'room_id',
    'event_id',
    'player_id',
    'css_id',
     ];

    /** @use HasFactory<\Database\Factories\ObjectFactory> */
    use HasFactory;

    public static function starter(): self
    {
        return self::withoutGlobalScopes()
            ->where('css_id', 'fish')
            ->firstOrFail();
    }

    public function pockets()
    {
        return $this->belongsToMany(Pocket::class, 'pocket_items');
    }

    protected static function booted()
    {
        static::addGlobalScope('player', function (Builder $builder) {

            if (Auth::check()) {
                $playerId = Auth::user()->player?->id;

                if ($playerId) {
                    $builder->where('player_id', $playerId);
                }
            }
        });
    }
    
}
