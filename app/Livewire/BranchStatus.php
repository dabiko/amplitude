<?php

namespace App\Livewire;

use App\Models\Branch;
use App\Traits\EncryptDecrypt;
use Illuminate\Database\QueryException;
use Illuminate\View\View;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class BranchStatus extends Component
{
    use EncryptDecrypt;

    #[Locked]
    public string $id;

    #[Locked]
    public string $name;

    #[Locked]
    public string $status;

    public bool $BranchStatusModal = false;



    #[On('dispatch-branch-status')]
    public function status($id,$name,$status): void
    {
        $this->id = $this->decryptId($id);
        $this->name = $this->decryptId($name);
        $this->status = $this->decryptId($status);

        $this->BranchStatusModal = true;
    }

    public function updateBranchStatus(): void
    {
        try{

            Branch::findOrFail($this->id)->update([
                'status' => $this->status == 0 ? 1 : 0,
            ]);

            $this->dispatch('notify', title: 'success', message: $this->status == 1 ? 'Branch Deactivated Successfully' : 'Branch Activated Successfully');
            $this->dispatch('dispatch-branch-status-updated')->to(BranchTable::class);

            $this->BranchStatusModal = false;

        }catch (QueryException $e){

            $this->dispatch('notify', title: 'fail', message: $e->errorInfo[1]);

        }

    }


    public function render(): View
    {
        return view('livewire.branch.branch-status');
    }
}
