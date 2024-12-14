@extends('layouts.app')

@section('content')
    <br>
    <div class="container mx-auto">
        <h1 class="text-3xl font-medium text-center">Welcome, {{ Auth::user()->name }}!</h1>
    </div>
    <br>
    @php
        use Carbon\Carbon;
        Carbon::setLocale('id');
        $today = Carbon::today();
        $income = DB::table('orders')->whereDate('created_at', $today)->sum('total_price');
        $order = DB::table('orders')->whereDate('created_at', $today)->count();
    @endphp

    <div class="mt-3 font-inter max-w-7xl mx-auto px-6 sm:px-6 lg:px-8">
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
                        {{ $order }} Pesanan
                    </h1>
                </div>
            </div>
        </div>
        <div class="bg-white p-8 my-6 shadow-sm relative width-[100vw] max-w-7xl mx-auto">
            <div class="grid md:grid-cols-2 gap-4">
                <div>
                    <canvas id="itemCountChart"></canvas>
                </div>
                <div>
                    <canvas id="dailySalesChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    <script>
        const labels = @json($labels);
        const data = {
            labels: labels,
            datasets: [{
                label: "Jumlah Item yang terjual",
                data: @json($counts),
                backgroundColor: labels.map(() =>
                    `rgba(${Math.floor(Math.random()*255)}, ${Math.floor(Math.random()*255)}, ${Math.floor(Math.random()*255)}, 0.3)`
                ),
                borderWidth: 1
            }]
        };
        const config = {
            type: 'bar',
            data: data,
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        };
        const dateLabels = @json($dateLabels);
        const salesData = @json($salesData);

        const dailySalesConfig = {
            type: 'line',
            data: {
                labels: dateLabels,
                datasets: [{
                    label: 'Daily Sales Total',
                    data: salesData,
                    borderColor: 'rgb(75, 192, 192)',
                    tension: 0.1,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)'
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Total Sales (IDR)'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Date'
                        }
                    }
                }
            }
        };

        new Chart(document.getElementById('itemCountChart'), config);
        new Chart(document.getElementById('dailySalesChart'), dailySalesConfig);
    </script>
@endsection
