<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Game;

class FrontController extends Controller {

    public function index() {
        if (isset($_SERVER["HTTP_CLIENT_IP"])) {
            $ip = $_SERVER["HTTP_CLIENT_IP"];
        }
        elseif(isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
            $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
        }
        elseif(isset($_SERVER["HTTP_X_FORWARDED"])) {
            $ip = $_SERVER["HTTP_X_FORWARDED"];
        }
        elseif(isset($_SERVER["HTTP_FORWARDED_FOR"])) {
            $ip = $_SERVER["HTTP_FORWARDED_FOR"];
        }
        elseif(isset($_SERVER["HTTP_FORWARDED"])) {
            $ip = $_SERVER["HTTP_FORWARDED"];
        } else {
            $ip = $_SERVER["REMOTE_ADDR"];
        }

        return view('home', [
            'games' => Game::all()
        ]);
    }

    public function getServersByGame($slug) {
        dd(str_replace(" ", "-", $slug));
    }

}
