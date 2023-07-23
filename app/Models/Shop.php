<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Shop extends Model
{
    use HasFactory;

    protected $table = 'shops';

    public static function getShopData(){
        return Shop::get();
    }

    public static function getActiveShop(){
        return Shop::where('is_active',1)->get();
    }
}
