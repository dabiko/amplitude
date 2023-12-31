<?php

namespace App\Livewire;

use App\Models\Branch;
use App\Traits\EncryptDecrypt;
use Illuminate\View\View;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class BranchDelete extends Component
{
    use EncryptDecrypt;

    #[Locked]
    public string $id;

    #[Locked]
    public string $name;

    public bool $DeleteBranchModal = false;

    #[On('dispatch-delete-branch')]
    public function set_branch($id, $name): void
    {
        $this->id = $id;
        $this->name = $name;

        $this->DeleteBranchModal  = true;
    }

    public function deleteBranch(): void
    {
        $delete = Branch::destroy($this->decryptId($this->id));

        ($delete)
            ? $this->dispatch('notify', title: 'success', message:  ' '.$this->name. ' Deleted successfully')
            : $this->dispatch('notify', title: 'fail', message: 'Ops!! Something went wrong');

        $this->dispatch('dispatch-branch-deleted')->to(BranchTable::class);

        $this->DeleteBranchModal  = false;

    }

    public function render(): View
    {
        return view('livewire.branch.branch-delete');
    }
}
