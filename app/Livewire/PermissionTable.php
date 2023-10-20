<?php

namespace App\Livewire;

use Illuminate\View\View;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Permission;

class PermissionTable extends Component
{
    use WithPagination;

    #[Url]
    public int $per_page = 5;

    #[Url(history: true)]
    public string $search = '';

    #[Url(history: true)]
    public string $group = '';

    #[Locked]
    #[Url(history: true)]
    public string $sortBy = 'id';

    #[Url(history: true)]
    public string  $sortDirection = 'DESC';

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function setSortBy($sortByField): void
    {
        if ($this->sortBy === $sortByField){

            $this->sortDirection = ($this->sortDirection == "ASC") ? 'DESC' : "ASC";
            return;
        }

        $this->sortBy = $sortByField;
        $this->sortDirection = 'DESC';
    }

    #[On('dispatch-permission-created')]
    #[On('dispatch-permission-updated')]
    #[On('dispatch-permission-deleted')]
    #[On('dispatch-permission-imported')]
    public function render(): View
    {
        $permissions = Permission::search($this->search)
            ->when($this->group !== '', function ($query) {
                $query->where('group_name', $this->group);
            })
            ->orderBy($this->sortBy,$this->sortDirection)
            ->paginate($this->per_page);

        return view('livewire.permission.permission-table',
            [
                'permissions' => $permissions
            ]
        );
    }
}
