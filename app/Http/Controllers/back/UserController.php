<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function list () {
        return view('back.user.list', [
           'users' => User::all()
        ]);
    }
}
