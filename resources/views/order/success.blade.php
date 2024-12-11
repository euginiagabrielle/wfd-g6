@extends('layouts.guest')

@section('content')
    <div class="w-full font-inter h-full grid place-items-center">
        <img class="h-48" src="{{ asset('success.png') }}" alt="success" class="w-1/2">
        <h1 class="font-bebas text-emerald-600 text-4xl">Success</h1>
        <p>Order has been successfully placed.</p>
        <p>Redirecting to home page in <span id="time">5</span> seconds...</p>
    </div>
@endsection

@section('script')
    <script>
        let countdown = 5;
        setTimeout(() => {
            window.location.href = "{{ route('menu') }}";
        }, countdown * 1000);

        const countdownElement = document.getElementById('time');

        const intervalId = setInterval(() => {
            countdown -= 1;
            countdownElement.textContent = countdown;

            if (countdown === 0) {
                clearInterval(intervalId);
            }
        }, 1000);
    </script>
@endsection
