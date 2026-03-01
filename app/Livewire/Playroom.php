<?php

namespace App\Livewire;

use App\Models\event;
use Livewire\Component;
use App\Models\item;
use App\Models\room;

class Playroom extends Component
{
    public  $currentRoom = 1; // default

    public function render()
    {
        $room = Room::findOrFail($this->currentRoom);

        return view('livewire.playroom', [
            'room' => $room,
            'roomType' => $room->room_type->value, // from enum
        ]);
    }
}
