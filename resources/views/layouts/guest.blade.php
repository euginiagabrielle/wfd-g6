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
    <div class="flex justify-between p-4 items-center w-full">
        <a href={{ '/?table=' . request()->query('table') }} class="text-rose-600 text-3xl">Kopi tiam</a>
        <p class="text-rose-600 text-3xl border-b-4 border-b-yellow-400">Menu</p>
        @if (isset($tableNumber))
            <div class="text-rose-600 text-3xl flex items-center gap-2 sm:gap-4">
                Table
                <span id="tableNumber" class="font-semibold">{{ $tableNumber }}</span>
                @if (request()->is('/'))
                    <button id="cartButton" data-modal-target="cart-modal" data-modal-toggle="cart-modal"><i
                            class="fa-solid fa-cart-shopping text-xl p-1.5 aspect-square bg-rose-600 text-white rounded"></i>
                    </button>
                @endif
            </div>
        @endif
    </div>
    @yield('content')
    @if (!str_starts_with(request()->url(), request()->root()))
        {{ $slot }}
    @endif
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
</body>
@yield('script')

</html>
