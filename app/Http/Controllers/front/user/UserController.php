<?php

namespace App\Http\Controllers\front\user;

use App\Http\Controllers\Controller;
use App\Mail\changeEmailAddress;
use App\Mail\changePassword;
use App\Models\MailWaiteds;
use App\Models\Server;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller {

    public function account() {
        return view('user.account', [
            'user' => User::where('id', Auth::id())->first()
        ]);
    }

    public function servers() {
        return view('user.servers', [
            'servers' => Server::where('user_id', Auth::id())->get()
        ]);
    }

    public function settings() {
        return view('user.settings', ['user' => Auth::user()]);
    }

    /*
     * Store function for pseudo + Email
     */
    public function globalStore(Request $req) {
        $req->validate([
            'pseudo' => 'nullable|unique:users|min:3|max:25',
            'email' => 'nullable|unique:users|email:rfc,dns'
        ]);
        if ($req->pseudo)
            User::find(Auth::id())->update([
                'pseudo' => Str::of($req->pseudo)->slug('_')
            ]);

        if ($req->email) {
//            User::find(Auth::id())->update([
//                'email' => $req->email
//            ]);
            MailWaiteds::create([
                'user_id'       => Auth::id(),
                'motif'         => 'changeEmail',
                'token'         => Str::random(40),
                'expiration'    => Carbon::now()->second(0)->addDay(1),
            ]);
            $user = Auth::user();
            Mail::to($user->email)->send(new changeEmailAddress($user, $req->email));
        }

        return redirect()->back();
    }

    /*
     * Store function for password + new password
     */
    public function changePasswordStore(Request $request) {
        $request->validate([
            'password' => 'required',
            'newpass' => 'required|confirmed|min:10|max:50',
        ]);

        if (Hash::check($request->password, Auth::user()->password)) {
            User::find(Auth::id())->update([
                'password' => Hash::make($request->password)
            ]);
            $user = Auth::user();
            Mail::to($user->email)->send(new changePassword($user));
        }

        return redirect()->back();
    }

//    /*
//     * Store function for Avatar
//     */
//    public function avatar(Request $request) {
//        $request->validate([
//            'pseudo' => ['unique:users', 'nullable' ,'max:25'],
//            'email' => ['unique:users', 'nullable' ,'email:rfc,dns']
//        ]);
//        if(!$request->hasAny(['pseudo', 'email']) )
//            User::where('id', Auth::id())->update([
//                'pseudo' => $request->pseudo
//            ]);
//
//        return redirect()->route('my-account');
//    }

}
