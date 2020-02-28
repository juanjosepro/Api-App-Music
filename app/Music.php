<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Music extends Model
{
    protected $table = 'music'; 
    protected $fillable = [
        'category_id', 'artist', 'slug', 'url'
    ];

    public function category () {
        return $this->belongsTo(Category::class);
    }
}
