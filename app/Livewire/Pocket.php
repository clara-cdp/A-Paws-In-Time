<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\item;
use App\Models\Player;
use App\Models\User;

class Pocket extends Component
{
    public $playerName = '';

    public function mount()
    {
        $player = Auth::user()->player;
        $this->playerName = $player->character_name ?? 'Guest';
    }

    public function render()
    {
        $player = Auth::user()->player;

        $pocketItems = $player && $player->pocket
            ? $player->pocket->items()->where('is_visible', true)->get()
            : collect();

        return view('livewire.pocket', [
            'items' => $pocketItems
        ]);
    }
    }


