<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderDetailController;
use App\Http\Controllers\PharmacyController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductOrderController;
use App\Http\Controllers\Usercontroller;
use App\Http\Controllers\WalletphController;
use App\Http\Controllers\WalletuserController;
use App\Http\Controllers\WarehouseController;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
        //..................admin.............................................
Route::post('/adminregister',[AdminController::class,'register']);

Route::post('/adminlogin',[AdminController::class,'login']);

Route::group(['middleware' => ['auth']], function() {
    /**
    * Logout Route
    */
    Route::get('/adminlogout',[AdminController::class,'perform']);
 });

 Route::put('/adminupdate',[AdminController::class,'update']);
   
 //..........................user................................................

Route::post('/userregister',[Usercontroller::class,'register']);


Route::post('/userlogin',[Usercontroller::class,'login']);

Route::resource('/users',Usercontroller::class);

Route::put('/usersupdate',[Usercontroller::class,'update']);

Route::delete('/usersdelete',[Usercontroller::class,'destroy']);


Route::group(['middleware' => ['auth']], function() {
    /**
    * Logout Route
    */
    Route::get('/userlogout',[AdminController::class,'perform']);
 });

//...................warehouse....................................................

 Route::post('/houseregister',[WarehouseController::class,'register']);

 Route::post('/houselogin',[WarehouseController::class,'login']);

 Route::resource('/warehouse',WarehouseController::class);

 Route::put('/houseupdate',[WarehouseController::class,'update']);


 Route::delete('/housesdelete',[WarehouseController::class,'destroy']);
 
Route::group(['middleware' => ['auth']], function() {
    /**
    * Logout Route
    */
    Route::get('/warehouselogout',[WarehouseController::class,'perform']);
 });

//..................pharamcy.......................................................
 Route::post('/pharmacyregister',[PharmacyController::class,'register']);

 Route::post('/pharmacylogin',[PharmacyController::class,'login']);

 Route::resource('/pharmacy',PharmacyController::class);

 Route::put('/pharmacy',[PharmacyController::class,'update']);

 Route::delete('/pharmacy',[PharmacyController::class,'destroy']);




//..................medicine.......................................................
Route::post('/addmed',[MedicineController::class,'store']);

 Route::post('/med',[MedicineController::class,'show']);

 Route::put('/med',[MedicineController::class,'update']);
 
 Route::delete('/med',[MedicineController::class,'destroy']);

 //.................wallet pharmacy...........................................................
 Route::put('/wallet',[WalletphController::class,'store']);

 Route::get('/wallet',[WalletphController::class,'show']);

//...................wallet ueser........................

Route::put('/walletuser',[WalletuserController::class,'store']);

Route::resource('/walletuser',WalletuserController::class);

//......................order..................................
Route::resource('/addorder',OrderController::class);

Route::resource('/order/details',OrderDetailController::class);

Route::post('/getorder/details',[OrderDetailController::class,'show']);


Route::post('/order',[OrderController::class,'show']);
//.......................add product..........................

Route::resource('/product',ProductController::class);

Route::get('/allproduct',[ProductController::class,'index']);

Route::post('/product/quantity',[ProductController::class,'quantity']);


Route::put('/product',[ProductController::class,'update']);

Route::delete('/product',[ProductController::class,'destroy']);

Route::get('/product',[ProductController::class,'show']);
//.....................order product...........................

Route::resource('/orderproduct',ProductOrderController::class);




