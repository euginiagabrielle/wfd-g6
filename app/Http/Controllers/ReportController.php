<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->query('type', 'daily');
        $date = $request->query('date');
        $month = $request->query('month');

        if ($type === 'daily' && $date) {

            $salesReport = Order::whereDate('created_at', $date)
                ->selectRaw('DATE(created_at) as date, id as order_id, total_price')
                ->orderBy('created_at', 'asc')
                ->get();

        } elseif ($type === 'monthly' && $month) {

            $monthParts = explode('-', $month);
            $salesReport = Order::whereMonth('created_at', $monthParts[1])
                ->whereYear('created_at', $monthParts[0])
                ->selectRaw('DATE(created_at) as date, id as order_id, total_price')
                ->orderBy('created_at', 'asc')
                ->get();

        } else {

            $salesReport = Order::selectRaw('DATE(created_at) as date, id as order_id, total_price')
                ->orderBy('created_at', 'asc')
                ->get();
                
        }

        return view('report.index', compact('salesReport', 'type'));
    }
}
