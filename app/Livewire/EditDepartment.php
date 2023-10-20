<?php

namespace App\Livewire;

use App\Livewire\Forms\DepartmentForm;
use App\Models\Department;
use App\Traits\EncryptDecrypt;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class EditDepartment extends Component
{
    use EncryptDecrypt;

    public DepartmentForm $form;

    public bool $EditDepartmentModal = false;

    #[On('dispatch-edit-department')]
    public function set_department(Department $id): void
    {
        $this->form->setDepartment($id);

        $this->EditDepartmentModal = true;
    }

    public function edit(): void
    {
        $this->validate();

        $update = $this->form->update();

        is_null($update)
            ? $this->dispatch('notify', title: 'success', message:  ' '.$this->form->name. ' Updated successfully')
            : $this->dispatch('notify', title: 'fail', message: 'Ops!! Something went wrong');

        $this->EditDepartmentModal = false;

        $this->dispatch('dispatch-department-updated')->to(DepartmentTable::class);
    }

    public function render(): View
    {
        return view('livewire.department.edit-department');
    }
}
