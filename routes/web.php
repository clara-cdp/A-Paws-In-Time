<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\player;
use App\Models\Room;
use App\Models\Pocket;


Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';


//---------- create game add players

Route::middleware('auth')->group(function () {

    // Show new-game page
    Route::get('/new-game', function () {
        return view('new-game');
    })->name('game.new');

    // START GAME (create player)
    Route::post('/new-game', function (Request $request) {

        $request->validate([
            'character_name' => 'required|string|max:45',
        ]);

        $startingRoom = Room::where('name', 'The Garden')->firstOrFail();
        $pocket = Pocket::create();

        // Create the "game" (player)
        Player::create([
            'user_id'        => $request->user()->id,
            'character_name' => $request->character_name,
            'room_id'        => $startingRoom->id,   // starting room
            'pocket_id'      => $pocket->id,   // starting inventory
            'story_step'     => 0,
        ]);

        return redirect('/game');
    })->name('game.create');
});

Route::get('/game', function () {
    return view('layouts.game');
});