<?php

namespace App\Http\Controllers\front\server;

use App\Http\Controllers\Controller;
use App\Models\Game;
use App\Models\Server;
use App\Models\VoteProtect;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

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

        $vote = VoteProtect::where('ip', $ip)->first();

        $cookie_timer = 120; // 120 minutes
        if ($vote){

            $expiration_timer = Carbon::now()->tz('Europe/Paris')->second(0)->diffInMinutes(Carbon::createFromDate($vote->expiration));
            $cookie_timeleft = $cookie_timer - $expiration_timer;
            if(!$req->cookie('vote_')) {
                return Redirect::back()->with('error', 'You need wait 2 hour !')->withCookie('vote_', Carbon::now()->tz('Europe/Paris')->second(0)->subMinutes($expiration_timer),$cookie_timeleft);
            }
            return Redirect::back()->with(['error' => 'You need wait 2 hour !','expiration_date' => Carbon::now()->tz('Europe/Paris')->addMinutes($cookie_timeleft)->format('H\h \a\n\d i\\m')]);
        }

        VoteProtect::create([
            'ip' => $ip,
            'expiration' => Carbon::now()->tz('Europe/Paris')->second(0)->toDateTimeString()
        ]);

        Server::where('slug', $server)->update([
            'vote' => +1
        ]);

        return Redirect::back()->with('success', $ip)->withCookie('vote_', Carbon::now()->tz('Europe/Paris')->second(0)->addMinutes(120)->toDateTimeString() , $cookie_timer);
    }
}
