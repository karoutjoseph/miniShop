<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //one to many categories products
    public function products()
    {
        return $this->hasMany('App\Product');
    }
}
