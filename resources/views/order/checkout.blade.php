@extends('layouts.guest')

@section('content')
    <div class="container p-8">
        <h1 class="text-3xl text-red-600">Checkout</h1>
        <hr class="w-24 border-2 border-yellow-300 mb-3">
        <ul class="text-lg">
            @foreach ($items as $item)
                <li>{{ $item->item->name }} ({{ $item->quantity }}) <span class="mx-8">@ Rp {{ number_format($item->price, 0, ',', '.') }}</span></li>
                <li>Notes: {{ $item->notes }}</li>
                <hr class="w-1/2 my-1 border-1 border-yellow-300">
            @endforeach
        </ul>
        <p class="my-2 text-lg">Total: Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
        <x-primary-button id="pay-button">Pay</x-primary-button>
        <pre><div id="result-json" class="my-4 text-lg">JSON result will appear here after payment:<br></div></pre>
    </div>
@endsection

@section('script')
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
    <script type="text/javascript">
        document.getElementById('pay-button').onclick = function() {
            snap.pay('{{ $order->snap_token }}', {
                onSuccess: function(result) {
                    window.location.href = "{{ route('order.success', $order->id) }}";
                },
                onPending: function(result) {
                    document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                },
                onError: function(result) {
                    document.getElementById('result-json').innerHTML += JSON.stringify(result, null, 2);
                }
            });
        };
    </script>
@endsection
