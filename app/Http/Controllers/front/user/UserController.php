<?php

namespace App\Http\Controllers\front\user;

use App\Http\Controllers\Controller;
use App\Mail\changeEmailAddress;
use App\Models\Server;
use App\Models\User;
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
    public function global(Request $req) {
        $req->validate([
            'pseudo' => 'nullable|unique:users|min:3|max:25',
            'email' => 'nullable|unique:users|email:rfc,dns'
        ]);
        if ($req->pseudo)
            User::find(Auth::id())->update([
                'pseudo' => Str::of($req->pseudo)->slug('_')
            ]);

        if ($req->email) {
            User::find(Auth::id())->update([
                'email' => $req->email
            ]);
            $user = Auth::user();
            Mail::to($user->email)->send(new changeEmailAddress($user, $req->email));
        }

        return redirect()->back();
    }

    /*
     * Store function for password + new password
     */
    public function password(Request $request) {
        $request->validate([
            'password' => ['required'],
            'newpass' => ['required'],
            'newpassconfirm' => ['required']
        ]);

        if (Hash::check($request->password, Auth::user()->password))
            if ($request->newpass == $request->newpassconfirm)
                User::where('id', Auth::id())->update([
                    'password' => Hash::make($request->password)
                ]);

        return redirect()->route('my-account');
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
