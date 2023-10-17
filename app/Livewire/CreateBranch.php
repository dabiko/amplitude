<?php

namespace App\Livewire;

use App\Livewire\Forms\BranchForm;
use App\Models\Branch;
use Illuminate\View\View;
use Livewire\Component;

class CreateBranch extends Component
{
    public BranchForm $form;

    public bool $CreateBranchModal = false;

    public function save(): void
    {
        $this->validate();

        $branch = $this->form->store();

        is_null($branch)
            ? $this->dispatch('notify', title: 'success', message:  ' '.$this->form->name. ' created successfully')
            : $this->dispatch('notify', title: 'fail', message: 'Ops!! Something went wrong');

        $this->dispatch('dispatch-branch-created')->to(BranchTable::class);
    }

    public function render(): View
    {
        return view('livewire.create-branch');
    }
}
