<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name', 'description'
    ];

    public function musics () {
        return $this->hasMany(Music::class);
    }


    public function image () {
        return $this->morphMany(Image::class, 'imageable');
    }
}
