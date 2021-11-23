<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\Image;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Request;

class GameController extends Controller
{
    public function list() {
        $g = Game::with('image')->get();
        return view('back.game.list',[
            'games' => $g
        ]);
    }

    public function add() {
        return view('back.game.new');
    }

    public function addStore(Request $req) {

        $req->validate([
            'name' => 'required',
            'image' => 'required|mimes:png,jpg,jpeg|max:2048',
            'tag'  =>  'required'
        ]);

        if($req->file() && $req->name) {
            $req->file('image')->store('public/siteImage');
            $path = $req->file('image')->hashName();
            $img = new Image([
                'user_id'   => Auth::id(),
                'alt'       => $req->name,
                'path'      => $path,
            ]);
            $img->save();
            $image = Image::where('path', $path)->first();

            $game = new Game([
                'user_id'   => Auth::id(),
                'name'      => $req->name,
                'image_id'  => $image->id,
            ]);
            $game->save();

            $i = Game::where('image_id', $image->id)->first();
            $image->game_id = $i->id;
            $image->save();

            foreach ($req->tag as $tag) {
                Tag::create([
                    'user_id'   => Auth::id(),
                    'name'      => $tag,
                    'game_id'   => $i->id,
                ]);
            }

            return redirect()->route('back.game')
                ->with('success','Jeu ajouté !');
        }
    }

    public function gameEdit() {
        return view('back.game.edit');
    }

    public function gameEditStore() {

    }
}
