<?php

namespace App\Http\Controllers\front\server;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\Image;
use App\Models\Language;
use App\Models\Server;
use App\Models\Tag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Request;

class NewServerController extends Controller
{
    public function new() {
        return view('addserver', [
            'games'     => Game::all(),
            'languages'  => Language::all()
        ]);
    }

    public function newStore(Request $req) {

        $req->validate([
            'game' => 'required',
            'banner' => 'nullable|mimes:png,jpg,jpeg,gif|dimensions:max_width=200,max_height=200|max:2048',
            'logo' => 'nullable|mimes:png,jpg,jpeg,gif|dimensions:max_width=64,max_height=64|max:2048',
            'name' => 'required',
            'ip' => 'required',
            'port' => ['nullable','not_regex:/[^0-9]/'],
            'host' => 'required',
            'website' => 'nullable',
            'slots' => ['required','not_regex:/[^0-9]/'],
            'access' => 'required',
            'desc' => 'required',
            'lang' => 'required',
            'tag' => 'required',
            'discord' => 'nullable',
            'tsip' => ['nullable','regex:/[^.0-9]/' ],
            'tsport' => ['nullable','regex:/[^.0-9]/'],
            'mumbleip' => ['nullable','regex:/[^.0-9]/'],
            'mumbleport' => ['nullable','regex:/[^.0-9]/'],
            'twitch' => 'nullable',
            'youtube' => 'nullable',
        ]);

        if ($req->port) $ip = $req->ip.':'.$req->port; else $ip = $req->ip;
        if ($req->tsport) $ts = $req->tsip.':'.$req->tsport; else $ts = $req->tsip;
        if ($req->mumbleport) $mumble = $req->mumbleip.':'.$req->mumbleport; else $mumble = $req->mumbleip;

        $banner = $req->file('banner');
        $path1 = Str::orderedUuid().'.'.$banner->extension();
        $banner->storeAs('media/banner/', $path1,'s3');

        $logo = $req->file('logo');
        $path2 = Str::orderedUuid().'.'.$logo->extension();
        $logo->storeAs('media/logo/', $path2,'s3');

        $img1 = Image::create([
            'user_id'   => Auth::id(),
            'path'      => $path1,
        ]);
        $img2 = Image::create([
            'user_id'   => Auth::id(),
            'path'      => $path2,
        ]);

        $tags = [];
        foreach ($req->tag as $t) {
            $tag = Tag::find($t);
            $tags[] = $tag->id;
        }
        $langs = [];
        foreach ($req->lang as $l) {
            $lang = Language::find($l);
            if($lang)
                $langs[] = $lang->id;
        }

        $server = Server::create([
            'user_id' => Auth::id(),
            'game_id' => $req->game,
            'banner_id' => $img1->id,
            'logo_id' => $img2->id,
            'name' => $req->name,
            'slug' => Str::of($req->name)->slug('-'),
            'ip' => $ip,
            'host' => $req->host,
            'website' => $req->website,
            'slots' => $req->slots,
            'access' => $req->access,
            'description' => $req->desc,
            'discord' => $req->discord,
            'teamspeak' => $ts,
            'mumble' => $mumble,
            'twitch' => $req->twitch,
            'youtube' => $req->youtube,
        ]);
        $server->tags()->syncWithoutDetaching($tags);
        $server->languages()->syncWithoutDetaching($langs);

        return redirect()->route('my-account');
    }

    public function getGameTags($id) {
        return response()->json(['success' => Tag::where('game_id', $id)->get()]);
    }
}
