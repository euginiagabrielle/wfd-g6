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
                                {{ $item->item->name }}
                            </p>
                        @endforeach
                    </td>
                    <td>
                        @foreach ($order->orderItems as $orderItem)
                            <p>
                                {{ $orderItem->quantity }}
                            </p>
                        @endforeach
                    </td>
                    <td>
                        @foreach ($order->orderItems as $orderItem)
                            <p>
                                {{ $orderItem->notes }}
                            </p>
                        @endforeach
                    </td>
                    <td>{{ ucfirst($order->status) }}</td>
                    <td>
                        <a href="{{ route('order.edit', ['order' => $order->id]) }}">Edit</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection