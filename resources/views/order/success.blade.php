@extends('layouts.guest')

@section('content')
    <h1>Success</h1>
    <p>Order has been successfully placed.</p>
    <p>Redirecting to home page in <span id="time">3</span> seconds...</p>
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
