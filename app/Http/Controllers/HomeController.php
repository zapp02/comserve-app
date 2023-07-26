<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\Testimoni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function index() {
        $categories = Category::all();
        $testimonis = Testimoni::all();
        $products = Product::all();
        return view('home.index', compact('categories','testimonis','products'));
    }

    public function products($id_subcategory) {
        $products = Product::where('id_subcategory', $id_subcategory)->get();        
        return view('home.products', compact('products'));
    }
    
    public function add_to_cart(Request $request){
        $input = $request->all();
        Cart::create($input);

    }

    public function delete_from_cart(Cart $cart){
        $cart->delete();
        return redirect('/cart');
    }

    public function product($id_product) {
        if (!Auth::guard('webmember')->user()) {
            return redirect('/login_member');
        }
        $product = Product::find($id_product);        
        return view('home.product', compact('product'));
    }

    public function cart() {
        if (!Auth::guard('webmember')->user()) {
            return redirect('/login_member');
        }

        $carts = Cart::where('member_id', Auth::guard('webmember')->user()->id)->where('is_checkout',0)->get();
        $cart_total = Cart::where('member_id', Auth::guard('webmember')->user()->id)->where('is_checkout',0)->sum('total');
        return view('home.cart', compact('carts', 'cart_total'));
    }

    public function checkout_orders(Request $request) {
        $cart_total = Cart::where('member_id', Auth::guard('webmember')->user()->id)->sum('total');

        $id = DB::table('orders')->insertGetId([
            'member_id'=>$request->member_id,
            'invoice'=> date('ymds'),
            'order_total'=>$cart_total,
            'status' => 'Requested',
        ]);

        for ($i=0; $i < count($request->id_product); $i++) { 
            DB::table('orders_details')->insert([
                'id_order' => $id,
                'id_product' => $request->id_product[$i],
                'quantity' => $request->quantity[$i],
                'period' => $request->period[$i],
                'total' => $request->total[$i],
            ]);
        }

        Cart::where('member_id', Auth::guard('webmember')->user()->id)->update([
            'is_checkout' => 1
        ]);
    }

    public function checkout() {
        return view('home.checkout');
    }

    public function orders() {
        return view('home.orders');
    }

    public function contact() {

        return view('home.contact');
    }
}
