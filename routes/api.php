<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\TestimoniController;

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

/*
    Entry Point API
*/
Route::group(['middleware'=>'api','prefix'=>'auth'],function(){
    Route::post('/register',[AuthController::class,'register']);
    Route::post('/admin',[AuthController::class,'login']);
    Route::post('/login',[AuthController::class,'login_member']);
    Route::post('/logout',[AuthController::class,'logout']);
});

/*
    Other API's
*/
Route::group([
    'middleware'=>'api'
],function() {
    Route::resources([
        'categories' => CategoryController::class,
        'subcategories' => SubCategoryController::class,
        'sliders' => SliderController::class,
        'products' => ProductController::class,
        'members' => MemberController::class,
        'testimonis' => TestimoniController::class,
        'reviews' => ReviewController::class,
        'orders' => OrderController::class,
        'payments' => PaymentController::class,
    ]);

    Route::get('order/requested',[OrderController::class,'requested']);
    Route::get('order/approved',[OrderController::class,'approved']);
    Route::get('order/ongoing',[OrderController::class,'ongoing']);
    Route::get('order/done',[OrderController::class,'done']);

    Route::post('order/status_change/{order}',[OrderController::class,'status_change']);

    Route::get('reports',[ReportController::class,'get_reports']);

});