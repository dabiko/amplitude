<?php

namespace App\Livewire;

use App\Models\logs;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class LogTable extends Component
{
    use WithPagination;

    #[Url]
    public int $per_page = 5;

    #[Url(history: true)]
    public string $search = '';

    public string $by_user = '';

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


    public function render(): View
    {
        $logs = Logs::search($this->search)
            ->with(['user'])
            ->when($this->by_user !== '', function ($query) {
                $query->where('user_id', $this->by_user);
            })
            ->orderBy($this->sortBy,$this->sortDirection)
            ->paginate($this->per_page);

        $users = User::all();

        return view('livewire.log.log-table',
            [
                'logs' => $logs,
                'users' => $users,
            ]
        );
    }
}
