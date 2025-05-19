<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;


    public function Cart(){
        return $this->hasMany(Cart::class);
    }

    public function Category(){
        return $this->belongsTo(Category::class , 'category_id');
    }

    public function ProductPhotos(){
        return $this->hasMany(ProductPhoto::class);
    }


    public function OrderDetails(){
        return $this->hasMany(OrderDetails::class);
    }

}
