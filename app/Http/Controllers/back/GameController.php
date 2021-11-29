<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\Image;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Request;

class GameController extends Controller
{
    public function list() {
        return view('back.game.list',[
            'games' => Game::all()
        ]);
    }

    public function add() {
        return view('back.game.new');
    }

    public function addStore(Request $req) {

        $req->validate([
            'name' => 'required',
            'image' => 'required|mimes:png,jpg,jpeg|max:2048'
        ]);

        if($req->file() && $req->name) {

            $path = $req->file('image')->store('public/images');

            $img = new Image([
                'user_id'   => Auth::id(),
                'name'      => $req->name,
                'path'      => $path,
            ]);

            $img->save();

            return back()
                ->with('success','File has uploaded to the database.');
        }
    }

    public function gameEdit() {
        return view('back.game.edit');
    }

    public function gameEditStore() {

    }
}
