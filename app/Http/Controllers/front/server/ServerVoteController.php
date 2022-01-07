<?php

namespace App\Http\Controllers\front\server;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\Server;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Lunaweb\RecaptchaV3\Facades\RecaptchaV3;
use Symfony\Component\Console\Input\Input;

class ServerVoteController extends Controller
{
    public function vote($game ,$server) {
        if(!Game::where('slug', $game)->first() || !Server::where('slug', $server)->first())
            abort('404');
        return view('server.vote', [
            'server' => Server::where('slug', $server)->first()
        ]);
    }

    public function voteStore($game ,$server, Request $req) {
        if(!Game::where('slug', $game)->first() || !Server::where('slug', $server)->first())
            abort('404');

        $this->validate($req, [
            'pseudo'                => 'max:50',
            'g-recaptcha-response'  => 'required|recaptchav3:vote,0.5'
        ]);

        if(!empty($_SERVER['HTTP_CLIENT_IP'])){
            //ip from share internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
            //ip pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }else{
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        return Redirect::back()->with('success', $ip);
    }
}
