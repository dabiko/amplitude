<?php

namespace App\Livewire;

use App\Traits\EncryptDecrypt;
use Illuminate\View\View;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class RoleDelete extends Component
{
    use EncryptDecrypt;

    #[Locked]
    public string $id;

    #[Locked]
    public string $name;

    public bool $DeleteRoleModal = false;

    #[On('dispatch-delete-role')]
    public function set_role($id, $name): void
    {
        $this->id = $id;
        $this->name = $name;

        $this->DeleteRoleModal  = true;
    }

    public function deleteRole(): void
    {
        $delete = Role::destroy($this->decryptId($this->id));

        ($delete)
            ? $this->dispatch('notify', title: 'success', message:  ' '.$this->name. ' Deleted successfully')
            : $this->dispatch('notify', title: 'fail', message: 'Ops!! Something went wrong');

        $this->dispatch('dispatch-role-deleted')->to(RoleTable::class);

        $this->DeleteRoleModal  = false;

    }


    public function render(): View
    {
        return view('livewire.role.role-delete');
    }
}
