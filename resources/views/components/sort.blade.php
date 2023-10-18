@props(['sortDirection' =>  null, 'sortBy' => null, 'field' => null])

@if($sortBy !== $field)
    <x-sort-none />
@elseif($sortDirection === 'ASC')
    <x-sort-ascending />
@else
    <x-sort-descending />
@endif
