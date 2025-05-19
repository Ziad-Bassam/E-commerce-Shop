<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    use HasFactory;

    public function Order(){
        return $this->belongsTo(Order::class , 'order_id');
    }


    public function Product(){
        return $this->belongsTo(Product::class , 'product_id');
    }
}
