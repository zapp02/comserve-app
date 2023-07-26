<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['list']);
        $this->middleware('auth:api')->only(['store','update','destroy']);

    }

    public function list() {
        
        $categories = Category::all();
        $subcategories = Subcategory::all();

        return view ('product.index', compact('categories', 'subcategories'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category', 'subcategory')->get();

        return response() -> json([
            'data' => $products
        ]);
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
        $validator = Validator::make($request -> all(), [
            'id_category' => 'required',
            'id_subcategory' => 'required',
            'product_name' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg',
            'description' => 'required',
            'requirements'=>'required',
            'period' => 'required',
            'location' => 'required',
            'obtained' => 'required',
        ]);
        if ($validator -> fails()){
            return response() -> json(
                $validator -> errors(), 422
            );
        }

        $input = $request -> all();
        if ($request -> has('image')){
            $image = $request -> file('image');
            $image_name = time() . rand(1,9) . '.' . $image ->getClientOriginalExtension();
            $image -> move('uploads', $image_name);
            $input ['image'] = $image_name;
        }

        $product = Product::create($input);

        return response() -> json([
            'success' => true,
            'data' => $product
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return response() -> json([
            'success' => true,
            'data' => $product
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validator = Validator::make($request -> all(), [
            'id_category' => 'required',
            'id_subcategory' => 'required',
            'product_name' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg',
            'description' => 'required',
            'period' => 'required',
            'location' => 'required',
            'obtained' => 'required',
        ]);
        if ($validator -> fails()){
            return response() -> json(
                $validator -> errors(), 422
            );
        }

        $input = $request -> all();

        if ($request -> has('image')){
            File::delete('uploads/' . $product -> image);

            $image = $request -> file('image');
            $image_name = time() . rand(1,9) . '.' . $image ->getClientOriginalExtension();
            $image -> move('uploads', $image_name);
            $input ['image'] = $image_name;
        }else{
            unset ($input['image']);
        }

        $product -> update($input);

        return response() -> json ([
            'success' => true,
            'message' => 'Product Updated',
            'data' => $product
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        File::delete('uploads/'. $product -> image);
        $product -> delete();

        return response() -> json([
            'success' => true,
            'message' => 'Product Deleted'
        ]);
    }
}
