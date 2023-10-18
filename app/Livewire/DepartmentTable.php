<?php

namespace App\Livewire;

use App\Models\Department;
use Illuminate\View\View;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class DepartmentTable extends Component
{
    use WithPagination;

    #[Url]
    public int $per_page = 5;

    #[Url(history: true)]
    public string $search = '';

    #[Url(history: true)]
    public string $status = '';

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


    #[On('dispatch-department-created')]
    #[On('dispatch-department-updated')]
    #[On('dispatch-department-deleted')]
    public function render(): View
    {
        $departments = Department::search($this->search)
            ->with(['user','updater'])
            ->when($this->status !== '', function ($query) {
                $query->where('status', $this->status);
            })
            ->orderBy($this->sortBy,$this->sortDirection)
            ->paginate($this->per_page);

        return view('livewire.department-table',
            [
                'departments' => $departments
            ]
        );
    }
}
