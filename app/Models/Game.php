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
        'logo_id',
        'image_id',
        'type',
    ];

    public function servers() {
        return $this->hasMany(Server::class);
    }

    public function image() {
        return $this->hasOne(Image::class,'id','image_id');
    }
    public function logo() {
        return $this->hasOne(Image::class, 'id','logo_id');
    }

    public function tags() {
        return $this->hasMany(Tag::class);
    }

}
