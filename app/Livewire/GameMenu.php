<?php

namespace App\Livewire;

use Livewire\Component;

class GameMenu extends Component
{
    
    public $activeVerb = ""; 
   
    public function setActiveVerb($verb){
        
        $this->activeVerb = $verb;
    }

    public function render()
    {
        return view('livewire.game-menu');
    }
}
