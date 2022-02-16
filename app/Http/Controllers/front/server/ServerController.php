<?php

namespace App\Http\Controllers\front\server;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\Image;
use App\Models\Language;
use App\Models\Server;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ServerController extends Controller
{
    public function list($game)
    {
        $g = Game::where('slug', '=', $game)->first();
        if(!$g) abort(404);
        $s = Server::where('game_id', '=', $g->id)->orderBy('vote', 'desc')->paginate(20);
        return view('classement', ['servers' => $s]);
    }

    public function edit($slug)
    {
        $s = Server::where('slug', $slug)->first();
        if(!$s) abort(404);
        return view('user.editserver', [
            'server'    => $s,
            'games'     => Game::all(),
            'languages' => Language::all(),
            'tags'      => Tag::all(),
        ]);
    }

    public function upload(Request $request) {
        $server = Server::where('slug', $request->slug)->first();
        if ($server && $server->user_id == Auth::id()) {
            if ($request->hasFile('file')) {
                $upload = $request->file('file');
                $path = Str::orderedUuid().'.'.$upload->extension();
                $upload->storeAs('media/server/'.$server->id.'/', $path,'s3');

                $img = Image::create([
                    'user_id'   => Auth::id(),
                    'path'      => 'media/server/'.$server->id.'/'.$path,
                ]);
            }
        } else {
            abort(404);
        }

        return response()->json(['location' => Storage::disk('s3')->url($img->path)]);
    }
}
