<?php

namespace App\Http\Controllers\front\server;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServerEditRequest;
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

    public function editStore(ServerEditRequest $req, $slug) {

        $req->validated();

        $server = Server::where('slug', $slug)->first();

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

        if ($req->banner) {
            $banner = $req->file('banner');
            $path1 = Str::orderedUuid().'.'.$banner->extension();
            $banner->storeAs('media/banner/', $path1,'s3');

            $imgBanner = Image::create([
                'user_id'   => Auth::id(),
                'path'      => $path1,
            ])->id;

            $server->update(['banner' => $imgBanner]);
        }

        if ($req->logo) {
            $logo = $req->file('logo');
            $path2 = Str::orderedUuid() . '.' . $logo->extension();
            $logo->storeAs('media/logo/', $path2, 's3');

            $imgLogo = Image::create([
                'user_id'   => Auth::id(),
                'path'      => $path2,
            ])->id;

            $server->update(['logo' => $imgLogo]);
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

        $server->update([
            'name' => $req->name,
            'slug' => Str::of($req->name)->slug('-').'-'.$server->id,
            'ip' => $req->ip,
            'port' => $req->port,
            'host_id' => $req->host_id,
            'website' => $req->website,
            'slots' => $req->slots,
            'access' => $req->access,
            'description_short' => $req->description_short,
            'description' => $req->description,
            'discord' => $req->discord,
            'teamspeak' => $req->teamspeak,
            'teamspeak_port' => $req->teamspeak_port,
            'mumble' => $req->mumble,
            'mumble_port' => $req->mumble_port,
            'twitch' => $req->twitch,
            'youtube' => $req->youtube,
            'api'   => Str::uuid()
        ]);

        if ($req->tag)
            $server->tags()->syncWithoutDetaching($tags);
        if ($req->lang)
            $server->languages()->syncWithoutDetaching($langs);

        return redirect()->back();
    }
}
