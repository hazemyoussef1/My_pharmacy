<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Walletph;
use App\Models\WalletWarehouse;
use Illuminate\Http\Request;

class OrderDetailController extends Controller
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
        //....add quantity...............
        $quantity=$request->quantity;

//....get med quantity............
        $data=Medicine::where('id',$request->medicine_id)->first();
        $oldquantity=$data->quantity;
//.....get price..................
        $price=$data->price_pharmacy*$request->quantity;
//.....get pharmacy fund..........
        $orderuser=Order::where('id',$request->order_id)->first();
        $id=$orderuser->id_ph;
       $wallet= Walletph::where('ph_id',$id)->first();
        $fund=$wallet->funds;
     
        if($quantity<=$oldquantity && $price<=$fund){
//.....new med quantity............
        $quantity=$oldquantity-$quantity;

        Medicine::where('id',$request->medicine_id)->update([
            'quantity'=>$quantity,
        ]);
//.....new fund for ph..................
       $fund=$fund-$price;

       Walletph::where('ph_id',$id)->update([
        'funds'=>$fund
       ]);
//......creat order...........................
       OrderDetail::create([
        'order_id'=>$request->order_id,
        'medicine_id'=>$request->medicine_id,
        'quantity'=>$request->quantity,
        'price'=>$price,
       ]);
//..........add price to warehouse wallet.....
       $warehouse=WalletWarehouse::where('warehouse_id',$data->warehouse_id)->first();

       if($warehouse){
        $oldfunds=$warehouse->funds;
        $oldfunds=$oldfunds+$price;
        WalletWarehouse::where('warehouse_id',$data->warehouse_id)->update([
        'funds'=>$oldfunds,
        ]);}else{
            WalletWarehouse::where('warehouse_id',$data->warehouse_id)->create([
                'funds'=>$price,
                'warehouse_id'=>$data->warehouse_id,
            ]);

        }
       
    //.........add med to the pharmacy.........
    ;}else{
        return("errore");
    }
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
       
             $rows=OrderDetail::where('order_id',$request->order_id)->get();
             json_decode($rows);
             

        
       
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OrderDetail $orderDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OrderDetail $orderDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OrderDetail $orderDetail)
    {
        //
    }
}
