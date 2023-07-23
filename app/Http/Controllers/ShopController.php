<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use Yajra\Datatables\Datatables;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
          $shop = Shop::getShopData();
          return Datatables::of($shop)
            ->addColumn('action','shop.action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->tojson();
        }
        
        return view('shop.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('shop.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'shop_name' => 'required|unique:shops,name',
            'address' => 'required|max:255',
            'coordinates' => 'required',
        ],[
            'shop_name.required'=>'Please Enter Shop Name',
        ]);
        

        $shop = new Shop;
        $shop->name = $request->shop_name;
        $shop->coordinates = $request->coordinates;
        $shop->address = $request->address;
        $shop->save();
        
        
        return redirect()->route('shop.index')->with('success','New Shop created successfully');
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
        $shop = Shop::find($id);
        return view('shop.edit',compact('shop'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'shop_name' => 'required|unique:shops,name,'.$id,
            'address' => 'required',
            'coordinates' => 'required',
        ],[
            'shop_name.required'=>'Please Enter Shop Name',
            'shop_name.unique:shops,name,'.$id =>'Shop Namme Already Exists',
        ]);
        

        $shop = Shop::find($id);
        $shop->name = $request->shop_name;
        $shop->coordinates = $request->coordinates;
        $shop->address = $request->address;
        $shop->save();
        
        
        return redirect()->route('shop.index')->with('success','Shop Update successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function ShopchangeStatus($status,$id)
    {
        $shop = Shop::find($id);
        $shop->is_active = $status;
        $shop->save();
        
    }
}
