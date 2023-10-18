<?php

namespace App\Livewire;

use Illuminate\View\View;
use Livewire\Attributes\Title;
use Livewire\Component;

class DepartmentIndex extends Component
{
    #[Title('Departments')]
    public function render(): View
    {
        return view('livewire.department-index');
    }
}
