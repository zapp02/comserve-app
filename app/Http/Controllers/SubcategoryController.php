<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class SubcategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['list']);
        $this->middleware('auth:api')->only(['store','update','destroy']);
    }

    public function list() {
        
        $categories = Category::all();
        return view ('subcategory.index', compact('categories'));
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subcategories = Subcategory::with('category') -> get();

        return response() -> json([
            'data' => $subcategories
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
            'subcategory_name' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg'
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

        $subcategory = Subcategory::create($input);

        return response() -> json([
            'success' => true,
            'data' => $subcategory
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Subcategory $subcategory)
    {
        return response() -> json([
            'data' => $subcategory
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subcategory $subcategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subcategory $subcategory)
    {
        $validator = Validator::make($request -> all(), [
            'id_category' => 'required',
            'subcategory_name' => 'required',
            'description' => 'required'
        ]);
        if ($validator -> fails()){
            return response() -> json(
                $validator -> errors(), 422
            );
        }

        $input = $request -> all();

        if ($request -> has('image')){
            File::delete('uploads/' . $subcategory -> image);

            $image = $request -> file('image');
            $image_name = time() . rand(1,9) . '.' . $image ->getClientOriginalExtension();
            $image -> move('uploads', $image_name);
            $input ['image'] = $image_name;
        }else{
            unset ($input['image']);
        }

        $subcategory -> update($input);

        return response() -> json ([
            'success' => true,
            'message' => 'Subcategory Updated',
            'data' => $subcategory
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subcategory $subcategory)
    {
        File::delete('uploads/'. $subcategory -> image);
        $subcategory -> delete();

        return response() -> json([
            'success' => true,
            'message' => 'Subcategory Deleted'
        ]);
    }
}
