<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductOrder;
use App\Models\Walletuser;
use Illuminate\Http\Request;

class ProductOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        $data=Product::where('id',$request->product_id)->first();
        $quantity=$data->quantity;
        $x=$request->x;
        $quantity=$quantity-$x;
        Product::where('id',$request->product_id)->update([
        'quantity'=>$quantity,
        ]);
        $price=$data->price;
        $totalprice=$price*$x;

        ProductOrder::create([
            'user_id'=>$request->id,
            'product_id'=>$request->product_id,
            'quantity'=>$x,
            'price'=>$totalprice,
        ]);
         $wallet=Walletuser::where('user_id',$request->id)->first();
        $funds=$wallet->funds;
        $funds=$funds-$totalprice;
         Walletuser::where('user_id',$request->id)->update([
             'funds'=> $funds,
         ]);
    }

    public function show(ProductOrder $productOrder)
    {
        //
    }

    public function edit(ProductOrder $productOrder)
    {
    
    }

    public function update(Request $request, ProductOrder $productOrder)
    {

    }

    public function destroy(ProductOrder $productOrder)
    {
        //
    }
}
