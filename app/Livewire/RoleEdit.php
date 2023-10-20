<?php

namespace App\Livewire;

use App\Livewire\Forms\BranchForm;
use App\Livewire\Forms\RoleForm;
use App\Models\Branch;
use App\Traits\EncryptDecrypt;
use Illuminate\Database\QueryException;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class RoleEdit extends Component
{
    use EncryptDecrypt;

    public RoleForm $form;

    public bool $EditRoleModal = false;


    #[On('dispatch-edit-role')]
    public function set_Role(Role $id): void
    {
        $this->form->setRole($id);

        $this->EditRoleModal = true;
    }

    public function edit(): void
    {
        $this->validate();

        try{

            $update = $this->form->update();

            is_null($update)
                ? $this->dispatch('notify', title: 'success', message:  ' '.$this->form->name. ' Updated successfully')
                : $this->dispatch('notify', title: 'fail', message: 'Ops!! Something went wrong');

            $this->EditRoleModal = false;

            $this->dispatch('dispatch-role-updated')->to(RoleTable::class);

        }catch (QueryException $e){

            $errorCode = $e->errorInfo[1];

            ($errorCode == 1062)
                ? $this->dispatch('notify', title: 'fail', message: 'we have a duplicate entry problem')
                : $this->dispatch('notify', title: 'fail', message: 'Something string happened ');
        }

    }

    public function render(): View
    {
        return view('livewire.role.role-edit');
    }
}
