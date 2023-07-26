<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['index']);
        $this->middleware('auth:api')->only(['get_reports']);
    }

    public function get_reports(Request $request)
    {
        $report = DB::table('orders_details')
            ->join('products', 'products.id','=','orders_details.id_product')
            ->select(DB::raw('
                product_name,
                count(*) as request_qty,
                obtained,
                SUM(quantity) as total_qty,
                SUM(total) as pts_given'))
            ->whereRaw("date(orders_details.created_at) >= '$request->from'")
            ->whereRaw("date(orders_details.created_at) <= '$request->to'")
            ->groupBy('id_product','product_name','obtained')
            ->get();

        return response()->json([
            'data' => $report
        ]);
    }

    public function index()
    {
        return view('report.index');
    }
}
