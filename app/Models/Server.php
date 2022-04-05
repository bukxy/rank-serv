<?php

namespace App\Models;

use eloquentFilter\QueryFilter\ModelFilters\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    use HasFactory;
    use Filterable;

//    protected $fillable = [
//        'user_id',
//        'game_id',
//        'banner_id',
//        'logo_id',
//        'name',
//        'slug',
//        'ip',
//        'port',
//        'query',
//        'host_id',
//        'website',
//        'slots',
//        'access',
//        'description',
//        'language',
//        'discord',
//        'teamspeak',
//        'teamspeak_port',
//        'mumble',
//        'mumble_port',
//        'twitch',
//        'youtube',
//        'vote',
//        'click',
//        'api',
//    ];

    protected $guarded = [];

    public function game() {
        return $this->hasOne(Game::class, 'id', 'game_id');
    }

    public function tags() {
        return $this->belongsToMany(Tag::class, 'tag_server', 'server_id', 'tag_id');
    }

    public function languages() {
        return $this->belongsToMany(Language::class, 'lang_server', 'server_id', 'lang_id');
    }

    public function banner() {
        return $this->hasOne(Image::class, 'id', 'banner_id');
    }

    public function logo() {
        return $this->hasOne(Image::class, 'id', 'logo_id');
    }

    public function host($id) {
        $lang = Language::where('id',$id)->first();
        $image = Image::find($lang->image_id);
        return [$lang->name,$image->path];
    }

}
