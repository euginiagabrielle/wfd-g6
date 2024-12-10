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

  <!-- Items Details -->
   <h2 class="mt-4 mb-2 font-bold">Items</h2>
   <div class="mb-3 space-y-2">
      @foreach ($order->orderItems as $orderItem)
         <p><span class="font-semibold">Item: </span> {{ $orderItem->item->name }}</p>
         <p><span class="font-semibold">Quantity: </span> {{ $orderItem->quantity }}</p>
         <p><span class="font-semibold">Notes: </span> {{ $orderItem->notes }}</p>
         <hr>
      @endforeach
   </div>

   <!-- Status Update -->
   <h2 class="mt-4 mb-2 font-bold">Order Status</h2>
   <form action="{{ route('order.update', ['order' => $order->id])}}" method="POST">
      @csrf
      @method('PATCH')

      <p><span class="font-semibold">Current Status: </span> {{ ucfirst($order->status) }}</p>
      @if ($order->status === 'pending' || $order->status === 'process')
         <div class="mb-3">
            <label for="status" class="form-label">Edit Status</label>
            <select name="status" id="status" class="form-select">
               <option value="pending">Pending</option>
               <option value="process">Process</option>
               <option value="completed">Completed</option>
               <option value="canceled">Canceled</option>
            </select>
         </div>
         <button type="submit" class="btn btn-primary">Update Status</button>
      @else
         <p>Status can only be edited when it is "pending or process".</p>
      @endif
   </form>
</div>
@endsection