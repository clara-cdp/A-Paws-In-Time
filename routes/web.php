<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\player;
use App\Models\Room;
use App\Models\Pocket;
use App\Http\Controllers\NewGameController;


Route::view('/', 'welcome');

Route::get('/dashboard', function () {
    return redirect()->route('game.new');
})->middleware(['auth', 'verified'])->name('dashboard');

/*Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');*/

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';


//---------- create game add players


Route::middleware('auth')->group(function () {
    Route::get('/new-game', [NewGameController::class, 'create'])->name('game.new');
    Route::post('/new-game', [NewGameController::class, 'store'])->name('game.store');
    Route::delete('/new-game', [NewGameController::class, 'destroy'])->name('game.destroy');
    Route::view('/game', 'layouts.game');
});

