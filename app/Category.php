<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
    protected $fillable = [
        'name',
        'description'
    ];

    // db relations
    public function comics() {
        return $this->hasMany('App\Comic');
    }
}
