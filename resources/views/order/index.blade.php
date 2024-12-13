@extends('layouts.app')

@section('content')
    <style>
        table.dataTable {
            border-collapse: collapse;
            width: 100%;
        }

        table.dataTable th,
        table.dataTable td {
            border: 1px solid #ddd;
        }

        .order-item-details {
            border-bottom: 1px dotted #ccc;
            padding: 5px 0;
        }

        .order-item-details:last-child {
            border-bottom: none;
        }
    </style>

    <br>
    <div class="container mx-auto">
        <h1 class="text-3xl text-center">Order List</h1>
    </div>

    <div class="pb-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="container mx-auto p-6">

                <div class="bg-white font-inter p-2 rounded-xl">
                    <table id="order_table" class="table table-striped table-hover">
                        <thead class="bg-rose-500 text-white">
                            <tr>
                                <th scope="col">Order ID</th>
                                <th>Table Number</th>
                                <th>Order Details</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->table_number }}</td>
                                    <td>
                                        @foreach ($order->orderItems as $orderItem)
                                            <div class="order-item-details">
                                                <strong>Item:</strong> {{ $orderItem->item->name }}
                                                ({{ $orderItem->quantity }}x)
                                                <br>

                                                @if ($orderItem->notes)
                                                    <strong>Notes:</strong> {{ $orderItem->notes }}
                                                @endif
                                            </div>
                                        @endforeach
                                    </td>
                                    <td>
                                        <span
                                            class="px-2 py-1 rounded-lg 
                                              @if ($order->status === 'success') bg-green-200 text-green-800 
                                              @elseif($order->status === 'canceled') 
                                                  bg-red-200 text-red-800 
                                              @else 
                                                  bg-blue-200 text-blue-800 @endif">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>

                                    <td>
                                        <button type="button"
                                            onclick="window.location.href='{{ route('order.edit', ['order' => $order->id]) }}'"
                                            class="text-white text-m bg-[#F7BE38] hover:bg-[#F7BE38]/90 focus:ring-4 focus:outline-none focus:ring-[#F7BE38]/50 font-medium rounded-lg px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-[#F7BE38]/50 me-2 mb-2">
                                            Edit
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#order_table').DataTable({
                paging: true,
                searching: true,
                ordering: true,
                info: true,
                lengthChange: true,
                scrollX: true,
                autoWidth: false
            });
        });
    </script>
@endsection
