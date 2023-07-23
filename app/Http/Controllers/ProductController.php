<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Shop;
use App\Models\ShopStock;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
          $product = Product::getProductData();
          return Datatables::of($product)
            ->addColumn('action','product.action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->tojson();
        }
        
        return view('product.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $shops = Shop::getActiveShop();
        return view('product.create',compact('shops'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'product_name' => 'required|unique:products,name',
            'price' => 'required',
        ],[
            'product_name.required'=>'Please Enter product Name',
        ]);
        
        
        $product = new product;
        $product->name = $request->product_name;
        $product->price = $request->price;
        $product->upc = $request->upc;
        $product->save();

        $stock = $request->stock;
        if(isset($stock) && count($stock) > 0){
            $shops = Shop::getActiveShop();
            foreach($shops as $key=>$shop){
                if(isset($stock[$key]) && $stock[$key] != null){
                    ShopStock::insertUpdateData($shop->id, $product->id, $stock[$key]);
                }
            }
        }
                        
        return redirect()->route('product.index')->with('success','New product created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = product::find($id);        
        $stock_data = ShopStock::getDataByProduct($id)->toArray();
        $shops = Shop::getActiveShop();
        return view('product.edit',compact('product','stock_data','shops'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $this->validate($request, [
            'product_name' => 'required|unique:products,name,'.$id,
            'price' => 'required',
        ],[
            'product_name.required'=>'Please Enter product Name',
        ]);
        

        $product = product::find($id);
        $product->name = $request->product_name;
        $product->price = $request->price;
        $product->save();

        $stock = $request->stock;
        if(isset($stock) && count($stock) > 0){
            $shops = Shop::getActiveShop();
            foreach($shops as $key=>$shop){
                if(isset($stock[$key]) && $stock[$key] != null){
                    ShopStock::insertUpdateData($shop->id, $product->id, $stock[$key]);
                }
            }
        }
        
        
        return redirect()->route('product.index')->with('success','product Update successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function productchangeStatus($status,$id)
    {
        $product = product::find($id);
        $product->is_active = $status;
        $product->save();
        
    }
}
