<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'name',
        'game_id',
    ];

    public function game() {
        return $this->hasOne(Game::class);
    }

    public function servers() {
        return $this->belongsToMany(Server::class);
    }
}
