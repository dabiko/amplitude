<?php

namespace App\Livewire;

use App\Http\Requests\BranchUpdateRequest;
use App\Livewire\Forms\BranchForm;
use App\Models\Branch;
use App\Traits\EncryptDecrypt;
use Illuminate\Database\QueryException;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class BranchEdit extends Component
{
    use EncryptDecrypt;

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

        try{

            $update = $this->form->update();

            is_null($update)
                ? $this->dispatch('notify', title: 'success', message:  ' '.$this->form->name. ' Updated successfully')
                : $this->dispatch('notify', title: 'fail', message: 'Ops!! Something went wrong');

            $this->EditBranchModal = false;

            $this->dispatch('dispatch-branch-updated')->to(BranchTable::class);

        }catch (QueryException $e){

            $errorCode = $e->errorInfo[1];

            ($errorCode == 1062)
                ? $this->dispatch('notify', title: 'fail', message: 'we have a duplicate entry problem')
                : $this->dispatch('notify', title: 'fail', message: 'Something string happened ');
        }

    }

    public function render(): View
    {
        return view('livewire.branch-edit');
    }
}
