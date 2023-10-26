<?php

namespace App\Livewire;

use App\Models\Branch;
use Illuminate\View\View;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class BranchTable extends Component
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

    #[On('dispatch-branch-created')]
    #[On('dispatch-branch-updated')]
    #[On('dispatch-branch-deleted')]
    #[On('dispatch-branch-status-updated')]
    public function render(): View
    {
        $branches = Branch::search($this->search)
            ->with(['user','updater'])
            ->when($this->status !== '', function ($query) {
                $query->where('status', $this->status);
            })
            ->orderBy($this->sortBy,$this->sortDirection)
            ->paginate($this->per_page);



        return view('livewire.branch.branch-table',
            [
                'branches' => $branches
            ]
        );
    }
}
