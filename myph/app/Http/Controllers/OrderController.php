<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use App\Models\Order;
use App\Models\Pharmacy;
use App\Models\Walletph;
use App\Models\WalletWarehouse;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    return view('welcome')->with('orders', Order::where('id',2)->get());

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   

        Order::create([
            'id_ph'=>$request->id_ph,
        ]);

// //....add quantity...............
//         $quantity=$request->quantity;

// //....get med quantity............
//         $data=Medicine::where('id',$request->id_med)->first();
//         $oldquantity=$data->quantity;
// //.....get price..................
//         $price=$data->price_pharmacy*$request->quantity;
// //.....get pharmacy fund..........
//         $wallet= Walletph::where('ph_id',$request->id_ph)->first();
//         $fund=$wallet->funds;
     
//         if($quantity<=$oldquantity && $price<=$fund){
// //.....new med quantity............
//         $quantity=$oldquantity-$quantity;

//         Medicine::where('id',$request->id_med)->update([
//             'quantity'=>$quantity,
//         ]);
// //.....new fund for ph..................
//        $fund=$fund-$price;

//        Walletph::where('ph_id',$request->id_ph)->update([
//         'funds'=>$fund
//        ]);
// //......creat order...........................
//        Order::create([
//         'id_med'=>$request->id_med,
//         'id_ph'=>$request->id_ph,
//         'quantity'=>$request->quantity,
//         'total_price'=>$price,
//        ]);
// //..........add price to warehouse wallet.....
//        $warehouse=WalletWarehouse::where('warehouse_id',$data->warehouse_id)->first();

//        if($warehouse){
//         $oldfunds=$warehouse->funds;
//         $oldfunds=$oldfunds+$price;
//         WalletWarehouse::where('warehouse_id',$data->warehouse_id)->update([
//         'funds'=>$oldfunds,
//         ]);}else{
//             WalletWarehouse::where('warehouse_id',$data->warehouse_id)->create([
//                 'funds'=>$price,
//                 'warehouse_id'=>$data->warehouse_id,
//             ]);
//         }
       
//     //.........add med to the pharmacy.........
//     ;}else{
//         return("errore");
//     }

    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $data=Medicine::where('warehouse_id',$request->id)->get();
        foreach($data as $result){
        $order= Order::where('id_med',$result->id)->get();
         return json_decode($order);
        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
