<th wire:click="setSortBy('{{ $columnName }}')" scope="col"
    class="py-3.5 pl-4 pr-3 text-center text-sm font-semibold text-gray-900 sm:pl-6 border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
    <button class="flex items-center">
        {{ $displayName }}
        @if($sortBy !== $columnName)
            <x-sort-none />
        @elseif($sortDirection === 'ASC')
            <x-sort-ascending />
        @else
            <x-sort-descending />
        @endif
    </button>
</th>
