@extends('layouts.app')

@section('content')
<br>
<div class="container mx-auto">
            <h1 class="text-3xl font-bold text-center">WELCOME ADMIN</h1>
</div>
<br>

    @php
        use Carbon\Carbon;
        Carbon::setLocale('id');
        $today = Carbon::today();
        $income = DB::table('orders')->whereDate('created_at', $today)->sum('total_price');
        $order = DB::table('orders')->count();
    @endphp

        <div class="mt-3 max-w-7xl mx-auto px-6 sm:px-6 lg:px-8">
            <div class="flex flex-col space-y-4 sm:flex-row sm:space-y-0 sm:space-x-4">
                <div class="flex-1 bg-white overflow-hidden shadow-sm rounded-lg">
                    <div class="px-6 pt-3 text-gray-900">
                    <h1 class="text-xl text-left ">
                        Total Pemasukan hari ini {{ $today->isoFormat('dddd, D MMMM YYYY') }} 
                    </h1>
                    <h1 class="text-xl text-left font-semibold mb-4">
                        Rp {{ number_format($income, 2, ',', '.') }}
                    </h1>
                    </div>
                </div>
                <div class="flex-1 bg-white overflow-hidden shadow-sm rounded-lg">
                    <div class="px-6 pt-3 text-gray-900">
                    <h1 class="text-xl text-left ">
                        Total Pesanan hari ini {{ $today->isoFormat('dddd, D MMMM YYYY') }} 
                    </h1>
                    <h1 class="text-xl text-left mb-4 font-semibold">
                        {{$order}} Pesanan
                    </h1>
                    </div>
                </div>
                
            </div>
        </div>


@endsection