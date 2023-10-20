<?php

namespace App\Livewire;

use App\Livewire\Forms\RoleForm;
use Illuminate\Database\QueryException;
use Illuminate\View\View;
use Livewire\Component;

class RoleCreate extends Component
{

    public RoleForm $form;

    public bool $CreateRoleModal = false;

    public function save(): void
    {
        $this->validate();

        try{

            $branch = $this->form->store();

            is_null($branch)
                ? $this->dispatch('notify', title: 'success', message:  ' '.$this->form->name. ' created successfully')
                : $this->dispatch('notify', title: 'fail', message: 'Ops!! Something went wrong');

            $this->dispatch('dispatch-role-created')->to(RoleTable::class);

        }catch (QueryException $e){

            $errorCode = $e->errorInfo[1];

            ($errorCode == 1062)
                ? $this->dispatch('notify', title: 'fail', message: 'we have a duplicate entry problem')
                : $this->dispatch('notify', title: 'fail', message: 'Something strange happened ');
        }
    }


    public function render():View
    {
        return view('livewire.role.role-create');
    }
}
