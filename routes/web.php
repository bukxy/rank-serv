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

Route::get('/', [FrontController::class, 'index'])->name('index');

Route::middleware(['auth'])->group(function() {

    Route::prefix('my-account')->group(function () {

        Route::get('/', [BackController::class, 'my-account'])->name('my-account');

    });

    Route::middleware(['admin'])->group(function() {

        Route::prefix('dashboard')->group(function () {

            Route::get('/', [BackController::class, 'dashboard'])->name('back.dashboard');

        });
    });
});

require __DIR__.'/auth.php';
