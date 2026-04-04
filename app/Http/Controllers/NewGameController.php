<?php

namespace App\Http\Controllers;

use App\Providers\Game\StartGame;
use Illuminate\Http\Request;

class NewGameController extends Controller
{
    public function create()
    {
        return view('new-game');
    }

    public function store(Request $request, StartGame $startGame)
    {
        if ($request->user()->players()->count() >= 5) {
            return redirect()->route('game.new')->with('error', 'Too many characters.');
        }

        $request->validate([
            'character_name' => 'required|string|max:45|min:2',
        ]);

        $player = $startGame->handle(
            $request->user(),
            $request->character_name
        );

        session(['active_player_id' => $player->id]);

        return redirect()->route('game.play', ['id' => $player->id]);
    }

    public function destroy(Request $request, $id)
    {
        $player = $request->user()->players()->find($id);

        if ($player) {
            if (session('active_player_id') == $id) {
                session()->forget('active_player_id');
            }
            $player->delete();
        }

        return redirect()->route('game.new')->with('status', 'Character deleted.');
    }
}
