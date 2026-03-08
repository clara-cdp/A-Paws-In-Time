<?php

namespace App\Livewire;
use App\Game\GameState;
use App\Enums\Verb;
use Livewire\Component;


class GameMenu extends Component
{

    public $activeVerb = "";

    public function mount()
    {
        $this->activeVerb = GameState::fromSession()->getVerb() ?? "";
    }
   
    public function setActiveVerb($verbValue){

        $verbEnum = Verb::tryFrom($verbValue);

        if ($verbEnum) {
            $this->activeVerb = $verbEnum->value;
            GameState::fromSession()->setVerb($verbEnum);
        }
    }

    public function render()
    {
        return view('livewire.game-menu',['verbs'=>Verb::cases()]);
    }
}
