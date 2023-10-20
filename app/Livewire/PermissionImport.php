<?php

namespace App\Livewire;


use Illuminate\Database\QueryException;
use Illuminate\View\View;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\PermissionImport as ImportPermission;

class PermissionImport extends Component
{
    use WithFileUploads;

    #[Rule('file|max:1024')] // 1MB Max
    public  $file;

    public bool $ImportPermissionModal = false;

    public function save(): void
    {
        $this->validate();

        try{

               Excel::import(new ImportPermission, $this->file);

                $this->dispatch('notify', title: 'success', message:  'Uploaded successfully');

                $this->dispatch('dispatch-permission-imported')->to(PermissionTable::class);

                $this->ImportPermissionModal = false;

        }catch (QueryException $e){

            $errorCode = $e->errorInfo[1];

            ($errorCode == 1062)
                ? $this->dispatch('notify', title: 'fail', message: 'Duplicate entry problem')
                : $this->dispatch('notify', title: 'fail', message: 'Something strange happened ');
        }

    }

    public function render(): View
    {
        return view('livewire.permission.permission-import');
    }
}
