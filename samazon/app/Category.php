<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{// カテゴリと商品を紐付け
    public function products()
    {
     return $this->hasMany('App\Product');
    }
    
}
