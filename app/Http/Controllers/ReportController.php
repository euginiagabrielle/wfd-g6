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
        $dateColumn = $type === 'daily' ? 'DATE(created_at)' : 'DATE_FORMAT(created_at, "%Y-%m")';

        $date = $request->query('date');
        $month = $request->query('month');

        $query = Order::selectRaw("$dateColumn as date, id as order_id, total_price")
                    ->orderBy('date', 'asc');

        if ($type === 'daily' && $date) {
            $query->whereDate('created_at', $date);
        }

        if ($type === 'monthly' && $month) {
            $query->whereMonth('created_at', explode('-', $month)[1])
                ->whereYear('created_at', explode('-', $month)[0]);
        }

        $salesReport = $query->get();

        return view('report.index', compact('salesReport', 'type'));
    }
}
