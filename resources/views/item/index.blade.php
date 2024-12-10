@extends('layouts.app')

@section('content')
<br>

<div class="container mx-auto">
            <h1 class="text-3xl font-bold text-center">Menu Item List</h1>
</div>

<div class="pb-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="container mx-auto p-6">
            <div class="mb-4 w-5/5 max-w-full mx-auto flex justify-start">
                <button type="submit" class="text-white bg-gradient-to-r from-cyan-500 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-cyan-300 dark:focus:ring-cyan-800 font-medium rounded-lg text-m px-5 py-2.5 text-center me-2 mb-2">
                    <a href="{{ route('item.create') }}">
                        <i class="fa-solid fa-plus"></i>
                    ADD ITEM</a>
                </button> 
            </div>

            <table  id="item_table" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Price</th>
                        <th scope="col">Image</th>
                        <th scope="col" style=" width:250px !important">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($items as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->description }}</td>
                            <td>{{ $item->price }}</td>
                            <td><img src="{{ asset('storage/' . $item->image) }}"></td>
                            <td>
                                <button type="button" onclick="window.location.href='{{ route('item.edit', $item->id) }}'"  class="text-white text-m bg-[#F7BE38] hover:bg-[#F7BE38]/90 focus:ring-4 focus:outline-none focus:ring-[#F7BE38]/50 font-medium rounded-lg px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-[#F7BE38]/50 me-2 mb-2">
                                    Edit
                                </button>
                                <form id="delete-form-{{ $item->id }}" action="{{ route('item.destroy', $item->id) }}" method="POST" class="inline-block ml-2">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-m px-5 py-2.5 text-center me-2 mb-2">
                                        Delete
                                    </button>
                                </form>

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
    </div>
        </div>
    </div>

    <script>
    $(document).ready(function() {
        $('#item_table').DataTable({
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
@endsection
