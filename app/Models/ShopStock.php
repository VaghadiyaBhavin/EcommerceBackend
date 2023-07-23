<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShopStock extends Model
{
    use HasFactory;
    protected $table = 'shop_stocks';

    public static function insertUpdateData($shop_id, $product_id, $stock){
        $shop_stock = ShopStock::where(array('shop_id'=>$shop_id,'product_id'=>$product_id))->first();
        if($shop_stock == null){
            $shop_stock = new ShopStock;
            $shop_stock->shop_id = $shop_id;
            $shop_stock->product_id = $product_id;            
        }
        $shop_stock->qty = $stock;
        $shop_stock->save();
    }

    public static function getDataByProduct($product_id){
        return ShopStock::where('product_id',$product_id)->get();        
    }
}
