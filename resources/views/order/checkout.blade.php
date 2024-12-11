@extends('layouts.guest')

@section('content')
    <h1>Checkout</h1>
    <ul>
        @foreach ($items as $item)
            <li>{{ $item->item->name }} ({{ $item->quantity }})</li>
            <li>Notes: {{ $item->notes }}</li>
        @endforeach
    </ul>
    <p>Total: Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
    <x-primary-button id="pay-button">Pay</x-primary-button>
    <pre><div id="result-json">JSON result will appear here after payment:<br></div></pre>
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
