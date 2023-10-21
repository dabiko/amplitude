<?php

namespace App\Livewire;

use App\Livewire\Forms\PrivilegeForm;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\View\View;
use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PrivilegeCreate extends Component
{
    public PrivilegeForm $form;

    public bool $CreatePrivilegeModal = false;


    public function save(): void
    {
        $this->validate();

        try {
            $branch = $this->form->store();

            is_null($branch)
                ? $this->dispatch('notify', title: 'success', message:  ' Created successfully')
                : $this->dispatch('notify', title: 'fail', message: 'Ops!! Something went wrong');

            $this->dispatch('dispatch-roles-permission-created')->to(PrivilegeTable::class);

            $this->CreatePrivilegeModal = false;

        }catch (QueryException $e){

            $errorCode = $e->errorInfo[1];

            ($errorCode == 1062)
                ? $this->dispatch('notify', title: 'fail', message: 'we have a duplicate entry problem')
                : $this->dispatch('notify', title: 'fail', message: 'Something string happened ');
        }
    }






    public function render(): View
    {
        $roles = Role::all();
        $permissions = Permission::all();
        $permission_groups = User::getPermissionGroups();

        return view('livewire.privilege.privilege-create',
            [
                'roles' => $roles,
                'permissions' => $permissions,
                'permission_groups' => $permission_groups,
            ]
        );
    }
}
