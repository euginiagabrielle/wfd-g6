<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />

</head>

<body class="font-bebas bg-[url(/resources/assets/grain.png)] antialiased w-full dark:bg-black dark:text-white/50">
    @if ($showModal)
        <div id="tableModal" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50">
            <div class="bg-white p-6 sm:rounded-lg shadow-lg w-full sm:w-1/2 max-w-xl">
                <h2 class="text-2xl tracking-wide">Enter Table Number</h2>
                <form action="/" method="GET">
                    <label for="table" class="block font-inter mb-2 text-sm text-gray-600">Oops, it looks like you
                        don&apos;t have a table number! Please input your table number.</label>
                    <input type="number" id="table" name="table" required class="w-full p-2 border rounded">
                    <div class="flex justify-end mt-4">
                        <x-primary-button class="px-4 py-2 bg-rose-600 text-white">Submit</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    @endif
    <div class="flex justify-between p-4 items-center w-full">
        <a href={{ '/?table=' . request()->query('table') }} class="text-rose-600 text-3xl">Kopi tiam</a>
        <p class="text-rose-600 text-3xl border-b-4 border-b-yellow-400">Menu</p>
        {{-- @if (Route::has('login'))
            <nav class="flex">
                @auth
                    <a href="{{ url('/dashboard') }}"
                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                        Dashboard Admin
                    </a>
                @else
                    <a href="{{ route('login') }}"
                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                        Log in
                    </a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20] dark:text-white dark:hover:text-white/80 dark:focus-visible:ring-white">
                            Register
                        </a>
                    @endif
                @endauth
            </nav>
        @endif --}}
        <div class="text-rose-600 text-3xl flex items-center gap-2 sm:gap-4">Table <span id="tableNumber"
                class="font-semibold">{{ $tableNumber }}</span>
            <button id="cartButton" data-modal-target="cart-modal" data-modal-toggle="cart-modal"><i
                    class="fa-solid fa-cart-shopping text-xl p-1.5 aspect-square bg-rose-600 text-white rounded"></i>
            </button>
        </div>
    </div>
    <div class="w-full flex justify-center gap-2 p-4 mx-auto max-w-4xl flex-wrap">
        <x-link-filter category=""></x-link-filter>
        <x-link-filter category="snack"></x-link-filter>
        <x-link-filter category="rice"></x-link-filter>
        <x-link-filter category="noodle"></x-link-filter>
        <x-link-filter category="coffee"></x-link-filter>
        <x-link-filter category="non-coffee"></x-link-filter>
    </div>
    <div class="grid mx-auto max-w-6xl sm:grid-cols-2 gap-4 p-4 lg:grid-cols-3">
        @forelse($items as $item)
            <x-menu-item :item="$item"></x-menu-item>
        @empty
            <p class="col-span-3 text-center w-full text-3xl">No items found for this category.</p>
        @endforelse
    </div>
    <div id="cart-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative sm:p-4 w-full sm:max-w-2xl max-h-full">
            <div class="relative bg-orange-50 sm:rounded-lg shadow dark:bg-gray-700">
                <div
                    class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600 border-red-200">
                    <h3 class="text-3xl text-red-600 dark:text-white">
                        <i class="fa-solid text-2xl mr-2 fa-cart-shopping"></i> Your cart
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="cart-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <ul id="cartItems" class="space-y-2">
                    <!-- Cart items will be dynamically added here -->
                </ul>
                <div class="mt-4 text-center">
                    <p id="cartTotal" class="text-2xl font-medium tracking-wide">Total: Rp 0</p>
                </div>
                <div class="flex gap-4 items-center w-full p-4 md:p-5 rounded-b dark:border-gray-600">
                    <x-primary-button type="button" data-modal-hide="cart-modal" type="button"
                        class="w-full">Cancel</x-primary-button>
                    <form id="orderForm" class="w-full" action="{{ route('orders.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="table_number" id="formTableNumber">
                        <input type="hidden" name="items" id="formCartItems">
                        <x-primary-button type="button" onclick="submitOrder()" data-modal-hide="cart-modal"
                            type="button" class="w-full bg-red-600 hover:bg-red-700">Order</x-primary-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>

