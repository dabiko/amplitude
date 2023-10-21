<?php

namespace App\Livewire;

use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class PrivilegeTable extends Component
{
    use WithPagination;

    #[Url]
    public int $per_page = 5;

    #[Url(history: true)]
    public string $role = '';

    #[Locked]
    #[Url(history: true)]
    public string $sortBy = 'name';

    #[Url(history: true)]
    public string  $sortDirection = 'ASC';

    public function updatedSearch(): void
    {
        $this->resetPage();
    }

    public function setSortBy($sortByField): void
    {
        if ($this->sortBy === $sortByField){

            $this->sortDirection = ($this->sortDirection == "DESC") ? 'ASC' : "DESC";
            return;
        }

        $this->sortBy = $sortByField;
        $this->sortDirection = 'ASC';
    }


    #[On('dispatch-roles-permission-created')]
    #[On('dispatch-roles-permission-updated')]
    #[On('dispatch-roles-permission-deleted')]
    public function render(): View
    {
      $roles = Role::with(['user','updater'])
          ->when($this->role !== '', function ($query) {
              $query->where('name', $this->role);
          })
          ->orderBy($this->sortBy,$this->sortDirection)
          ->paginate($this->per_page);


        return view('livewire.privilege.privilege-table',
            [
                'roles' => $roles,
            ]
        );
    }
}
