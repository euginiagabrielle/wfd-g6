@extends('layouts.app')

@section('content')
    <h1>Order Index</h1>
    <table>
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Table Number</th>
                <th>Item</th>
                <th>Quantity</th>
                <th>Notes</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->table_number }}</td>
                    <td>
                        @foreach ($order->orderItems as $item)
                            <p>
                                {{ $item->item->name }}@if(!$loop->last) @endif
                            </p>
                        @endforeach
                    </td>
                    <td>
                        @foreach ($order->orderItems as $orderItem)
                            <p>
                                {{ $orderItem->quantity }}@if(!$loop->last) @endif
                            </p>
                        @endforeach
                    </td>
                    <td>{{ $order->notes }}</td>
                    <td>{{ $order->status }}</td>
                    <td>
                        
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection