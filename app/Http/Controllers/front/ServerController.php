<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\Server;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Request;

class ServerController extends Controller
{
    public function new() {
        return view('addserver', [
                'games' => Game::all()
            ]);
    }

    public function newStore(Request $req) {
//        dd(json_encode($req->tag));
        Server::create([
            'user_id' => Auth::id(),
            'game_id' => $req->game,
            'name' => $req->name,
            'ip' => $req->ip,
            'port' => $req->port,
            'website' => $req->website,
            'slots' => $req->slots,
            'access' => $req->access,
            'desc' => $req->desc,
            'tag' => json_encode($req->tag),
            'lang' => json_encode($req->tag),
            'discord' => $req->discord,
            'teamspeak' => $req->teamspeak,
            'mumble' => $req->mumble,
            'twitch' => $req->twitch,
            'youtube' => $req->youtube,
        ]);
    }

    public function getGameTags($id) {
        return response()->json(['success' => Tag::where('game_id', $id)->get()]);
    }

}
