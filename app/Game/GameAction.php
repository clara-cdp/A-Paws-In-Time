<?php

namespace App\Game;

use Illuminate\Support\Facades\Log;

use App\Game\GameState;
use App\Game\GameEngine;

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

        $state->reset();

        return $displayMessage;
    }
}