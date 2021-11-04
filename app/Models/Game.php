<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'tag',
    ];

    public function servers() {
        return $this->hasMany(Server::class);
    }

    public function image() {
        return $this->hasOne(Image::class);
    }

}
