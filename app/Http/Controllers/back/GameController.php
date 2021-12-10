<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\Image;
use App\Models\Server;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
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
            $req->file('image')->store('public/ws');
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

    public function edit($slug) {
        $game = Game::where('slug', $slug)->first();
        return view('back.game.edit', compact('game'));
    }

    public function editStore(Request $req, $slug)
    {
        $req->validate([
            'name' => 'required|max:255',
            'image' => 'mimes:png,jpg,jpeg|max:2048',
            'tag' => 'nullable'
        ]);

        $ActualGame = Game::where('slug', $slug)->first();
        if (!$ActualGame)
            return redirect()->back()->with('error', 'Aucun jeu trouvé !');

        if ($req->image) { // supprime et save la nouvelle image
            $getImages = Image::where('id', $ActualGame->image_id)->get();
            foreach ($getImages as $i)
                File::delete('public/ws/' . $i->path);

            $req->file('image')->store('public/ws');
            $path = $req->file('image')->hashName();
            Image::where('id', $ActualGame->image_id)->update([
                'user_id' => Auth::id(),
                'path' => $path
            ]);
        } else {
            $image = Image::where('id', $req->id)->first();
        }

        if (!$req->name)
            $req->name = $ActualGame->name;

        Game::where('slug', $slug)->update([
            'user_id' => Auth::id(),
            'name' => $req->name,
            'slug' => slug_formater($req->name)
        ]);

        return redirect()->route('back.game')->with('success','Jeu édité !');
    }

    public function deleteStore(Request $req) {

        $validator = Validator::make($req->all(),[
            'id' => 'required',
        ]);

        if($validator){
            $servers = Server::where('game_id', $req->id)->get();
            if(count($servers) > 0)
                return redirect()->back()->with('error', 'Ce jeu possède"'.count($servers).'" servers! Il n\'est pas possible de le supprimer...');

            $game = Game::find($req->id);
            $image = Image::where('game_id', $game->id);
            $tags = Tag::where('game_id', $game->id);
            $game->delete();

            $getImages = Image::where('id', $game->image_id)->get();
            foreach ($getImages as $i)
                File::delete('media/ws'.$i->path);

            $image->delete();
            $tags->delete();
            return redirect()->back()->with('success', 'Le jeu "'.$game->name.'" à été supprimé !');
        }
    }

    /*
     * AJAX ADD TAG -> back/game.js
     */
    public function tagAdd(Request $req) {
        $validator = Validator::make($req->all(),[
            'name' => 'required|unique:tags'
        ]);
        if($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        }
        $game = Game::where('id', $req->gameid)->first();
        if($game !== null) {
            Tag::create([
                'user_id'    => Auth::id(),
                'name'       => $req->name,
                'game_id'   => $game->id
            ]);
        } else {
            return response()->json([
                'status' => 400,
                'errors' => "Le Game Id \"".$req->gameid."\" n'éxiste pas!"
            ]);
        }

        return response()->json([
            'status' => 200,
            'success' => "Le tag \"".$req->name."\" à bien été ajouté!"
        ]);
    }

    /*
     * AJAX TAG EDIT -> back/game.js
     */
    public function tagGet(Request $req) {
        $tag = Tag::where('id', $req->id)->first();
        if($tag != null) {
            return response()->json([
                'status' => 200,
                'success' => $tag
            ]);
        } else {
            return response()->json([
                'status' => 400,
                'error' => 'Tag "ID" doesn\'t exist'
            ]);
        }
    }
    /*
     * AJAX TAG EDIT POST UPDATE
     */
    public function tagEditStore(Request $req) {
        $validator = Validator::make($req->all(),[
            'id' => 'required',
            'name' => 'required|unique:tags'
        ]);

        if($validator->fails()) {
            return response()->json([
                'status' => 400,
                'errors' => $validator->messages()
            ]);
        }

        $tag = Tag::where('id', $req->id)->first();
        if($tag != null) {
            Tag::where('id', $req->id)->update([
                'name'  => $req->name
            ]);
            return response()->json([
                'status' => 200,
                'success' => "Le tag \"".$tag->name."\" à été renommé en \"".$req->name."\" !"
            ]);
        }
    }

    public function deleteGameTagStore(Request $req) {
        $validator = Validator::make($req->all(),[
            'id' => 'required',
        ]);
        $tag = Tag::where('id', $req->id)->first();
        if($tag !== null) {
            $tag->delete();
            return redirect()->back()->with('success', 'Le tag "'.$tag->name.'" à été supprimé  !');
        } else {
            return redirect()->back()->with('error', 'Le jeu avec l\'id "'.$req->id.'" est introuvable !');
        }
    }
}
