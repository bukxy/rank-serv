<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'path',
        'game_id',
        'server_id',
    ];

    public function game() {
        return $this->hasOne(Game::class);
    }
    public function language() {
        return $this->belongsTo(Language::class);
    }
}
