<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\Language;
use App\Models\Server;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Request;

class ServerController extends Controller
{
    public function new() {
        return view('addserver', [
                'games'     => Game::all(),
                'languages'  => Language::all()
            ]);
    }

    public function newStore(Request $req) {

        if ($req->port) $ip = $req->ip.':'.$req->port; else $ip = $req->ip;
        if ($req->tsport) $ts = $req->tsip.':'.$req->tsport; else $ts = $req->tsip;
        if ($req->mumbleport) $mumble = $req->mumbleip.':'.$req->mumbleport; else $mumble = $req->mumbleip;

        Server::create([
            'user_id' => Auth::id(),
            'game_id' => $req->game,
            'name' => $req->name,
            'ip' => $ip,
            'host' => $req->host,
            'website' => $req->website,
            'slots' => $req->slots,
            'access' => $req->access,
            'description' => $req->desc,
            'lang' => json_encode($req->lang),
            'tag' => json_encode($req->tag),
            'discord' => $req->discord,
            'teamspeak' => $ts,
            'mumble' => $mumble,
            'twitch' => $req->twitch,
            'youtube' => $req->youtube,
        ]);

        return redirect()->route('my-account');;
    }

    public function getGameTags($id) {
        return response()->json(['success' => Tag::where('game_id', $id)->get()]);
    }
}
