<?php

namespace App\Livewire;

use App\Livewire\Forms\PermissionForm;
use Illuminate\Database\QueryException;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Spatie\Permission\Models\Permission;

class PermissionEdit extends Component
{
    public PermissionForm $form;

    public bool $UpdatePermissionModal = false;


    #[On('dispatch-edit-permission')]
    public function set_permission(Permission $id): void
    {
        $this->form->setPermission($id);

        $this->UpdatePermissionModal = true;
    }

    public function edit(): void
    {
        $this->validate();

        try{

            $update = $this->form->update();

            is_null($update)
                ? $this->dispatch('notify', title: 'success', message:  ' '.$this->form->name. ' Updated successfully')
                : $this->dispatch('notify', title: 'fail', message: 'Ops!! Something went wrong');

            $this->UpdatePermissionModal = false;

            $this->dispatch('dispatch-permission-updated')->to(PermissionTable::class);

        }catch (QueryException $e){

            $errorCode = $e->errorInfo[1];

            ($errorCode == 1062)
                ? $this->dispatch('notify', title: 'fail', message: 'we have a duplicate entry problem')
                : $this->dispatch('notify', title: 'fail', message: 'Something strange happened ');
        }

    }

    public function render(): View
    {
        return view('livewire.permission.permission-edit');
    }
}
