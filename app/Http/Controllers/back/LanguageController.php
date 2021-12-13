<?php

namespace App\Http\Controllers\back;

use App\Models\Image;
use App\Models\Language;
use App\Models\Server;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
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
            $req->file('file')->store('public/ws');

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

    public function deleteStore(Request $req) {

        $validator = Validator::make($req->all(),[
            'id' => 'required',
        ]);

        if($validator){
            $servers = Server::where('game_id', $req->id)->get();
            if(count($servers) > 0)
                return redirect()->back()->with('error', 'Ce language est utilisé par"'.count($servers).'" servers! Il n\'est pas possible de le supprimer...');

            $lang = Language::find($req->id);
            $image = Image::find($lang->image_id);
            File::delete('media/ws/'.$image->path);
            $lang->delete();
            $image->delete();
            return redirect()->back()->with('success', 'Le jeu "'.$lang->name.'" à été supprimé !');
        }
    }
}
