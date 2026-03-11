<?php

namespace App\Http\Controllers;

use App\Game\StartGame;

use Illuminate\Http\Request;



class NewGameController extends Controller
{
    public function create()
    {
        return view('new-game');
    }

    public function store(Request $request, StartGame $startGame)
    {
        if ($request->user()->player) {
            return redirect('/game');
        }
        
        $request->validate([
            'character_name' => 'required|string|max:45',
        ]);

        $startGame->handle(
            $request->user(),
            $request->character_name
        );

        return redirect('/game');
    }
}
