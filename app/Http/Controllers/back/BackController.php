<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\Game;

class BackController extends Controller {

    public function dashboard() {
        return view('back.dashboard');
    }

}
