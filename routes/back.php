<?php

use App\Http\Controllers\back\BackController;
use App\Http\Controllers\back\GameController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['admin'])->group(function() {

    Route::prefix('dashboard')->group(function () {

        Route::get('/', [BackController::class, 'dashboard'])->name('back.dashboard');

        Route::prefix('/game')->group(function() {

            Route::get('/', [GameController::class, 'gameList'])->name('back.game');
            Route::post('/', [GameController::class, 'gameAddStore'])->name('back.addGame.store');

            Route::get('/edit-game', [GameController::class, 'gameEdit'])->name('back.editGame');
            Route::post('/edit-game', [GameController::class, 'gameEditStore'])->name('back.editGame.store');

        });

        Route::get('/server', [BackController::class, 'dashboard'])->name('back.server');

        Route::get('/user', [BackController::class, 'dashboard'])->name('back.user');

    });
});
