<?php

use App\Http\Controllers\front\ServerController;
use App\Http\Controllers\front\UserController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();
Route::get('/', [HomeController::class, 'index'])->name('index');

Route::middleware(['auth'])->group(function() {
    Route::prefix('my-account')->group(function () {

        Route::get('/', [UserController::class, 'account'])->name('my-account');
        Route::get('servers', [UserController::class, 'servers'])->name('my-servers');
        Route::get('settings', [UserController::class, 'settings'])->name('my-settings');
        Route::post('avatar', [UserController::class, 'avatar'])->name('my-settings.avatar');
        Route::post('global', [UserController::class, 'global'])->name('my-settings.global');
        Route::post('password', [UserController::class, 'password'])->name('my-settings.password');

        Route::get('add-server', [ServerController::class, 'new'])->name('add-server');
        Route::post('add-server', [ServerController::class, 'newStore'])->name('add-server.store');
        Route::post('getGameTags/{id}', [ServerController::class, 'getGameTags']);

    });
    include __DIR__.'/back.php';
});

