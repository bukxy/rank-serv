<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\Image;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Request;

class GameController extends Controller
{
    public function gameList() {
        return view('back.game.list',[
            'games' => Game::all()
        ]);
    }

    public function gameAddStore(Request $req) {
        dd($req);
        $req->validate([
           'file' => "required|image|mimes:jpeg,png,jpg,gif|max:2048"
        ]);

        if ($req->file('file') && $req->file('file')->isValid()) {
            $image = $req->file('file');

            $path = $image->store('images');

            Image::create([
                'user_id'   => Auth::id(),
                'name'  => $image->path(),
            ]);

            dd($image);
        }

    }

    public function gameEdit() {
        return view('back.game.edit');
    }

    public function gameEditStore() {

    }
}
