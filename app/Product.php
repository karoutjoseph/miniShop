<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
   //one_to_many relation between products and categories
   public function category()
   {
       return $this->belongsTo('App\Category');
   }

   //one_to_many relationship products and images
   public function images()
   {
       return $this->hasMany('App\Image');
   }

   //one_to_many relationship products and favorite
   public function favorites()
   {
       return $this->hasMany('App\Favorite');
   }

   //one_to_many relationship products and orders
   public function orders()
   {
       return $this->hasMany('App\Order');
   }

   public function carts()
   {
       return $this->hasMany('App\Cart');
   }
}
