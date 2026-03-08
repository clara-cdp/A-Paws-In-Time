<?php

namespace App\Game;

use App\Game\GameState;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;
use App\Models\Event;
use App\Enums\Verb;

class GameEngine {

    public function resolve(GameState $state): ?string{

        $player = Auth::user()->Player;
        $verb = $state->getVerb();

        $targetItem = Item::find($state->getTargetItemId());
        $pocketItem = $state->getItemId() ? Item::find($state->getItemId()):null;  

        if(!$targetItem) return null;

        if($verb === Verb::LOOK_AT){
            $displayMessage = $targetItem->description;
            return $displayMessage;
        }

        if ($verb === Verb::PICK_UP) {

            if ($targetItem->is_portable && $targetItem->is_visible) {

                $targetItem->room_id = null;
                $targetItem->save();

                $player->pocket->items()->syncWithoutDetaching([$targetItem->id]);

                return "Picked up the " . $targetItem->css_id;
            } else {
                return "I can't pick that up.";
            }
        }
           return $this->processEvent($verb, $targetItem, $pocketItem, $player);           
        }
    

    private function processEvent(Verb $verb, Item $targetItem, ?Item $pocketItem, $player): ?string
    {
        $event = Event::where('verb_trigger', $verb->value)
            ->where('item_id', $targetItem->id)
            ->where('required_item_id', $pocketItem?->id)
            ->first();

        if (!$event) {
            return "That doesn't seem to do anything.";
        }

        $messages = [];

        if ($event->unlocked_item_id) {
            Item::where('id', $event->unlocked_item_id)->update(['is_visible' => true]);
            $messages[] = "Something was revealed!";
        }

        if ($event->next_step !== null) {
            $player->update(['current_step' => $event->next_step]);
            $messages[] = "You've made progress...";
        }

        return !empty($messages) ? implode(' ', $messages) : "You did something!";
    }
}

