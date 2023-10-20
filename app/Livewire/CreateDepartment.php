<?php

namespace App\Livewire;

use App\Livewire\Forms\DepartmentForm;
use Illuminate\View\View;
use Livewire\Component;

class CreateDepartment extends Component
{
    public DepartmentForm $form;

    public bool $CreateDepartmentModal = false;

    public function save(): void
    {
        $this->validate();

        $department = $this->form->store();

        is_null($department)
            ? $this->dispatch('notify', title: 'success', message:  ' '.$this->form->name. ' created successfully')
            : $this->dispatch('notify', title: 'fail', message: 'Ops!! Something went wrong');

        $this->dispatch('dispatch-department-created')->to(DepartmentTable::class);
    }

    public function render(): View
    {
        return view('livewire.department.create-department');
    }
}
