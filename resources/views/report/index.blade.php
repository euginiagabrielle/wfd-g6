@extends('layouts.app')

@section('content')
<style>
    table.dataTable {
    border-collapse: collapse;
    width: 100%;
}

table.dataTable th, table.dataTable td {
    border: 1px solid #ddd; /* Adjust the color and style of the border */
}

</style>

<div class="container mx-auto my-8 px-8">
    <h1 class="text-2xl font-semibold mb-4">
        Sales Report - {{ ucfirst($type) }}
    </h1>

<!-- Filter untuk harian atau bulanan -->
<div class="flex space-x-4 mb-4">
    <a href="{{ route('report.index', ['type' => 'daily']) }}" 
       class="text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-m px-5 py-2.5 text-center me-2 mb-2 
              {{ $type === 'daily' ? 'bg-gradient-to-bl from-cyan-500 to-blue-500' : 'bg-gradient-to-br from-gray-300 to-gray-400' }}">
        Daily Report
    </a>
    <a href="{{ route('report.index', ['type' => 'monthly']) }}" 
       class="text-white bg-gradient-to-br from-green-400 to-blue-600 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-green-200 dark:focus:ring-green-800 font-medium rounded-lg text-m px-5 py-2.5 text-center me-2 mb-2 
              {{ $type === 'monthly' ? 'bg-gradient-to-bl from-green-400 to-blue-600' : 'bg-gradient-to-br from-gray-300 to-gray-400' }}">
        Monthly Report
    </a>
</div>



    <!-- Form untuk memilih tanggal laporan -->
    @if ($type === 'daily')
    <form method="GET" action="{{ route('report.index') }}" class="mb-4">
        <input type="hidden" name="type" value="daily">
        <input type="date" name="date" value="{{ request('date') }}" class="p-2 border rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent">
                <button type="submit" class="text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-m px-5 py-2.5 text-center me-2 mb-2">
                    FILTER
                </button> 
    </form>
@elseif ($type === 'monthly')
    <form method="GET" action="{{ route('report.index') }}" class="mb-4">
        <input type="hidden" name="type" value="monthly">
        <input type="month" name="month" value="{{ request('month') }}" class="p-2 border rounded-lg shadow-md focus:outline-none focus:ring-2 focus:ring-blue-400 focus:border-transparent">
                <button type="submit" class="text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-m px-5 py-2.5 text-center me-2 mb-2">
                    FILTER
                </button> 
    </form>
@endif


    
<div class="pb-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="container mx-auto p-6">

            <table  id="report_table" class="table table-striped table-hover">
                <thead>
                    <tr>    
                        <th scope="col">Order Date</th>
                        <th scope="col">Order ID</th>
                        <th scope="col">Total Price</th>
                    </tr>
                </thead>
                
                <tbody class="bg-white divide-y divide-gray-200"> 
                    @forelse ($salesReport as $report)
                        <tr>
                            <td class="border border-gray-400 px-4 py-2">{{ date('d/m/Y',strtotime($report->date)) }}</td>
                            <td class="border border-gray-400 px-4 py-2">{{ $report->order_id }}</td>
                            <td class="border border-gray-400 px-4 py-2">Rp {{ number_format($report->total_price, 0, ',', '.') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="border border-gray-400 px-4 py-2 text-center">No data available.</td>
                        </tr>
                    @endforelse
                   
                </tbody>
            </table>
    </div>
        </div>
    </div>

    <script>
    $(document).ready(function() {
        $('#report_table').DataTable({
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