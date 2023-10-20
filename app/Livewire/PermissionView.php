<?php

namespace App\Livewire;

use App\Livewire\Forms\PermissionForm;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;
use Spatie\Permission\Models\Permission;

class PermissionView extends Component
{
    public PermissionForm $form;

    public bool $ViewPermissionModal = false;

    #[On('dispatch-view-permission')]
    public function setPermissionEdit(Permission $id): void
    {
        $this->form->setPermission($id);

        $this->ViewPermissionModal = true;

    }

    public function render(): View
    {
        return view('livewire.permission.permission-view');
    }
}
