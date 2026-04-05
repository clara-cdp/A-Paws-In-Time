<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\player;
use App\Models\Room;
use App\Models\Pocket;
use App\Http\Controllers\NewGameController;


Route::get('/', function () {
    return view('splash');
});


Route::get('/welcome', function () {
    return view('welcome');
});


Route::get('/dashboard', function () {
    return redirect()->route('game.new');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';


//---------- create game add players

/*Route::middleware('auth')->group(function () {
    Route::get('/new-game', [NewGameController::class, 'create'])->name('game.new');
    Route::post('/new-game', [NewGameController::class, 'store'])->name('game.store');
    Route::delete('/new-game/{id}', [NewGameController::class, 'destroy'])->name('game.destroy');

    Route::get('/game/{id}', function (\App\Models\Player $player) {
        session(['active_player_id' => $player->id]);
        return view('layouts.game');
    });
    Route::view('/game', 'layouts.game');
});*/

Route::middleware('auth')->group(function () {
    Route::get('/new-game', [NewGameController::class, 'create'])->name('game.new');
    Route::post('/new-game', [NewGameController::class, 'store'])->name('game.store');
    Route::delete('/new-game/{id}', [NewGameController::class, 'destroy'])->name('game.destroy');

    Route::get('/game/{id}', function ($id) {
        $player = Player::find($id);

        if (!$player) {
            return redirect()->route('game.new')->with('error', 'Character not found.');
        }

        session(['active_player_id' => $player->id]);

        return view('layouts.game');
    })->name('game.play');

    Route::view('/game', 'layouts.game');

});

