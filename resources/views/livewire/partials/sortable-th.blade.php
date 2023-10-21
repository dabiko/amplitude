<th wire:click="setSortBy('{{ $columnName }}')" scope="col"
    class="py-3.5 pl-4 pr-3 text-center text-sm font-semibold text-gray-900 sm:pl-6">
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
