<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ProductController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Auth::routes();

Route::get('/', [HomeController::class, 'index']);
Route::get('/home', [HomeController::class, 'index'])->name('home');

//for shop
Route::resource('shop',ShopController::class);
Route::get('ShopchangeStatus/{status}/{id}',[ShopController::class,'ShopchangeStatus'])->name('ShopchangeStatus');

//for product
Route::resource('product',ProductController::class);
Route::get('ProductchangeStatus/{status}/{id}',[ProductController::class,'ProductchangeStatus'])->name('ProductchangeStatus');
