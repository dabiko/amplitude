<?php

namespace App\Traits;

trait WithSorting
{
//    public string $sortBy = '';
//    public string $sortDirection = 'asc';

    public function sortField($field): void
    {
        $this->sortDirection = $this->sortBy === $field
            ? $this->reverseSort()
            : 'asc';

        $this->sortBy = $field;
    }

    public function reverseSort(): string
    {
        return $this->sortDirection === 'asc'
            ? 'desc'
            : 'asc';
    }


}
