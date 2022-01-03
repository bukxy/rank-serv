<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'name',
        'path',
    ];

    public function game() {
        return $this->belongsToMany(Game::class);
    }
    public function language() {
        return $this->belongsTo(Language::class);
    }
    public function server() {
        return $this->belongsToMany(Server::class);
    }
}
