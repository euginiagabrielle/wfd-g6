<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use App\Models\Order;
use App\Models\OrderItem;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    //
    public function index()
    {
        $orders = Order::with(['orderItems.item'])->get();

        return view('order.index', ['orders' => $orders]);
    }

    public function checkout(Request $request, Order $order)
    {
        $orderItems = $order->orderItems;
        // dd($orderItems);
        return view('order.checkout', [
            'order' => $order,
            'tableNumber' => $order->table_number,
            'items' => $orderItems,
        ]);
    }

    public function success(Request $request, Order $order)
    {
        $order->status = 'success';
        $order->save();
        return view('order.success');
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
        $itemIds = array_map(fn($entry) => $entry['item']['id'], $items);
        $discounts = Discount::whereIn('item_id', $itemIds)->get()->keyBy('item_id');
        $totalPriceAfterDiscount = array_reduce(
            $items,
            function ($total, $item) use ($discounts) {
                $itemId = $item['item']['id'];
                $originalPrice = $item['item']['price'] * $item['quantity'];

                if ($discounts->has($itemId)) {
                    $discount = $discounts->get($itemId);

                    if ($originalPrice >= $discount->min_purchase_amount) {
                        $discountValue = ($discount->value / 100) * $originalPrice;
                        $originalPrice -= $discountValue;
                    }
                }

                return $total + $originalPrice;
            },
            0,
        );
        $order = Order::create([
            'id' => Str::uuid()->toString(),
            'table_number' => $data['table_number'],
            'total_price' => $totalPriceAfterDiscount,
            'status' => 'pending',
        ]);

        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('midtrans.serverKey');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;

        $params = [
            'transaction_details' => [
                'order_id' => rand(),
                'gross_amount' => $totalPrice,
            ],
        ];
        $snapToken = \Midtrans\Snap::getSnapToken($params);
        $order->snap_token = $snapToken;
        $order->save();

        foreach ($items as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'item_id' => $item['item']['id'],
                'quantity' => $item['quantity'],
                'price' => $item['item']['price'],
                'notes' => $item['notes'] ?? '',
            ]);
        }

        return redirect()->route('checkout', $order->id);
    }

    public function edit(Order $order) {
        $order->load(['orderItems.item']);
        return view('order.edit', compact('order')); 
    }
}
