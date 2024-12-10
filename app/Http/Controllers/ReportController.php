<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->query('type','daily');
        $dateColumn = $type === 'daily' ? 'DATE(created_at)' : 'DATE_FORMAT(created_at, "%Y-%m")';

        $salesReport = Order::selectRaw("$dateColumn as date, id as order_id, total_price")
            ->orderBy('order_id','asc')
            ->get();

        return view('report.index',compact('salesReport','type'));
    }
}
