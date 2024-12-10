@props(['item'])

<div class="bg-orange-100">
    <img class=" w-full h-60 object-cover" src="{{ asset('storage/' . $item['image']) }}" />
    <div class="p-4">
        <p class="text-red-600 text-3xl">{{ $item['name'] }}</p>
        <p class="font-inter text-red-800"> {{ $item['description'] }}</p>
        <div class="absolute bottom-4 right-4 flex gap-2 items-center">
            <p class="text-red-600 text-3xl">Rp, {{ number_format($item['price'], 0, ',', '.') }}</p>
            <x-primary-button data-modal-target="{{ $item['id'] }}-modal" data-modal-toggle="{{ $item['id'] }}-modal"
                class="rounded-none bg-red-600 hover:bg-red-700">
                Add to order</x-primary-button>
        </div>
    </div>
</div>
<div id="{{ $item['id'] }}-modal" tabindex="-1" aria-hidden="true"
    class="fixed z-50 inset-0 bg-neutral-800/50 items-center justify-center hidden">
    <div class="bg-orange-100 w-full p-6 max-w-lg sm:rounded-lg shadow-lg">
        <div class="flex justify-between items-center mb-2">
            <h2 class="text-3xl text-red-600 ">{{ $item['name'] }}</h2>
            <p class="text-red-600 text-2xl">Rp, {{ number_format($item['price'], 0, ',', '.') }}</p>
        </div>
        <p class="text-red-600 mb-4 font-inter">{{ $item['description'] }}</p>
        <div class="mb-4">
            <label class="block mb-2 text-red-600 text-xl">Quantity</label>
            <div class="flex gap-4 items-center"><button
                    class="h-7 w-7 decrementm bg-red-600 grid place-items-center text-white">-</button>
                <p id="orderQuantity-{{ $item['id'] }}" class="font-medium text-lg">1</p>
                <button class="incrementm h-7 w-7 bg-red-600 grid place-items-center text-white">+</button>
            </div>
        </div>

        <div class="mb-4">
            <label class="block mb-2 text-red-600 text-xl">Notes</label>
            <textarea id="orderNotes" class="w-full p-2 border rounded" placeholder="Any special requests?"></textarea>
        </div>

        <div class="flex justify-end gap-2">
            <button data-modal-hide="{{ $item['id'] }}-modal" class="px-4 py-2">Cancel</button>
            <button class="px-4 py-2 bg-red-600 text-white" data-modal-hide="{{ $item['id'] }}-modal"
                onclick="confirmAddToCart(
            {{ '\'' . $item['id'] . '\'' }}, 
            {{ '\'' . $item['name'] . '\'' }}, 
            {{ '\'' . $item['description'] . '\'' }}, 
            {{ $item['price'] }}
        )">
                Add to Cart
            </button>
        </div>
    </div>
</div>
