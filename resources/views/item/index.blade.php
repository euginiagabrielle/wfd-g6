@extends('layouts.app')

@section('content')
    <h1>Menu Item</h1>
    <a href="{{ route('item.create') }}">Create</a>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->description }}</td>
                    <td>Rp {{ number_format($item->price, 0, ',', '.')}}</td>
                    <td><img src="{{ asset('storage/' . $item->image) }}" class="w-20 h-20"></td>
                    <td>
                        <a href="{{ route('item.edit', $item->id) }}">Edit</a>
                        <form action="{{ route('item.destroy', $item->id) }}" method="POST">
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
