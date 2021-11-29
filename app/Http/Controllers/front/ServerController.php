<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Server;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Request;

class ServerController extends Controller
{
    public function new() {
        return view('addserver');
    }

    public function newStore(Request $req) {
//        dd($req);
        Server::create([
            'user_id' => Auth::id(),
            'game_id' => $req->game_id,
            'name' => $req->name,
            'ip' => $req->ip,
            'port' => $req->port,
            'website' => $req->website,
            'slots' => $req->slots,
            'access' => $req->access,
            'desc' => $req->desc,
            'tag' => $req->tag,
            'discord' => $req->discord,
            'teamspeak' => $req->teamspeak,
            'mumble' => $req->mumble,
            'twitch' => $req->twitch,
            'youtube' => $req->youtube,
        ]);
    }

}
