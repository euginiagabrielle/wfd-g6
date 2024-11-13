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
                    <td>{{ $item->price }}</td>
                    <td><img src="{{ asset('storage/' . $item->image) }}"></td>
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
