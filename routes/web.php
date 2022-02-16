<?php

use App\Http\Controllers\front\FrontController;
use App\Http\Controllers\front\server\NewServerController;
use App\Http\Controllers\front\server\ServerController;
use App\Http\Controllers\front\server\ServerVoteController;
use App\Http\Controllers\front\UserController;
use App\Http\Controllers\testController;
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
Route::get('/', [FrontController::class, 'index'])->name('index');

Route::middleware(['auth'])->group(function() {
    Route::prefix('my-account')->group(function () {

        Route::get('/', [UserController::class, 'account'])->name('my-account');
        Route::get('servers', [UserController::class, 'servers'])->name('my-servers');
        Route::get('servers/{slug}', [ServerController::class, 'edit'])->name('my-servers.edit');
        Route::post('servers/{slug}/info', [ServerController::class, 'getServerToUploadImage'])->name('my-servers.edit.infoserver'); // take slug server when upload image in ckeditor
        Route::post('servers/{slug}', [ServerController::class, 'edit'])->name('my-servers.store');

        Route::post('servers/image/upload', [ServerController::class, 'upload'])->name('test'); // test upload
        Route::get('settings', [UserController::class, 'settings'])->name('my-settings');

        Route::post('avatar', [UserController::class, 'avatar'])->name('my-profile.avatar');
        Route::post('global', [UserController::class, 'global'])->name('my-profile.global');
        Route::post('password', [UserController::class, 'password'])->name('my-profile.password');

        Route::get('add-server', [NewServerController::class, 'new'])->name('add-server');
        Route::post('add-server', [NewServerController::class, 'newStore'])->name('add-server.store');
        Route::post('getGameTags/{id}', [NewServerController::class, 'getGameTags']);

    });
    include __DIR__.'/back.php';
});
Route::prefix('/{game}')->group(function() {
    Route::get('/', [ServerController::class, 'list'])->name('game.server');
    Route::get('/tag/{tag}', [ServerController::class, 'filter'])->name('server.tag');
    Route::get('/{server}', [FrontController::class, 'info'])->name('serverInfo');
    Route::get('/{server}/vote', [ServerVoteController::class, 'vote'])->name('server.vote');
    Route::post('/{server}/vote', [ServerVoteController::class, 'voteStore'])->name('server.voteStore');
});
