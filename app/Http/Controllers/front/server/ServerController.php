<?php

namespace App\Http\Controllers\front\server;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\Image;
use App\Models\Language;
use App\Models\Server;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Builder;
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
        return view('classement', [
            'servers' => $s,
            'game' => $g,
            'languages' => Language::all(),
            'tags'   => Tag::all(),
        ]);
    }

    public function filter(Request $req, $game) {

        $validated = $req->validate([
            'name'  => 'nullable',
            'voteMin'  => 'nullable',
            'voteMax'  => 'nullable',
            'host' => 'nullable',
            'lang' => 'nullable',
            'tag' => 'nullable',
            'website' => 'nullable|between:0,2',
            'discord' => 'nullable|between:0,2',
            'teamspeak' => 'nullable|between:0,2',
            'mumble' => 'nullable|between:0,2',
            'access' => 'nullable|between:0,2',
        ]);

        $gameInfo = Game::where('slug', $game)->first();
        $servers = Server::where('game_id', $gameInfo->id);

        if($req->voteMin)
            $servers->where('vote', '>=' , $req->voteMin);
        if($req->voteMax)
            $servers->where('vote', '<=' , $req->voteMax);

        if($req->host)
            $servers->whereIn('host_id', $req->host);

        if($req->lang) {
            $id = $req->lang;
            $servers->whereHas('languages', function (Builder $query) use ($id){
                $query->whereIn('lang_id', $id);
            });
        }
        if($req->tag) {
            $id = $req->tag;
            $servers->whereHas('tags', function (Builder $query) use ($id){
                $query->whereIn('tag_id', $id);
            });
        }

        if($req->access < 2) {
            if($req->access == 1)
                $servers->where('access', true);
            if ($req->access == 0)
                $servers->where('access', false);
        }
        if($req->website < 2) {
            if($req->website == 1)
                $servers->whereNull('website')->orWhere('website', '');
            if ($req->website == 0)
                $servers->whereNotNull('website');
        }
        if($req->discord < 2) {
            if($req->discord == 1)
                $servers->whereNull('discord')->orWhere('discord', '');
            if ($req->discord == 0)
                $servers->whereNotNull('discord');
        }
        if($req->teamspeak < 2) {
            if($req->teamspeak == 1)
                $servers->whereNull('teamspeak')->orWhere('teamspeak', '');
            if ($req->teamspeak == 0)
                $servers->whereNotNull('teamspeak');
        }
        if($req->mumble < 2) {
            if($req->mumble == 1)
                $servers->whereNull('mumble')->orWhere('mumble', '');
            if ($req->mumble == 0)
                $servers->whereNotNull('mumble');
        }

        if($req->name) {
            $servers->where('name', 'like',  '%' . Str::lower($req->name) .'%');
        }

        return view('classement', [
            'servers' => $servers->orderBy('vote', 'desc')->paginate(20),
            'game' => Game::where('slug',$req->game)->first(),
            'languages' => Language::all(),
            'tags'   => Tag::all(),
        ]);
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

    /*
     * Image upload ajax (when upload in description input)
     */
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
