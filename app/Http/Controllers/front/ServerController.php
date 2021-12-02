<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\Image;
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

        $req->validate([
            'game' => ['required'],
            'banner' => 'nullable|mimes:png,jpg,jpeg,gif|dimensions:max_width=200,max_height=200|max:2048',
            'logo' => 'nullable|mimes:png,jpg,jpeg,gif|dimensions:max_width=64,max_height=64|max:2048',
            'name' => ['required'],
            'ip' => ['required'],
            'port' => ['required','not_regex:/[^0-9]/'],
            'host' => ['required'],
            'website' => ['nullable'],
            'slots' => ['required','not_regex:/[^0-9]/'],
            'access' => ['required'],
            'desc' => ['required'],
            'lang' => ['required'],
            'tag' => ['required'],
            'discord' => ['nullable'],
            'tsip' => ['nullable','regex:/[^.0-9]/' ],
            'tsport' => ['nullable','regex:/[^.0-9]/'],
            'mumbleip' => ['nullable','regex:/[^.0-9]/'],
            'mumbleport' => ['nullable','regex:/[^.0-9]/'],
            'twitch' => ['nullable'],
            'youtube' => ['nullable'],
        ]);

        if ($req->port) $ip = $req->ip.':'.$req->port; else $ip = $req->ip;
        if ($req->tsport) $ts = $req->tsip.':'.$req->tsport; else $ts = $req->tsip;
        if ($req->mumbleport) $mumble = $req->mumbleip.':'.$req->mumbleport; else $mumble = $req->mumbleip;

        $req->file('banner')->store('public/siteImage');
        $req->file('logo')->store('public/siteImage');
        $path1 = $req->file('banner')->hashName();
        $path2 = $req->file('logo')->hashName();
        $img1 = new Image([
            'user_id'   => Auth::id(),
            'path'      => $path1,
        ]);
        $img1->save();
        $banner= Image::where('path', $path1)->first();

        $img2 = new Image([
            'user_id'   => Auth::id(),
            'path'      => $path2,
        ]);
        $img2->save();
        $logo = Image::where('path', $path2)->first();

        $tags = [];
        foreach ($req->tag as $t) {
            $tag = Tag::find($t);
            $tags[] = $tag->id;
        }
        $langs = [];
        foreach ($req->lang as $l) {
            $lang = Language::first('id', $l);
            if($lang)
                $langs[] = $lang->id;
        }

        Server::create([
            'user_id' => Auth::id(),
            'game_id' => $req->game,
            'banner_id' => $banner->id,
            'logo_id' => $logo->id,
            'name' => $req->name,
            'slug' => slug_formater($req->name),
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

        $server = Server::where('banner_id', $banner->id)->first();
        $img1->server_id = $server->id;
        $img2->server_id = $server->id;
        $img1->save();
        $img2->save();
        $server->tags()->syncWithoutDetaching($tags);
        $server->languages()->syncWithoutDetaching($langs);

        return redirect()->route('my-account');
    }

    public function getGameTags($id) {
        return response()->json(['success' => Tag::where('game_id', $id)->get()]);
    }
}
