<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Console\Input\Input;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['list']);
        $this->middleware('auth:api')->only(['store','update','destroy']);

    }

    public function list() {

        return view ('payment.index');
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Payment::all();

        return response() -> json([
            'data' => $categories
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
            'payment_name' => 'required',
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

        $payment = Payment::create($input);

        return response() -> json([
            'success' => true,
            'data' => $payment
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        return response() -> json([
            'data' => $payment
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment)
    {
        $validator = Validator::make($request -> all(), [
            'date' => 'required',
        ]);
        if ($validator -> fails()){
            return response() -> json(
                $validator -> errors(), 422
            );
        }

        $payment -> update([
            'status' => request('status')
        ]);

        return response() -> json ([
            'success' => true,
            'message' => 'Payment Updated',
            'data' => $payment
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {

        File::delete('uploads/'. $payment -> image);
        $payment -> delete();

        return response() -> json([
            'success' => true,
            'message' => 'Payment Deleted'
        ]);
    }
}
