@extends('layouts.app')

@section('content')
<div class="container mx-auto my-8">
    <h1 class="text-2xl font-semibold mb-4">
        Sales Report - {{ ucfirst($type) }}
    </h1>

    <!-- Filter untuk harian atau bulanan -->
    <div class="flex space-x-4 mb-4">
        <a href="{{ route('report.index', ['type' => 'daily']) }}" 
           class="btn {{ $type === 'daily' ? 'btn-primary' : 'btn-secondary' }}">
            Daily Report
        </a>
        <a href="{{ route('report.index', ['type' => 'monthly']) }}" 
           class="btn {{ $type === 'monthly' ? 'btn-primary' : 'btn-secondary' }}">
            Monthly Report
        </a>
    </div>

    <!-- Form untuk memilih tanggal laporan -->
    @if ($type === 'daily')
        <form method="GET" action="{{ route('report.index') }}" class="mb-4">
            <input type="hidden" name="type" value="daily">
            <input type="date" name="date" value="{{ request('date') }}" class="p-2 border rounded">
            <button type="submit" class="btn btn-primary">Filter</button>
        </form>
    @elseif ($type === 'monthly')
        <form method="GET" action="{{ route('report.index') }}" class="mb-4">
            <input type="hidden" name="type" value="monthly">
            <input type="month" name="month" value="{{ request('month') }}" class="p-2 border rounded">
            <button type="submit" class="btn btn-primary">Filter</button>
        </form>
    @endif

    <!-- Tabel laporan -->
    <table class="table-auto w-full border-collapse border border-gray-400">
        <thead>
            <tr class="bg-gray-200">
                <th class="border border-gray-400 px-4 py-2">Order Date</th>
                <th class="border border-gray-400 px-4 py-2">Order ID</th>
                <th class="border border-gray-400 px-4 py-2">Total Price</th>
            </tr>
        </thead>
        <tbody>
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
@endsection