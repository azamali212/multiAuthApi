<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/create', [AuthController::class, 'create']);
Route::post('/login', [AuthController::class, 'login']);

Route::group(['prefix'=>'user','middleware'=> ['auth:api']],function(){
    Route::get('/dashboard', [AuthController::class, 'dashboard']);
});

Route::post('customer/create', [AuthController::class, 'createCustomer']);
Route::post('customer/login', [AuthController::class, 'customerLogin']);

Route::group(['prefix'=>'customer','middleware'=> ['auth:customer-api']],function(){
    Route::get('/dashboard', [AuthController::class, 'customerDashboard']);
});

Route::post('shop/create', [AuthController::class, 'createShop']);
Route::post('shop/login', [AuthController::class, 'shopLogin']);

Route::group(['prefix'=>'shop','middleware'=> ['auth:shop-api']],function(){
    Route::get('/dashboard', [AuthController::class, 'shopDashboard']);
});

