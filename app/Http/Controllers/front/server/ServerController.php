<?php

namespace App\Http\Controllers\front\server;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\Server;
use Illuminate\Http\Request;

class ServerController extends Controller
{
    public function list($game)
    {
        $g = Game::where('slug', '=', $game)->first();
        if(!$g) abort(404);
        $s = Server::where('game_id', '=', $g->id)->orderBy('vote', 'desc')->paginate(20);
        return view('classement', ['servers' => $s]);
    }
}
