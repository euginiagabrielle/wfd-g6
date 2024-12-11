<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
  public function dashboard(Request $request){
    $itemCounts = DB::table('order_items')
        ->join('items', 'order_items.item_id', '=', 'items.id')
        ->select('items.name', DB::raw('COUNT(order_items.id) as count'))
        ->groupBy('items.name')
        ->pluck('count', 'items.name')->toArray();
      $labels = array_keys($itemCounts);
      $counts = array_values($itemCounts);
    $dailyTotals = DB::table('orders')
        ->select(
            DB::raw('DATE(created_at) as date'), 
            DB::raw('SUM(total_price) as total_sales')
        )
        ->groupBy('date')
        ->orderBy('date')
        ->get();

    // Prepare data for Chart.js
    $dateLabels = $dailyTotals->pluck('date')->toArray();
    $salesData = $dailyTotals->pluck('total_sales')->toArray();

    return view('dashboard', ['labels' => $labels, 
        'counts' => $counts,
        'dateLabels' => $dateLabels,
        'salesData' => $salesData]);
  }
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
