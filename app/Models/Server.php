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
        'name',
        'ip',
        'website',
        'slots',
        'access',
        'description',
        'lang',
        'tag',
        'language',
        'discord',
        'teamspeak',
        'mumble',
        'twitch',
        'youtube',
    ];

    public function game() {
        return $this->hasMany(Game::class);
    }

    public function tags() {
        return $this->hasMany(Tag::class);
    }
}
