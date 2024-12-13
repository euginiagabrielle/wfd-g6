@extends('layouts.app')

@section('content')
    <div class="p-4 py-8  w-full h-full">
        <br>

        <div class="container mx-auto">
            <h1 class="text-3xl font-medium text-center">Create Menu Item</h1>
        </div>
        <form class="flex font-inter flex-col max-w-2xl mx-auto" action="{{ route('item.store') }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                    required autofocus />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>
            <div class="mt-4">
                <x-input-label for="description" :value="__('Description')" />

                <x-text-input :value="old('description')" id="description" class="block mt-1 w-full" type="text" name="description"
                    required />

                <x-input-error :messages="$errors->get('description')" class="mt-2" />
            </div>
            <div class="mt-4">
                <x-input-label :value="old('price')" for="price" :value="__('Price (Rp)')" />

                <x-text-input id="price" class="block mt-1 w-full" type="number" name="price" required />
                <x-input-error :messages="$errors->get('price')" class="mt-2" />
            </div>
            <div class="mt-4">
                <x-input-label for="category" :value="__('Category')" />

                <select id="category" name="category"
                    class="bg-neutral-50 mt-2 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected>Choose a category</option>
                    <option value="snack">Snack</option>
                    <option value="rice">Rice</option>
                    <option value="noodle">Noodle</option>
                    <option value="coffee">Coffee</option>
                    <option value="non-coffee">Non Coffee</option>
                </select>
                <x-input-error :messages="$errors->get('category')" class="mt-2" />
            </div>
            <div class="mt-4">
                <x-input-label for="image" :value="__('Image')" />
                <input
                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-white dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                    id="image" name="image" type="file">
                <x-input-error :messages="$errors->get('image')" class="mt-2" />
            </div>
            <div class="mt-4 ">
                <label for="availability"
                    class="inline-flex hidden justify-between w-full items-center mb-5 cursor-pointer">
                    <span class=" text-sm font-medium text-gray-700 dark:text-gray-300">Item availability</span>
                    <input :value="old('availability')" type="checkbox" id="availability" class="sr-only peer">
                    <div
                        class="relative w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-slate-300 dark:peer-focus:ring-slate-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:w-5 after:h-5 after:transition-all dark:border-gray-600 peer-checked:bg-slate-600">
                    </div>
                    <x-input-error :messages="$errors->get('availability')" class="mt-2" />
                </label>
            </div>
            <x-primary-button class="font-bebas" type="submit">Submit</x-primary-button>
            <a href="/items"
                class="rounded mt-4 p-2 text-md font-bebas leading-6 text-rose-600 bg-yellow-300 hover:bg-yellow-200 text-center">Cancel</a>
        </form>
    </div>
@endsection
