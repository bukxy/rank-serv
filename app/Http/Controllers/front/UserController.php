<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;
use Symfony\Component\HttpFoundation\Request;

class UserController extends Controller {

    public function account() {
        return view('user.account', [
            'user' => User::where('id', Auth::id())->first()
        ]);
    }

    public function servers() {
        return view('user.servers');
    }

    public function settings() {
        return view('user.settings');
    }

    /*
     * Store function for pseudo + Email
     */
    public function global(Request $request) {
        $request->validate([
            'pseudo' => ['unique:users', 'nullable' ,'max:25'],
            'email' => ['unique:users', 'nullable' ,'email:rfc,dns']
        ]);
        if(!$request->hasAny(['pseudo', 'email']) )
            User::where('id', Auth::id())->update([
                'pseudo' => $request->pseudo
            ]);

        return redirect()->route('my-account');
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
