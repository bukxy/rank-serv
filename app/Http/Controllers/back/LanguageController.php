<?php

namespace App\Http\Controllers\back;

use App\Models\Image;
use App\Models\Language;
use App\Models\Server;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
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
            $imageName = Str::of($req->name)->slug('-').'.'.$req->file('file')->extension();
            $req->file('file')->storeAs('public/langs', $imageName);
            $path = 'langs/'.$imageName;

            $image = Image::create([
                'user_id'   => Auth::id(),
                'path'  => $path
            ]);

            $lang = Language::create([
                'user_id'   => Auth::id(),
                'name'      => $req->name,
                'image_id'  => $image->id
            ]);

            $lang->image_id = $image->id;
            $lang->save();

            return response()->json([
                'status' =>200,
                'success' => "Le language ". $req->name ." à bien été ajouté !"
            ]);
        }
    }

    /*
     * AJAX LANG EDIT -> back/language.js
     */
    public function langGet(Request $req) {
        $l = Language::where('id', $req->id)->first();
        if($l != null) {
            return response()->json([
                'status' => 200,
                'success' => $l
            ]);
        } else {
            return response()->json([
                'status' => 400,
                'error' => 'Lang "ID" doesn\'t exist'
            ]);
        }
    }
    /*
     * AJAX LANG EDIT POST UPDATE
     */
    public function langEditStore(Request $req) {
        $validator = Validator::make($req->all(),[
            'name' => 'unique:languages|max:50',
            'file' => 'image|mimes:png,jpg,jpeg|max:2048'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' =>400,
                'errors' =>$validator->messages()
            ]);
        }else {
            if($req->name){
                $l = Language::find($req->id);
                Language::where('id', $req->id)->update([
                    'user_id'   => Auth::id(),
                    'name'  => $req->name
                ]);
                if(!$req->file('file'))
                    return response()->json([
                        'status' =>200,
                        'success' => "Le language \"".$l->name."\" à été renommé en \"".$req->name."\" !"
                    ]);
            }
            if($req->file('file')){
                $l = Language::find($req->id);
                $i = Image::find($l->image_id);
                File::delete('media/'.$i->path);

                if($req->name){
                    $image = Str::of($req->name)->slug('-').'.'.$req->file('file')->extension();
                    $req->file('file')->storeAs('public/langs', $image);
                    Image::where('id', $l->image_id)->update([
                        'user_id'   => Auth::id(),
                        'path'  => 'langs/'.$image
                    ]);
                    return response()->json([
                        'status' =>200,
                        'success' => "Le language \"".$l->name."\" à été renommé en \"".$req->name."\" !"
                    ]);
                } else {
                    $image = Str::of($l->name)->slug('-').'.'.$req->file('file')->extension();
                    $req->file('file')->storeAs('public/langs', $image);
                    Image::where('id', $l->image_id)->update([
                        'path'  => 'langs/'.$image
                    ]);
                    return response()->json([
                        'status' =>200,
                        'success' => "Le language \"".$l->name."\" à été modifier !"
                    ]);
                }
            }
            return response()->json([
                'status' => 200,
                'success' => "Le language n'a pas été changé !"
            ]);
        }
    }

    public function deleteStore(Request $req) {

        $validator = Validator::make($req->all(),[
            'id' => 'required',
        ]);

        $lang = Language::find($req->id);
        if($validator && $lang !== null){

            $servers = Server::where('game_id', $lang->game_id)->get();
            
            foreach ($servers as $s) {
                $s->languages()->detach($lang->id);
            }

//            $servers = Server::where('game_id', $req->id)->get();
//            if(count($servers) > 0)
//                return redirect()->back()->with('error', 'Ce language est utilisé par"'.count($servers).'" servers! Il n\'est pas possible de le supprimer...');

            $image = Image::find($lang->image_id);
            File::delete('media/'.$image->path);
            $lang->delete();
            $image->delete();
            return redirect()->back()->with('success', 'Le jeu "'.$lang->name.'" à été supprimé !');
        }
    }
}
