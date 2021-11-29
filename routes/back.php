<?php

use App\Http\Controllers\back\BackController;
use App\Http\Controllers\back\GameController;
use App\Http\Controllers\back\LanguageController;
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
            Route::get('/', [GameController::class, 'list'])->name('back.game');
            Route::get('/new', [GameController::class, 'add'])->name('back.addGame');
            Route::post('/new', [GameController::class, 'addStore'])->name('back.addGame.store');
            Route::get('/edit', [GameController::class, 'edit'])->name('back.editGame');
            Route::post('/edit', [GameController::class, 'editStore'])->name('back.editGame.store');
            Route::delete('/delete', [GameController::class, 'deleteStore'])->name('back.deleteGame.store');
        });

        Route::prefix('/server')->group(function() {
            Route::get('/', [BackController::class, 'dashboard'])->name('back.server');
        });

        Route::prefix('/user')->group(function() {
            Route::get('/', [BackController::class, 'dashboard'])->name('back.user');
        });

        Route::prefix('/language')->group(function() {
            Route::get('/', [LanguageController::class, 'list'])->name('back.language');
            Route::post('/', [LanguageController::class, 'addStore']);
        });

    });
});
