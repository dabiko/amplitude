<?php

namespace App\Livewire;

use App\Traits\EncryptDecrypt;
use Illuminate\View\View;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class PrivilegeDelete extends Component
{
    use EncryptDecrypt;

    #[Locked]
    public string $id;

    #[Locked]
    public string $name;

    public bool $DeleteRolePermissionModal= false;

    #[On('dispatch-delete-roles_permission')]
    public function set_role_permission($id, $name): void
    {
        $this->id = $id;
        $this->name = $name;

        $this->DeleteRolePermissionModal  = true;
    }

    public function deleteRolePermission(): void
    {
        $delete = Role::destroy($this->decryptId($this->id));

        ($delete)
            ? $this->dispatch('notify', title: 'success', message:  ' '.$this->name. ' Deleted successfully')
            : $this->dispatch('notify', title: 'fail', message: 'Ops!! Something went wrong');

        $this->dispatch('dispatch-roles-permission-deleted')->to(PrivilegeTable::class);

        $this->DeleteRolePermissionModal  = false;

    }


    public function render(): View
    {
        return view('livewire.privilege.privilege-delete');
    }
}
