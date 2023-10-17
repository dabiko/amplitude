<?php

namespace App\Livewire;

use App\Livewire\Forms\BranchForm;
use App\Models\Branch;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class BranchEdit extends Component
{
    public BranchForm $form;

    public bool $EditBranchModal = false;

    #[On('dispatch-edit-branch')]
    public function set_branch(Branch $id): void
    {
        $this->form->setBranch($id);

        $this->EditBranchModal = true;
    }

    public function edit(): void
    {
        $this->validate();

        $update = $this->form->update();

        is_null($update)
            ? $this->dispatch('notify', title: 'success', message:  ' '.$this->form->name. ' Updated successfully')
            : $this->dispatch('notify', title: 'fail', message: 'Ops!! Something went wrong');

        $this->EditBranchModal = false;

        $this->dispatch('dispatch-branch-updated')->to(BranchTable::class);
    }

    public function render(): View
    {
        return view('livewire.branch-edit');
    }
}
