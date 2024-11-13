@props(['category'])
<a
class="font-inter text-sm sm:text-base font-medium min-w-24 justify-center text-center px-4 sm:px-6 py-1.5 sm:py-2 flex items-center text-white bg-rose-600"
    href="{{ request()->url() . (request()->query('table') ? '?table=' . request()->query('table') : '') . (request()->query('table') ? '&' : '?') . 'category=' . $category }}">
    {{ $category == '' ? 'All' : ucfirst($category) }}
</a>
