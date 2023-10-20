<?php

namespace App\Livewire;

use Illuminate\View\View;
use Livewire\Attributes\Title;
use Livewire\Component;

class RoleIndex extends Component
{
    #[Title('Role')]
    public function render(): View
    {
        return view('livewire.role.role-index');
    }
}
