<?php

namespace App\Http\Controllers\back;

use App\Models\Image;
use App\Models\Language;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Request;

class LanguageController extends Controller
{
    public function list() {
        return view('back.language.list', [
            'languages' => Language::all()
        ]);
    }

    public function addStore(Request $req) {
        $validator = Validator::make($req->all(),[
            'name' => 'required|max:50',
            'file' => 'required|image|mimes:png,jpg,jpeg|max:2048'
        ]);

        if($validator->fails()){
            return response()->json([
               'status' =>400,
               'errors' =>$validator->messages()
            ]);
        }else {
            $req->file('file')->store('public/siteImage/lang');

            $path = $req->file('file')->hashName();
            Image::create([
                'user_id'   => Auth::id(),
                'name'  => $req->name,
                'alt'   =>  $req->name,
                'path'  => $path
            ]);
            $image = Image::where('path', $path)->first();

            Language::create([
                'user_id'   => Auth::id(),
                'name'      => $req->name,
                'image_id'  => $image->id
            ]);

            $l = Language::where('name', $req->name)->first();
            $l->image_id = $image->id;
            $l->save();

            $image->language_id = $l->id;
            $image->save();

            return response()->json([
                'status' =>200,
                'success' => "La langue ". $req->name ." à bien été ajouté !"
            ]);
        }
    }
}
