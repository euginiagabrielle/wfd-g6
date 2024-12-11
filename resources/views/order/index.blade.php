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
            /* Adjust the color and style of the border */
        }
    </style>

    <br>
    <div class="container mx-auto">
        <h1 class="text-3xl font-bold text-center">Order List</h1>
    </div>
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
                                <th>Item</th>
                                <th>Quantity</th>
                                <th>Notes</th>
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
