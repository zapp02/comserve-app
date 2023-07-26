<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['list','approved_list','ongoing_list','done_list']);
        $this->middleware('auth:api')->only(['store','update','destroy','status_change','requested','approved','ongoing','done']);

    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with('member')-> get();

        return response() -> json([
            'data' => $orders
        ]);
    }

    public function list() {

        return view ('order.index');
    }
    
    public function approved_list() {

        return view ('order.approved');
    }

    public function ongoing_list() {

        return view ('order.ongoing');
    }

    public function done_list() {

        return view ('order.done');
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
            'member_id' => 'required'
        ]);
        if ($validator -> fails()){
            return response() -> json(
                $validator -> errors(), 422
            );
        }

        $input = $request -> all();
        $order = Order::create($input);

        for ($i=0; $i < count($input['id_product']); $i++) {
            OrderDetail::create([
                'id_order' => $order['id'],
                'id_product' => $input['id_product'][$i],
                'quantity' => $input['quantity'][$i],
                'requirements' => $input['requirements'][$i],
                'total' => $input['total'][$i],
            ]);
        }

        return response() -> json([
            'data' => $order
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        return response() -> json([
            'data' => $order
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $validator = Validator::make($request -> all(), [
            'member_id' => 'required',
            'description' => 'required'
        ]);
        if ($validator -> fails()){
            return response() -> json(
                $validator -> errors(), 422
            );
        }

        $input = $request -> all();
        $order -> update($input);

        OrderDetail::where('id_order',$order['id'])->delete();

        for ($i=0; $i < count($input['id_product']); $i++) {
            OrderDetail::create([
                'id_order' => $order['id'],
                'id_product' => $input['id_product'][$i],
                'quantity' => $input['quantity'][$i],
                'requirements' => $input['requirements'][$i],
                'total' => $input['total'][$i],
            ]);
        }

        return response() -> json ([
            'message' => 'Order Updated',
            'data' => $order
        ]);
    }

    public function status_change(Request $request, Order $order)
    {
        
        $order->update([
            'status'=>$request -> status
        ]);
        
        return response() -> json ([
            'message' => 'Order Updated',
            'data' => $order
        ]);
    }

    public function requested()
    {
        $orders = Order::with('member') -> where('status','Requested')->get();

        return response() -> json([
            'data' => $orders
        ]);
    }


    public function approved()
    {
        $orders = Order::with('member') -> where('status','Approved')->get();

        return response() -> json([
            'data' => $orders
        ]);
    }

    public function ongoing()
    {
        $orders = Order::with('member') -> where('status','Ongoing')->get();

        return response() -> json([
            'data' => $orders
        ]);
    }

    public function done()
    {
        $orders = Order::with('member') -> where('status','Done')->get();

        return response() -> json([
            'data' => $orders
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        File::delete('uploads/'. $order -> image);
        $order -> delete();

        return response() -> json([
            'message' => 'Order Deleted'
        ]);
    }
}
