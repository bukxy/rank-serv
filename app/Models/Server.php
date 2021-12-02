<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'game_id',
        'banner_id',
        'logo_id',
        'name',
        'slug',
        'ip',
        'website',
        'slots',
        'access',
        'description',
        'language',
        'discord',
        'teamspeak',
        'mumble',
        'twitch',
        'youtube',
        'vote',
        'click',
    ];

    public function game() {
        return $this->hasMany(Game::class);
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
}
