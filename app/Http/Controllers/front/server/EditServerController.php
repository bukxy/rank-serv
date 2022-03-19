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
use Illuminate\Support\Str;

class EditServerController extends Controller
{
    public function editStore(Request $req) {

        $req->validate([
            'game' => 'required',
            'banner' => 'nullable|mimes:png,jpg,jpeg,gif|dimensions:max_width=200,max_height=200|max:2048',
            'logo' => 'nullable|mimes:png,jpg,jpeg,gif|dimensions:max_width=64,max_height=64|max:2048',
            'name' => 'required',
            'ip' => 'nullable',
            'port' => ['nullable','not_regex:/[^0-9]/'],
            'host' => 'nullable',
            'website' => 'nullable',
            'slots' => ['nullable','not_regex:/[^0-9]/'],
            'access' => 'nullable',
            'desc' => 'required',
            'lang' => 'nullable',
            'tag' => 'required',
            'discord' => 'nullable',
            'ts_ip' => ['nullable','regex:/[^.0-9]/' ],
            'mumble_ip' => ['nullable','regex:/[^.0-9]/'],
            'twitch' => 'nullable',
            'youtube' => 'nullable',
        ]);

        // ---- verification if exist in db
        if(!Game::find($req->game))
            abort(404);

        if ($req->tag) {
            foreach ($req->tag as $t) {
                if (!Tag::find($t))
                    abort(404);
            }
        }

        if ($req->lang) {
            foreach ($req->lang as $l) {
                if (!Language::find($l))
                    abort(404);
            }
        }
        // ---- end of verification if exist in db

//        if ($req->port) $ip = $req->ip.':'.$req->port; else $ip = $req->ip;
//        if ($req->tsport) $ts = $req->tsip.':'.$req->tsport; else $ts = $req->tsip;
//        if ($req->mumbleport) $mumble = $req->mumbleip.':'.$req->mumbleport; else $mumble = $req->mumbleip;

        if ($req->banner) {
            $banner = $req->file('banner');
            $path1 = Str::orderedUuid().'.'.$banner->extension();
            $banner->storeAs('media/banner/', $path1,'s3');

            $img1 = Image::create([
                'user_id'   => Auth::id(),
                'path'      => $path1,
            ]);
        }

        if ($req->logo) {
            $logo = $req->file('logo');
            $path2 = Str::orderedUuid() . '.' . $logo->extension();
            $logo->storeAs('media/logo/', $path2, 's3');

            $img2 = Image::create([
                'user_id'   => Auth::id(),
                'path'      => $path2,
            ]);
        }

        if ($req->tag) {
            $tags = [];
            foreach ($req->tag as $t) {
                $tag = Tag::find($t);
                $tags[] = $tag->id;
            }
        }

        if ($req->lang) {
            $langs = [];
            foreach ($req->lang as $l) {
                $lang = Language::find($l);
                if ($lang)
                    $langs[] = $lang->id;
            }
        }

        $server = Server::create([
            'user_id' => Auth::id(),
            'game_id' => $req->game,
            'banner_id' => $img1->id,
            'logo_id' => $img2->id,
            'name' => $req->name,
            'slug' => Str::of($req->name)->slug('-'),
            'ip' => $req->ip,
            'port' => $req->port,
            'host_id' => $req->host,
            'website' => $req->website,
            'slots' => $req->slots,
            'access' => $req->access,
            'description' => $req->desc,
            'discord' => $req->discord,
            'teamspeak' => $req->ts_ip,
            'teamspeak_port' => $req->ts_port,
            'mumble' => $req->mumble_ip,
            'mumble_port' => $req->mumble_port,
            'twitch' => $req->twitch,
            'youtube' => $req->youtube,
            'api'   => Str::uuid()
        ]);

        Server::where('id', $server->id)->update([
            'slug' => $server->slug.'-'.$server->id
        ]);

        if ($req->tag)
            $server->tags()->syncWithoutDetaching($tags);
        if ($req->lang)
            $server->languages()->syncWithoutDetaching($langs);

        return redirect()->route('serverInfo', ["game" => $req->game]);
    }
}