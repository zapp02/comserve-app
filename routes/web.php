<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\TestimoniController;
use Illuminate\Support\Facades\Route;

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

//AUTH
Route::get('/login',[AuthController::class,'index'])->name('login');
Route::post('/login',[AuthController::class,'login']);
Route::get('/logout',[AuthController::class,'logout']);

Route::get('/login_member',[AuthController::class,'login_member']);
Route::post('/login_member',[AuthController::class,'login_member_action']);
Route::get('/logout_member',[AuthController::class,'logout_member']);

Route::get('/register_member',[AuthController::class,'register_member']);
Route::post('/register_member',[AuthController::class,'register_member_action']);

//MENU
Route::get('/category',[CategoryController::class,'list']);
Route::get('/subcategory',[SubcategoryController::class,'list']);
Route::get('/slider',[SliderController::class,'list']);
Route::get('/product',[ProductController::class,'list']);
Route::get('/testimony',[TestimoniController::class,'list']);
Route::get('/review',[ReviewController::class,'list']);
Route::get('/payment',[PaymentController::class,'list']);

//STATUS
Route::get('/order/requested',[OrderController::class,'list']);
Route::get('/order/approved',[OrderController::class,'approved_list']);
Route::get('/order/ongoing',[OrderController::class,'ongoing_list']);
Route::get('/order/done',[OrderController::class,'done_list']);

Route::get('/report',[ReportController::class,'index']);

Route::get('/dashboard',[DashboardController::class,'index']);

//HOME
Route::get('/', [HomeController::class,'index']);
Route::get('/products/{category}', [HomeController::class,'products']);
Route::get('/product/{id}', [HomeController::class,'product']);
Route::get('/cart', [HomeController::class,'cart']);
Route::get('/checkout', [HomeController::class,'checkout']);
Route::get('/orders', [HomeController::class,'orders']);
Route::get('/contact', [HomeController::class,'contact']);
Route::post('/add_to_cart', [HomeController::class,'add_to_cart']);
Route::get('/delete_from_cart/{cart}', [HomeController::class,'delete_from_cart']);

Route::post('/checkout_orders', [HomeController::class,'checkout_orders']);
Route::post('/payments', [HomeController::class,'payments']);

Route::post('/order_done/{order}', [HomeController::class,'order_done']);