<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'name',
        'slug',
        'image_id',
    ];

    public function servers() {
        return $this->hasMany(Server::class);
    }

    public function image() {
        return $this->hasOne(Image::class);
    }

    public function tags() {
        return $this->hasMany(Tag::class);
    }

}
