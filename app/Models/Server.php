<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'ip',
        'port',
        'website',
        'slots',
        'acces',
        'description',
        'tag',
        'discord',
        'teamspeak',
        'mumble',
        'twitch',
        'youtube',
    ];

    public function game() {
        return $this->hasMany(Game::class);
    }
}
