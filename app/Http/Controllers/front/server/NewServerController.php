<?php

namespace App\Http\Controllers\front\server;

use App\Http\Controllers\Controller;
use App\Http\Requests\ServerAddRequest;
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
    public function new()
    {
        return view('addserver', [
            'games' => Game::all(),
            'languages' => Language::all()
        ]);
    }

    public function newStore(ServerAddRequest $req)
    {

//         Retrieve the validated input data...
        $req->validated();

        if ($req->banner) {
            $banner = $req->file('banner');
            $path1 = Str::orderedUuid() . '.' . $banner->extension();
            $banner->storeAs('media/banner/', $path1, 's3');

            $imgBanner = Image::create([
                'user_id' => Auth::id(),
                'path' => $path1,
            ])->id;
        } else {$imgBanner = null;}

        if ($req->logo) {
            $logo = $req->file('logo');
            $path2 = Str::orderedUuid() . '.' . $logo->extension();
            $logo->storeAs('media/logo/', $path2, 's3');

            $imgLogo = Image::create([
                'user_id' => Auth::id(),
                'path' => $path2,
            ])->id;
        } else {$imgLogo = null;}

        if ($req->tag) {
            $gameInfo = Game::find($req->game_id);
            $tags = [];
            foreach ($req->tag as $t) {
                if(Tag::where('game_id', $gameInfo)->where('id',$t)) {
                    $tag = Tag::find($t);
                    $tags[] = $tag->id;
                }
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
            'user_id'   => Auth::id(),
            'game_id'   => $req->game_id,
            'name'      => $req->name,
            'slug'      => Str::uuid(), // Just to don't get a same slug (url) of another server when CREATED
            'host_id'   => $req->host_id,
            'access'    => $req->access,
            'description' => $req->description,
            'discord'   => $req->discord,
            'teamspeak' => $req->teamspeak,
            'teamspeak_port' => $req->teamspeak_port,
            'mumble'    => $req->mumble,
            'mumble_port' => $req->mumble_port,
            'twitch'    => $req->twitch,
            'youtube'   => $req->youtube,
            'api'       => Str::uuid()
        ]);

        $server->update([
            'slug'      => $server->name . '-' . $server->id,
            'banner'    => $imgBanner,
            'logo'      => $imgLogo,
        ]);

        if ($req->tag)
            $server->tags()->create($tags);
        if ($req->lang)
            $server->languages()->syncWithoutDetaching($langs);

//        return redirect()->route('serverInfo', ["game" => $req->game]);
        return redirect()->route('index');
    }

    public function getGameTags($id)
    {
        return response()->json(['success' => Tag::where('game_id', $id)->get()]);
    }
}
