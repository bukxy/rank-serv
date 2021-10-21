<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;

class BackController extends Controller {

    public function dashboard() {
        return view('back.dashboard');
    }

}
