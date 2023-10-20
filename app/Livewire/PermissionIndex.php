<?php

namespace App\Livewire;

use Illuminate\View\View;
use Livewire\Attributes\Title;
use Livewire\Component;

class PermissionIndex extends Component
{
    #[Title('Permission')]
    public function render(): View
    {
        return view('livewire.permission.permission-index');
    }
}
