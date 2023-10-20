<?php

namespace App\Livewire;

use App\Traits\EncryptDecrypt;
use Illuminate\View\View;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;
use Spatie\Permission\Models\Permission;

class PermissionDelete extends Component
{
    use EncryptDecrypt;

    #[Locked]
    public string $id;

    #[Locked]
    public string $name;

    public bool $DeletePermissionModal = false;

    #[On('dispatch-delete-permission')]
    public function set_permission($id, $name): void
    {
        $this->id = $id;
        $this->name = $name;

        $this->DeletePermissionModal  = true;
    }

    public function deletePermission(): void
    {
        $delete = Permission::destroy($this->decryptId($this->id));

        ($delete)
            ? $this->dispatch('notify', title: 'success', message:  ' '.$this->name. ' Deleted successfully')
            : $this->dispatch('notify', title: 'fail', message: 'Ops!! Something went wrong');

        $this->dispatch('dispatch-permission-deleted')->to(PermissionTable::class);

        $this->DeletePermissionModal  = false;

    }

    public function render(): View
    {
        return view('livewire.permission.permission-delete');
    }
}
