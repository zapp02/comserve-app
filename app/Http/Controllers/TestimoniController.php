<?php

namespace App\Http\Controllers;

use App\Models\Testimoni;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class TestimoniController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['list']);
        $this->middleware('auth:api')->only(['store','update','destroy']);

    }

    public function list() {

        return view ('testimony.index');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $testimonis = Testimoni::all();

        return response() -> json([
            'success' => true,
            'data' => $testimonis
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
            'testimoni_name' => 'required',
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

        $testimoni = Testimoni::create($input);

        return response() -> json([
            'success' => true,
            'data' => $testimoni
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Testimoni $testimoni)
    {
        return response() -> json([
            'success' => true,
            'data' => $testimoni
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Testimoni $testimoni)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Testimoni $testimoni)
    {
        $validator = Validator::make($request -> all(), [
            'testimoni_name' => 'required',
            'description' => 'required'
        ]);
        if ($validator -> fails()){
            return response() -> json(
                $validator -> errors(), 422
            );
        }

        $input = $request -> all();

        if ($request -> has('image')){
            File::delete('uploads/' . $testimoni -> image);

            $image = $request -> file('image');
            $image_name = time() . rand(1,9) . '.' . $image ->getClientOriginalExtension();
            $image -> move('uploads', $image_name);
            $input ['image'] = $image_name;
        }else{
            unset ($input['image']);
        }

        $testimoni -> update($input);

        return response() -> json ([
            'success' => true,
            'message' => 'Testimoni Updated',
            'data' => $testimoni
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Testimoni $testimoni)
    {
        File::delete('uploads/'. $testimoni -> image);
        $testimoni -> delete();

        return response() -> json([
            'success' => true,
            'message' => 'Testimoni Deleted'
        ]);
    }
}
