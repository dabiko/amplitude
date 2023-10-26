<?php

namespace App\Livewire;

use App\Models\Department;
use App\Traits\EncryptDecrypt;
use Illuminate\Database\QueryException;
use Illuminate\View\View;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class DepartmentStatus extends Component
{
    use EncryptDecrypt;

    #[Locked]
    public string $id;

    #[Locked]
    public string $name;

    #[Locked]
    public string $status;

    public bool $DepartmentStatusModal = false;


    #[On('dispatch-department-status')]
    public function status($id,$name,$status): void
    {
        $this->id = $this->decryptId($id);
        $this->name = $this->decryptId($name);
        $this->status = $this->decryptId($status);

        $this->DepartmentStatusModal = true;
    }

    public function updateDepartmentStatus(): void
    {
        try{

            Department::findOrFail($this->id)->update([
                'status' => $this->status == 0 ? 1 : 0,
            ]);

            $this->dispatch('notify', title: 'success', message: $this->status == 1 ? 'Department Deactivated Successfully' : 'Department Activated Successfully');
            $this->dispatch('dispatch-department-status-updated')->to(DepartmentTable::class);

            $this->DepartmentStatusModal = false;

        }catch (QueryException $e){

            $this->dispatch('notify', title: 'fail', message: $e->errorInfo[1]);

        }

    }


    public function render(): View
    {
        return view('livewire.department.department-status');
    }
}
