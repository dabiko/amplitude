<?php

namespace App\Livewire;

use Illuminate\View\View;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class RoleTable extends Component
{
    use WithPagination;

    #[Url]
    public int $per_page = 5;

    #[Url(history: true)]
    public string $search = '';

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

    #[On('dispatch-role-created')]
    #[On('dispatch-role-updated')]
    #[On('dispatch-role-deleted')]
    public function render(): View
    {
        $roles = Role::search($this->search)
            ->with(['user','updater'])
            ->orderBy($this->sortBy,$this->sortDirection)
            ->paginate($this->per_page);


        return view('livewire.role.role-table',
            [
                'roles' => $roles
            ]
        );
    }
}
