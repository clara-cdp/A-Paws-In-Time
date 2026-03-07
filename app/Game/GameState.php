<?php

namespace App\Game;
use App\Enums\Verb;
class GameState {
    public string|null $verb = null;
    public int|null $itemId = null;
    public int|null  $targetItemId = null;

    
    public static function fromSession():self
    {
        return session('game_state', new self());
    }

    public function save():void{
        session(['game_state'=>$this]);
    }

    public function getVerb(): ?Verb
    {
        return $this->verb ? Verb::tryFrom($this->verb) : null;
    }

    public function getItemId(): ?int
    {
        return $this->itemId;
    }

    public function getTargetItemId(): ?int
    {
        return $this->targetItemId;
    }

    public function setVerb(Verb $verb): void
    {
        $this->verb = $verb->value;
        $this->save();
    }

    public function setItem(int $itemId){
        $this->itemId = $itemId;
        $this->save();
    }

    public function setTargetItemId(int $targetItemId){
        $this->targetItemId = $targetItemId;
        $this->save();
    }
    
    public function checkCompleteActions():bool{

        if (filled($this->verb) && filled($this->targetItemId)) {
            return true;
        }

        if (filled($this->verb) && filled($this->itemId) && $this->verb === 'LOOK AT') {
            return true;
        }

        return false;
    }

    public function reset():void 
    {
        $this->verb =null;
        $this->itemId = null;
        $this->targetItemId =null;
        $this->save();
    }

}