<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;

use App\Game\GameState;
use App\Game\GameAction;
use App\Enums\Verb;

use App\Livewire\Playroom;
use Livewire\Component;

use App\Models\Item;
use App\Models\Player;
use App\Models\User;

use Livewire\Attributes\On;

class Pocket extends Component
{

    public $playerName = '';

    public function mount()
    {
        $player = Auth::user()->player;
        $this->playerName = $player->character_name ?? 'Guest';
    }

    #[On('pocket-update')]
    public function updatePocket() {}

    public function selectItem(int $itemId)
    {
        $state = GameState::fromSession();
        $state->setItem($itemId);

        $verb = $state->getVerb();

        if ($verb === Verb::LOOK_AT) {
            $state->setTargetItemId($itemId);
            $message = app(GameAction::class)->tryEvent();

            if ($message) {
                $this->dispatch('show-dialog', text: $message);
               // $this->dispatch('inventory-updated');
            }
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
