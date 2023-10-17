<?php

namespace App\Livewire;

use App\Models\Branch;
use App\Traits\WithSorting;
use Illuminate\View\View;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class BranchTable extends Component
{
    use WithSorting;
    use WithPagination;

    public int $per_page = 5;

    public string $search = '';

    public string $status = '';

    public string
        $sortBy = 'branches.id',
        $sortDirection = 'desc';

//    #[Locked]
//    public int $id;

    #[On('dispatch-branch-created')]
    #[On('dispatch-branch-updated')]
    #[On('dispatch-branch-deleted')]
    public function render(): View
    {
        $branches = Branch::search($this->search)
            ->with(['user','updater'])
            ->when($this->status !== '', function ($query) {
                $query->where('status', $this->status);
            })
            ->orderBy($this->sortBy,$this->sortDirection)
            ->paginate($this->per_page);



        return view('livewire.branch-table',
            [
                'branches' => $branches
            ]
        );
    }
}
