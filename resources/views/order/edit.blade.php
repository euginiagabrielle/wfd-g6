@extends('layouts.app')

@section('content')

<div class="contain m-8">
   <h1 class="text-2xl font-semibold my-5">Order Invoice</h1>

   @if(session('success'))
       <div class="bg-green-500 text-white p-3 rounded mb-4">
           {{ session('success') }}
       </div>
   @endif

   <!-- Order Information -->
   <div class="mb-3 space-y-1">
     <p><span class="font-bold">Order ID: </span> {{ $order->id }}</p>
     <p><span class="font-bold">Order Date: </span> {{ $order->created_at->format('d M Y') }} </p>
  </div>

   <!-- Status Update -->
      <p><span class="font-semibold">Current Status: </span> {{ ucfirst($order->status) }}</p>
      @if ($order->status === 'pending' || $order->status === 'process')
         <div class="mb-3">
            <label for="status" class="form-label">Edit Status</label>
            <select name="status" id="status" class="form-select">
               <option></option>
               <option value="pending">Pending</option>
               <option value="process">Process</option>
               <option value="completed">Completed</option>
               <option value="canceled">Canceled</option>
            </select>
         </div>
         
      @else
         <p>Status can only be edited when it is "pending or process".</p>
      @endif

      <script>
         $('#status').on('change', function() {
            var status = $('#status').val(); 
            var orderId = '{{$order->id}}';

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
<div class="pb-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="container mx-auto p-6">

            <table  id="item_table" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($order->orderItems as $orderItem)
                        <tr>
                            <td>{{ $orderItem->item->name }}</td>
                            <td>{{ $orderItem->quantity }}</td>
                            
                        </tr>
                    @endforeach
                </tbody>
            </table>
    </div>
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

  
</div>
@endsection