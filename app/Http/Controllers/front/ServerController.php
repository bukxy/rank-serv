<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;

class ServerController extends Controller
{
    public function new() {
        return view('addserver');
    }

    public function newStore() {
        return view('addserver');
    }

}
