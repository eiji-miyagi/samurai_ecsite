<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
// カテゴリと商品を紐付け
    public function category()
    {
        return $this->belongsTo('App\Category');
    }
    
}
