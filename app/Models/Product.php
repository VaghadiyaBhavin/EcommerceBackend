<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;


class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    public static function getProductData(){
        return Product::get();
    }

    public static function generateUpc(){
        $str = Str::random(8);
        $product = Product::where('upc',$str)->first();
        if($product != null){
            Product::generateUpc();
        }
        return $str;
    }
}
