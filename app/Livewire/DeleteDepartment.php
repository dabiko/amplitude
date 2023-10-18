<?php

namespace App\Livewire;

use App\Models\Department;
use App\Traits\EncryptDecrypt;
use Illuminate\View\View;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class DeleteDepartment extends Component
{
    use EncryptDecrypt;

    #[Locked]
    public string $id;

    #[Locked]
    public string $name;

    public bool $DeleteDepartmentModal = false;

    #[On('dispatch-delete-department')]
    public function set_department($id, $name): void
    {
        $this->id = $id;
        $this->name = $name;

        $this->DeleteDepartmentModal  = true;
    }

    public function deleteDepartment(): void
    {
        $delete = Department::destroy($this->decryptId($this->id));

        ($delete)
            ? $this->dispatch('notify', title: 'success', message:  ' '.$this->name. ' Deleted successfully')
            : $this->dispatch('notify', title: 'fail', message: 'Ops!! Something went wrong');

        $this->DeleteDepartmentModal  = false;

        $this->dispatch('dispatch-department-deleted')->to(DepartmentTable::class);
    }

    public function render(): View
    {
        return view('livewire.delete-department');
    }
}
