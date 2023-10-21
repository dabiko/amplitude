<?php

namespace App\Livewire;

use App\Livewire\Forms\PrivilegeForm;
use App\Models\User;
use App\Traits\EncryptDecrypt;
use Illuminate\Database\QueryException;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PrivilegeEdit extends Component
{
    use EncryptDecrypt;

    public PrivilegeForm $form;

    public bool $UpdatePrivilegeModal = false;

    #[Rule('required', message: ' Role is required')]
    #[Rule('string', message: 'Invalid Role')]
    public string $edit_role;

    public $role;

    #[Rule('required', message: ' Permission is required')]
    #[Rule('array', message: 'Invalid permission name')]
    public array $permissions;

    #[On('dispatch-edit-roles_permission')]
    public function set_Privilege($id): void
    {
        $role = Role::findOrfail($id);
        $this->role = Role::findOrfail($id);
        $this->edit_role = $role->name;

        $this->UpdatePrivilegeModal = true;
    }

    public function edit(): void
    {
        $this->validate();

        try{

            $update = $this->form->update();

            is_null($update)
                ? $this->dispatch('notify', title: 'success', message:  ' '. ' Updated successfully')
                : $this->dispatch('notify', title: 'fail', message: 'Ops!! Something went wrong');

            $this->UpdatePrivilegeModal = false;

            $this->dispatch('dispatch-roles-permission-updated')->to(PrivilegeTable::class);

        }catch (QueryException $e){

            $errorCode = $e->errorInfo[1];

            ($errorCode == 1062)
                ? $this->dispatch('notify', title: 'fail', message: 'we have a duplicate entry problem')
                : $this->dispatch('notify', title: 'fail', message: 'Something strange happened ');
        }

    }

    public function render(): View
    {
        $permissions = Permission::all();
        $permission_groups = User::getPermissionGroups();


        return view('livewire.privilege.privilege-edit',
            [
                'permissions' => $permissions,
                'permission_groups' => $permission_groups,
            ]
        );
    }
}
