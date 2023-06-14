<?php

namespace App\Http\Controllers;

use App\Models\medicine;
use Illuminate\Http\Request;

class MedicineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      
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
        $request->validate([
           'name'=>'required|string',
           'image'=>'required|mimes:jpg,png,jped',
           'mg'=>'required|integer',
           'exp'=>'required|string',
           'price_pharmacy'=>'required|integer',
           'price_customer'=>'required|integer',
           'composition'=>'required|string',
           'quantity'=>'required|integer',
           'warehouse_id'=>'required|string',
           'category_id'=>'required|string',
        ]);
        
         $newimage=uniqid().'-'.$request->title.'.'.$request->image->extension();
        $request->image->move(public_path('images'),$newimage);
        Medicine::create([
            'name'=>request('name'),
            'image'=>$newimage,
            'mg'=>request('mg'),
            'exp'=>request('exp'),
            'price_pharmacy'=>request('price_pharmacy'),
            'price_customer'=>request('price_customer'),
            'composition'=>request('composition'),
            'quantity'=>request('quantity'),
            'warehouse_id'=>request('warehouse_id'),
            'category_id'=>request('category_id'),


        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        return Medicine::where('warehouse_id',$request->warehouse_id)->get();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(medicine $medicine)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, medicine $medicine)
    {
        //$newimage=uniqid().'-'.$request->title.'.'.$request->image->extension();
       // $request->image->move(public_path('images'),$newimage);
        Medicine::where('id',$request->id)->update([
            'name'=>request('name'),
            'image'=>request('image'),
            'mg'=>request('mg'),
            'exp'=>request('exp'),
            'price_pharmacy'=>request('price_pharmacy'),
            'price_customer'=>request('price_customer'),
            'composition'=>request('composition'),
            'quantity'=>request('quantity'),
            'warehouse_id'=>request('warehouse_id'),
            'category_id'=>request('category_id'),


        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        Medicine::where('id',$request->id)->delete();
    }
}
