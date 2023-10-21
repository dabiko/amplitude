<?php

namespace App\Livewire;

use Illuminate\View\View;
use Livewire\Attributes\Title;
use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PrivilegeIndex extends Component
{
    #[Title('Privilege')]
    public function render(): View
    {
        return view('livewire.privilege.privilege-index');
    }
}
