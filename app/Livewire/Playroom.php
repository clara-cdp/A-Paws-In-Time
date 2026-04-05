<?php

namespace App\Livewire;

use App\Providers\Game\GameState;
use App\Providers\Game\GameAction;

use App\Models\event;
use App\Models\Item;
use App\Models\Room;
use App\Models\Player;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\User;

use Illuminate\Support\Facades\Auth;

class Playroom extends Component
{
    #[On('roomItemClicked')]
    public function handleRoomItemClick($css_id)
    {
        $item = Item::where('css_id', $css_id)->first();

        if ($item) {
            $this->clickItem($item->id);
        }
    }

    public function clickItem(int $id)
    {
        //$player = Auth::user()->Player;
        $player = Player::find(session('active_player_id'));
        $startingRoomId = $player->room_id;

        GameState::fromSession()->setTargetItemId($id);
        $message = app(GameAction::class)->tryEvent();

        $player->refresh();

        if ($startingRoomId !== $player->room_id) {
            $this->js('window.location.reload();');
            return; 
        }

        if ($message) {
            $this->dispatch('show-dialog', text: $message);

            $this->dispatch('pocket-update');

            $clickedItem = \App\Models\Item::find($id);

            // TODO: move this
            if ($clickedItem->room_id === null) {
                // room_id = null -> Hidden
                $this->dispatch('hide-item', css_id: $clickedItem->css_id);
            } elseif ($clickedItem->is_visible) {
                // room_id = int & is_visible = true -> dsiplay
                $this->dispatch('show-item', css_id: $clickedItem->css_id);
            } else {
                // room_id = int & is_visible = false -> hidden
                $this->dispatch('hide-item', css_id: $clickedItem->css_id);
            }
        }
    }

    public function render()
    {
        //$player = Auth::user()->Player;
        $player = Player::find(session('active_player_id'));
        //$roomId = $player->room_id ?? 1;
        //$room = Room::findOrFail($roomId);

        $room = Room::findOrFail($player->room_id);
        
        $items = Item::where('room_id', $room->id)->get();
        $removedItems = Item::whereNull('room_id')->pluck('css_id');

        $this->dispatch('room-items-loaded', items: $items, removedItems: $removedItems);

        return view('livewire.playroom', [
            'room'     => $room,
            'roomType' => $room->room_type->value,
            'items' => $items

        ]);
    }
 
}
