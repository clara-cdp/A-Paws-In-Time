<?php

namespace App\Livewire;

use App\Game\GameState;
use App\Game\GameAction;

use App\Models\event;
use App\Models\Item;
use App\Models\Room;

use Livewire\Component;
use Livewire\Attributes\On;

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
        GameState::fromSession()->setTargetItemId($id);

        $message = app(GameAction::class)->tryEvent();

        if ($message) {
            $this->dispatch('show-dialog', text: $message);
        }
    }

    public function render()
    {
        $room = Room::findOrFail(1);
        $items = Item::where('room_id', $room->id)->get();

        $this->dispatch('room-items-loaded', items: $items);

        return view('livewire.playroom', [
            'room'     => $room,
            'roomType' => $room->room_type->value, 
            'items' => $items
           
        ]);
    }

}


