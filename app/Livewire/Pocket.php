<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\item;

class Pocket extends Component
{
    public $player = 'player'; //change to player's name

    public function render()
    {
        return view('livewire.pocket', [
            'items' => Item::whereNull('room_id')
                ->where('is_visible', true)
                ->get()
        ]);
    }
}

