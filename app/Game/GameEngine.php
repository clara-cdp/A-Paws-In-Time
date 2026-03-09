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

        $targetItem = Item::where('player_id', $player->id)
            ->find($state->getTargetItemId());

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
        $masterTarget = Item::withoutGlobalScopes()
            ->whereNull('player_id')
            ->where('css_id', $targetItem->css_id)
            ->first();

        $masterPocketId = null;
        if ($pocketItem) {
            $masterPocketId = Item::withoutGlobalScopes()
                ->whereNull('player_id')
                ->where('css_id', $pocketItem->css_id)
                ->value('id');
        }

        $event = Event::where('verb_trigger', $verb->value)
            ->where('item_id', $masterTarget->id)
            ->where('required_item_id', $masterPocketId)
            ->first();

        if (!$event) {
            return "That doesn't seem to do anything.";
        }

        // -- Story Checks --
        if ($player->story_step < $event->step_required) {
            return "I can't do that yet.";
        }
        if ($event->next_step > $event->step_required && $player->story_step >= $event->next_step) {
            return "I've already done that.";
        }

        $messages = [];

        // -- Room Transition --
        if ($event->target_room_id) {
            $player->update(['room_id' => $event->target_room_id]);
            $messages[] = "You step through the doorway.";
        }

        $player->logEntries()->firstOrCreate(['event_id' => $event->id]);

        if ($event->next_step > 0 && $event->next_step > $player->story_step) {
            $player->update(['story_step' => $event->next_step]);
            $messages[] = "You've made progress...";
        }

        if ($event->unlocked_item_id) {
            $masterUnlock = Item::withoutGlobalScopes()->find($event->unlocked_item_id);

            Item::where('css_id', $masterUnlock->css_id)->update(['is_visible' => true]);
            $messages[] = "Something was revealed!";
        }

        return !empty($messages) ? implode(' ', $messages) : "You did something!";
    }
}