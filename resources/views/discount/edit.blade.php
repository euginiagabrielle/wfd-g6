@extends('layouts.app')

@section('content')
    <div class="p-4 py-8 bg-white w-full h-full">
        <h1 class="font-bold text-lg w-fit mx-auto">Edit Discount</h1>
        <form class="flex flex-col max-w-2xl mx-auto" action="{{ route('discount.update', $discount->id) }}" method="POST">
            @csrf
            @method('PATCH')

            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $discount->name)" required
                    autofocus />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="value" :value="__('Value (%)')" />
                <x-text-input id="value" class="block mt-1 w-full" type="number" name="value" :value="old('value', $discount->value)"
                    required />
                <x-input-error :messages="$errors->get('value')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="item_id" :value="__('Item')" />
                <select id="item_id" name="item_id"
                    class="bg-neutral-50 mt-2 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option disabled>Select an item</option>
                    @foreach ($items as $item)
                        <option value="{{ $item->id }}" {{ $discount->item_id == $item->id ? 'selected' : '' }}>
                            {{ $item->name }}</option>
                    @endforeach
                </select>
                <x-input-error :messages="$errors->get('item_id')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="minimum" :value="__('Minimum Purchase (Rp)')" />
                <x-text-input id="minimum" class="block mt-1 w-full" type="number" name="minimum" :value="old('minimum', $discount->minimum)"
                    required />
                <x-input-error :messages="$errors->get('minimum')" class="mt-2" />
            </div>

            <x-primary-button type="submit" class="mt-4">Update</x-primary-button>
        </form>
    </div>
@endsection