</body>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const cartItemsContainer = document.getElementById("cartItems");
        const cartTotal = document.getElementById("cartTotal");
        const cartButton = document.getElementById("cartButton");

        if (cartButton) {
            cartButton.addEventListener("click", loadCartItems);
        }

        document.querySelectorAll('.decrementm').forEach(button => {
            button.addEventListener("click", (e) => {
                const quantityElement = e.target.parentElement.querySelector('p');
                const currentQuantity = parseInt(quantityElement.innerHTML);
                if (currentQuantity > 1) {
                    quantityElement.innerHTML = currentQuantity - 1;
                }
            });
        });

        document.querySelectorAll('.incrementm').forEach(button => {
            button.addEventListener("click", (e) => {
                const quantityElement = e.target.parentElement.querySelector('p');
                quantityElement.innerHTML = parseInt(quantityElement.innerHTML) + 1;
            });
        });

        window.confirmAddToCart = function(itemId, itemName, itemDescription, itemPrice) {
            const quantity = parseInt(document.getElementById(`orderQuantity-${itemId}`).textContent);
            const notes = document.getElementById("orderNotes").value;

            if (quantity > 0) {
                addToCart({
                    item: {
                        id: itemId,
                        name: itemName,
                        description: itemDescription,
                        price: itemPrice,
                    },
                    quantity,
                    notes
                });
            }
        };
    });

    function submitOrder() {
        const tableNumber = document.getElementById("tableNumber").textContent;
        const cart = JSON.parse(localStorage.getItem("cart")) || [];

        if (!tableNumber || cart.length === 0) {
            alert("Please select a table number and add items to the cart.");
            return;
        }

        document.getElementById("formTableNumber").value = tableNumber;
        document.getElementById("formCartItems").value = JSON.stringify(cart);

        document.getElementById("orderForm").submit();
        localStorage.setItem("cart", JSON.stringify([]));
    }

    function loadCartItems() {
        const cartItemsContainer = document.getElementById("cartItems");
        const cartTotal = document.getElementById("cartTotal");

        if (!cartItemsContainer || !cartTotal) return;

        cartItemsContainer.innerHTML = "";
        let cart = JSON.parse(localStorage.getItem("cart")) || [];
        let total = 0;
        if (cart.length === 0) {
            const noItemsElement = document.createElement("p");
            noItemsElement.classList.add("text-center", "text-xl", "text-gray-700", "mt-4");
            noItemsElement.textContent = "No items in cart.";
            cartItemsContainer.appendChild(noItemsElement);
            cartTotal.textContent = "Total: Rp 0";
            return;
        }
        cart.forEach((item, index) => {
            total += item.item.price * item.quantity;
            const itemElement = document.createElement("li");
            itemElement.classList.add("p-2", "px-4",
                "border-b", "border-red-200");
            itemElement.innerHTML = `
            <div class="flex justify-between items-center">
            <div><span class="text-2xl tracking-wide">${item.item.name}</span><p class="text-gray-700 font-inter">${item.notes}</p></div>
            <div class="flex items-center gap-2">
                <button class="decrement-button bg-red-600 text-white h-7 w-7 grid place-items-center rounded" data-index="${index}">-</button>
                <span class="font-inter">${item.quantity}</span>
                <button class="increment-button bg-red-600 text-white h-7 w-7 grid place-items-center rounded" data-index="${index}">+</button>
                <span class="font-inter font-medium">Rp ${(item.item.price * item.quantity).toLocaleString()}</span>
            </div></div>
        `;
            cartItemsContainer.appendChild(itemElement);
        });

        cartTotal.textContent = `Total: Rp ${total.toLocaleString()}`;

        document.querySelectorAll(".increment-button, .decrement-button").forEach(button => {
            button.addEventListener("click", (e) => {
                const index = e.target.dataset.index;
                const change = e.target.classList.contains("increment-button") ? 1 : -1;
                updateCartItemQuantity(index, change);
            });
        });
    }

    function updateCartItemQuantity(index, change) {
        let cart = JSON.parse(localStorage.getItem("cart")) || [];
        cart[index].quantity += change;

        if (cart[index].quantity <= 0) {
            cart.splice(index, 1);
        }

        localStorage.setItem("cart", JSON.stringify(cart));
        loadCartItems();
    }

    function addToCart(item) {
        let cart = JSON.parse(localStorage.getItem("cart")) || [];

        const existingItemIndex = cart.findIndex(cartItem => cartItem.item.id === item.item.id);

        if (existingItemIndex !== -1) {
            cart[existingItemIndex].quantity += item.quantity;
            cart[existingItemIndex].notes = item.notes;
        } else {
            cart.push(item);
        }

        localStorage.setItem("cart", JSON.stringify(cart));
    }
</script>

</html>
