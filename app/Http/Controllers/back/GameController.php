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
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Request;

class GameController extends Controller
{
    public function list() {
        return view('back.game.list',[
            'games' => Game::all()
        ])->with('image', 'logo');
    }

    public function add() {
        return view('back.game.new');
    }

    public function addStore(Request $req) {

        $req->validate([
            'name'  => 'required|unique:games|max:255',
            'logo'  => 'required|mimes:png,jpg,jpeg|max:2048',
            'image' => 'required|mimes:png,jpg,jpeg|max:2048',
            'tag'   => 'nullable',
            'type'  => 'nullable'
        ]);

        $type = isset($req->type) ? 1 : 0;
        /*
         * LOGO
         */
        $path1 = Str::of($req->name.'-logo')->slug('-').'.'.$req->file('logo')->extension();
        $req->file('logo')->storeAs('public/ws', $path1);
        Image::create([
            'user_id'   => Auth::id(),
            'path'      => $path1,
        ]);
        $logo = Image::where('path', $path1)->first();

        /*
         * IMAGE
         */
        $path2 = Str::of($req->name)->slug('-').'.'.$req->file('image')->extension();
        $req->file('image')->storeAs('public/ws', $path2);
        Image::create([
            'user_id'   => Auth::id(),
            'path'      => $path2,
        ]);
        $image = Image::where('path', $path2)->first();

        $game = Game::create([
            'user_id'   => Auth::id(),
            'name'      => $req->name,
            'slug'      => Str::of($req->name)->slug('-'),
            'logo_id'   => $logo->id,
            'image_id'  => $image->id,
            'type'      => $type
        ]);

        if($req->tag)
            foreach ($req->tag as $tag) {
                Tag::create([
                    'user_id'   => Auth::id(),
                    'name'      => $tag,
                    'game_id'   => $game->id,
                ]);
            }

        return redirect()->route('back.game')
            ->with('success','Jeu ajout?? !');
    }

    public function edit($slug) {
        $game = Game::where('slug', $slug)->first();
        return view('back.game.edit', compact('game'));
    }

    public function editStore(Request $req, $slug)
    {
        $req->validate([
            'name'  => 'required|max:255',
            'image' => 'nullable|mimes:png,jpg,jpeg|max:2048',
            'logo'  => 'nullable|mimes:png,jpg,jpeg|max:2048',
            'type'  => 'nullable'
        ]);

        $type = isset($req->type) ? 1 : 0;

        $game = Game::where('slug', $slug)->first();
        if (!$game)
            return redirect()->back()->with('error', 'Aucun jeu trouv?? !');

        if ($req->name) {
            Game::where('slug', $slug)->update([
                'user_id'   => Auth::id(),
                'name'      => $req->name,
                'slug'      => Str::of($req->name)->slug('-'),
                'type'      => $type
            ]);
        }

        if ($req->image) { // supprime et save la nouvelle banner
            $i = Image::where('id', $game->image_id)->first();
            File::delete('public/ws/' . $i->path);

            $pathImage = Str::of($req->name)->slug('-').'.'.$req->file('image')->extension();
            $req->file('image')->storeAs('public/ws', $pathImage);
            Image::where('id', $game->image_id)->update([
                'user_id' => Auth::id(),
                'path' => $pathImage
            ]);
        }
        if ($req->logo) { // supprime et save la nouvelle banner
            $logo = Image::where('id', $game->logo_id)->first();
            File::delete('public/ws/' . $logo->path);

            $pathLogo = Str::of($req->name.'-logo')->slug('-').'.'.$req->file('logo')->extension();
            $req->file('logo')->storeAs('public/ws', $pathLogo);
            Image::where('id', $game->logo_id)->update([
                'user_id' => Auth::id(),
                'path' => $pathLogo
            ]);
        }

        return redirect()->route('back.game')->with('success','Jeu "'.$req->name.'" ??dit?? !');
    }

    public function deleteStore(Request $req) {

        $validator = Validator::make($req->all(),[
            'id' => 'required',
        ]);

        if($validator){
            $servers = Server::where('game_id', $req->id)->get();
            if(count($servers) > 0)
                return redirect()->back()->with('error', 'Ce jeu poss??de"'.count($servers).'" servers! Il n\'est pas possible de le supprimer...');

            $game = Game::find($req->id);

            $logo = Image::find($game->logo_id);
            File::delete('media/ws/'.$logo->path);
            $logo->delete();
            $image = Image::find($game->image_id);
            File::delete('media/ws/'.$image->path);
            $image->delete();

            $tags = Tag::where('game_id', $game->id)->get();
            foreach ($tags as $t)
                $t->delete();

            $game->delete();
            return redirect()->back()->with('success', 'Le jeu "'.$game->name.'" ?? ??t?? supprim?? !');
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
                'errors' => "Le Game Id \"".$req->gameid."\" n'??xiste pas!"
            ]);
        }

        return response()->json([
            'status' => 200,
            'success' => "Le tag \"".$req->name."\" ?? bien ??t?? ajout??!"
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
                'success' => "Le tag \"".$tag->name."\" ?? ??t?? renomm?? en \"".$req->name."\" !"
            ]);
        }
    }

    public function deleteGameTagStore(Request $req) {
        $validator = Validator::make($req->all(),[
            'id' => 'required',
        ]);
        $tag = Tag::where('id', $req->id)->first();
        if($validator && $tag !== null) {
            $servers = Server::where('game_id', $tag->game_id)->get();
            foreach ($servers as $s) {
                $s->tags()->detach($tag->id);
            }
            $tag->delete();
            return redirect()->back()->with('success', 'Le tag "'.$tag->name.'" ?? ??t?? supprim??  !');
        } else {
            return redirect()->back()->with('error', 'Le jeu avec l\'id "'.$req->id.'" est introuvable !');
        }
    }
}
