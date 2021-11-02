<?php

use App\Http\Controllers\back\BackController;
use App\Http\Controllers\front\FrontController;
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
        Route::get('/game', [BackController::class, 'dashboard'])->name('back.game');
        Route::get('/server', [BackController::class, 'dashboard'])->name('back.server');
        Route::get('/user', [BackController::class, 'dashboard'])->name('back.user');

    });
});
