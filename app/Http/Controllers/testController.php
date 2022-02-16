<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class testController extends Controller
{
    public function show(Request $req) {
        return view('test');
    }

    public function store(Request $request) {
        $path_url = 'storage/' . Auth::id();

        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = Str::slug($fileName) . '_' . time() . '.' . $extension;
            $request->file('upload')->move(public_path($path_url), $fileName);
            $url = asset($path_url . '/' . $fileName);
        }
//        if ($request->hasFile('upload')) {
//            $upload = $request->file('upload');
//            $path = Str::orderedUuid().'.'.$upload->extension();
//            $upload->storeAs('media/server/', $path,'s3');
//
//            $img1 = Image::create([
//                'user_id'   => Auth::id(),
//                'path'      => $path,
//            ]);
//        }
//        Storage::disk('s3')->url('media/banner/'.$s->banner->path)
        return response()->json(['url' => $url]);
//        $path2 = Str::uuid().'.'.$req->file('upload')->extension();
//        $req->file('upload')->storeAs('public/ws', $path2);
//        $i = Image::create([
//            'user_id'   => Auth::id(),
//            'path'      => $path2,
//        ]);
//        return response()->json([
//            'url' => 'https://www.soyoustart.com/fr/images/banners/wintersale.png'
//        ]);
    }
}
