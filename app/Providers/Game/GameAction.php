<?php

namespace App\Providers\Game;

use Illuminate\Support\Facades\Log;

use App\Providers\Game\GameState;
use App\Providers\Game\GameEngine;

class GameAction
{
    public function tryEvent(): ?string
    {
        $state = GameState::fromSession();

        Log::info('--- GAME ACTION FIRED ---', [
            'verb_in_memory' => $state->getVerb(),
            'target_in_memory' => $state->getTargetItemId()
        ]);

        if (! $state->checkCompleteActions()) {
            Log::info('Action aborted: Sentence is incomplete.');
            return null;
        }

        $displayMessage = app(GameEngine::class)->resolve($state);
        Log::info('Engine returned message: ' . $displayMessage);

        if (!empty($result['new_room_id'])) {
            Log::info('Player moved to room ID: ' . $result['new_room_id']);
        }

        $state->reset();

        return $displayMessage;
    }
}