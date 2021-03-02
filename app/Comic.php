<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comic extends Model
{
    protected $fillable = [
        'category_id',
        'image',
        'image_hero',
        'image_cover',
        'title',
        'slug',
        'price',
        'body'
    ];
    // db relations
    public function category() {
        return $this->belongsTo('App\Category');
    }

    public function characters() {
        return $this->belongsToMany('App\Character');
    }
}
