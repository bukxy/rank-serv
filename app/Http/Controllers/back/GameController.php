<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\Image;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
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
            'name' => 'required|max:255',
            'image' => 'required|mimes:png,jpg,jpeg|max:2048',
            'tag'  =>  'required'
        ]);

        if($req->file() && $req->name) {
            $req->file('image')->store('public/siteImage');
            $path = $req->file('image')->hashName();
            $img = new Image([
                'user_id'   => Auth::id(),
                'path'      => $path,
            ]);
            $img->save();
            $image = Image::where('path', $path)->first();

            $game = new Game([
                'user_id'   => Auth::id(),
                'name'      => $req->name,
                'slug'      => slug_formater($req->name),
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

    public function edit() {
        return view('back.game.edit');
    }

    public function editStore(Request $req) {
        return redirect()->route('back.game')
            ->with('success','Jeu ajouté !');
    }

    public function deleteStore(Request $req) {

        $validator = Validator::make($req->all(),[
            'id' => 'required',
        ]);

        if($validator){
            $game = Game::find($req->id);
            $images = Image::where('game_id', $game->id);
            $tags = Tag::where('game_id', $game->id);
            $game->delete();
            $images->delete();
            $tags->delete();
            return redirect()->back()->with('success', 'Le jeu "'.$game->name.'" à été supprimé !');
        }
    }
}
