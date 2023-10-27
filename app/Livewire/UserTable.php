<?php

namespace App\Livewire;

use App\Models\Branch;
use App\Models\User;
use App\Traits\EncryptDecrypt;
use Illuminate\View\View;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class UserTable extends Component
{
    use EncryptDecrypt;

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


    #[On('dispatch-user-created')]
    #[On('dispatch-user-updated')]
    #[On('dispatch-situation-updated')]
    public function render(): View
    {
        $users = User::search($this->search)
            ->orderBy($this->sortBy,$this->sortDirection)
            ->paginate($this->per_page);

        $branches = Branch::all();

        return view('livewire.user.user-table',
            [
                'users' => $users,
                'branches' =>  $branches
            ]
        );
    }
}
