<?php

namespace App\Livewire;

use App\Exports\PermissionsExport;
use Illuminate\Database\QueryException;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class PermissionIndex extends Component
{

    public function exportPermissions(): BinaryFileResponse
    {
        try {
            $this->dispatch('notify', title: 'success', message: 'Downloaded Successfully');

            return Excel::download(new PermissionsExport, 'permissions.xlsx');

        }catch ( QueryException $e){

            $errorCode = $e->errorInfo[1];

            ($errorCode)
                ? $this->dispatch('notify', title: 'fail', message: 'There was an error !!')
                : $this->dispatch('notify', title: 'fail', message: 'Something strange happened ');
        }
    }


    #[Title('Permission')]
    public function render(): View
    {
        return view('livewire.permission.permission-index');
    }
}
