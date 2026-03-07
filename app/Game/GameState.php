<?php

namespace App\Game;

class GameState {
    public string|null $verb = null;
    public int|null $itemId = null;
    public int|null  $targetItemId = null;

    public function setVerb(string $verb): void
    {
        $this->verb = $verb;
        session(['game_state' => $this]); 
    }

    public static function fromSession():self
    {
        return session('game_state', new self());
    }

    public function reset():void 
    {
        $this->verb =null;
        $this->itemId = null;
        $this-> targetItemId =null;
        session(['game_state'=>$this]);
    }
}