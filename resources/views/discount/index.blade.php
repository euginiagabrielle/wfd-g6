@extends('layouts.app')

@section('content')
    <h1>Discounts</h1>
    <a href="{{ route('discount.create') }}">Create Discount</a>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Value (%)</th>
                <th>Minimum Purchase (Rp)</th>
                <th>Item</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($discounts as $discount)
                <tr>
                    <td>{{ $discount->name }}</td>
                    <td>{{ $discount->value }}</td>
                    <td>{{ number_format($discount->minimum, 2) }}</td>
                    <td>{{ $discount->item->name ?? 'N/A' }}</td>
                    <td>
                        <a href="{{ route('discount.edit', $discount->id) }}">Edit</a>
                        <form action="{{ route('discount.destroy', $discount->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
