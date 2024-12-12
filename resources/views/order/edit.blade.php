@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto m-8">
        <h1 class="text-3xl my-5">Order Invoice</h1>

        @if (session('success'))
            <div class="bg-green-500 text-white p-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- Order Information -->
        <div class="mb-3 font-inter space-y-1">
            <p><span class="font-bold">Order ID: </span> {{ $order->id }}</p>
            <p><span class="font-bold">Order Date: </span> {{ $order->created_at->format('d M Y') }} </p>
        </div>

        <!-- Status Update -->
        <p class="font-inter"><span class="font-bold">Current Status: </span> {{ ucfirst($order->status) }}</p>
        @if ($order->status === 'pending' || $order->status === 'process')
            <div class="my-3 font-inter">
                <label for="status" class="form-label font-bold">Edit Status</label>
                <select name="status" id="status" class="form-select">
                    <option></option>
                    <option value="pending">Pending</option>
                    <option value="process">Process</option>
                    <option value="completed">Completed</option>
                    <option value="canceled">Canceled</option>
                </select>
            </div>
        @else
            <p class="mt-2 mb-4">Status can only be edited when it is "pending or process".</p>
        @endif

        <script>
            $('#status').on('change', function() {
                var status = $('#status').val();
                var orderId = '{{ $order->id }}';

                $.ajax({
                    type: 'PATCH',
                    url: '{{ route('order.update', ['order' => ':id']) }}'.replace(':id', orderId),
                    data: {
                        _token: '{{ csrf_token() }}',
                        status: status
                    },
                    success: function(response) {
                        if (response.success) {
                            //   alert('Order status updated successfully.');
                            location.reload();
                        } else {
                            alert('Failed to update order status.');
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('An error occurred: ' + error);
                    }
                });
            });
        </script>


        <!-- Items Details -->

        <div class="container mx-auto">
            <div class="p-4 rounded-xl bg-white">
                <table id="item_table" class="table table-striped font-inter table-hover">
                    <thead class="bg-rose-500 text-white">
                        <tr>
                            <th>Item</th>
                            <th>Quantity</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($order->orderItems as $orderItem)
                            <tr>
                                <td>{{ $orderItem->item->name }}</td>
                                <td>{{ $orderItem->quantity }}</td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                $('#item_table').DataTable({
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

        <a href="/orders"
            class="rounded inline-block mt-6 p-2 px-6 text-md leading-6 text-rose-600 bg-yellow-300 hover:bg-yellow-200 text-center">Back</a>

    </div>
@endsection
