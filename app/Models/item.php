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
            ->whereNull('player_id')
            ->firstOrFail();
    }

    public function pockets()
    {
        return $this->belongsToMany(Pocket::class, 'pocket_items');
    }

    protected static function booted()
    {
        static::addGlobalScope('player', function (Builder $builder) {
            
            $activePlayerId = session('active_player_id');

            if ($activePlayerId) {
                $builder->where('player_id', $activePlayerId);
            } else {
        
                $builder->whereNull('player_id');
            }
        });
    }
    
}
