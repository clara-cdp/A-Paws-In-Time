<?php

namespace App\Livewire;

use Livewire\Component;

class GameMenu extends Component
{
    
    public $activeVerb = "lOOK AT"; //by default
   
    public function setActiveVerb($verb){
        $this->reset('activeVerb');
        $this->activeVerb = $verb;
    }

    public function render()
    {
        return view('livewire.game-menu');
    }
}
