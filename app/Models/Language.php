<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'name',
        'image_id',
    ];

    public function image() {
        return $this->hasOne(Image::class,'id', 'image_id');
    }
}
