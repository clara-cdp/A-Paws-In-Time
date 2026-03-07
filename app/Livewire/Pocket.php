<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;

use App\Game\GameState;
use App\Game\GameAction;

use Livewire\Component;
use App\Models\Item;
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

    public function selectItem(int $itemId){
        GameState::fromSession()->setItem($itemId);
        app(GameAction::class)->tryEvent();
    }

    public function clickItem(int $id)
    {
        GameState::fromSession()->setTargetItemId($id);

        $message = app(GameAction::class)->tryEvent();

        if ($message) {
            $this->dispatch('show-dialog', text: $message);
        }
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


