<?php

namespace App\Livewire;

use App\Livewire\Forms\DepartmentForm;
use App\Models\Department;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class ViewDepartment extends Component
{
    public DepartmentForm $form;

    public bool $ViewDepartmentModal = false;


    #[On('dispatch-view-department')]
    public function setDepartmentEdit(Department $id): void
    {
        $this->form->setDepartment($id);

        $this->ViewDepartmentModal = true;

    }

    public function render(): View
    {
        return view('livewire.department.view-department');
    }
}
