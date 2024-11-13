<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    //
    public function index()
    {
        return view('order.index', ['orders' => Order::all()]);
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'table_number' => 'required|integer',
            'items' => 'required|string',
        ]);

        $items = json_decode($data['items'], true); // Decode JSON to an array

        $totalPrice = array_reduce(
            $items,
            function ($total, $item) {
                return $total + $item['item']['price'] * $item['quantity'];
            },
            0,
        );

        $order = Order::create([
            'table_number' => $data['table_number'],
            'total_price' => $totalPrice,
            'status' => 'pending',
        ]);

        foreach ($items as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'item_id' => $item['item']['id'],
                'quantity' => $item['quantity'],
                'price' => $item['item']['price'],
                'notes' => $item['notes'] ?? '',
            ]);
        }

        return redirect()->route('menu')->with('success', 'Order created successfully');
    }
}
