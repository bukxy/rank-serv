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
}
