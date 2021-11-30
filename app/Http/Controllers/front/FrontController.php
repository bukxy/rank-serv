<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\Server;

class FrontController extends Controller {

    public function index() {
        return view('home', [
            'games' => Game::all()
        ]);
    }

    public function listServersByGame($game)
    {
        $g = Game::where('slug', '=', $game)->first();
        if(!$g) abort(404);
        $s = Server::where('game_id', '=', $g->id)->paginate(1);
        return view('classement', ['servers' => $s]);
    }
}
