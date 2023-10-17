@props(['sortDirection' =>  null, 'sortBy' => null, 'field' => null])

@if($sortBy === $field)
    @if($sortDirection === 'asc')
        <x-sort-ascending />
    @else
        <x-sort-descending />
    @endif
@endif
