<?php

namespace App\Livewire;

use App\Livewire\Forms\BranchForm;
use App\Models\Branch;
use App\Traits\EncryptDecrypt;
use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class BranchView extends Component
{
    use EncryptDecrypt;

    public BranchForm $form;

    public bool $ViewBranchModal = false;

    public string $user_id = '';

    #[On('dispatch-view-branch')]
    public function setBranchEdit(Branch $id): void
    {
        $this->form->setBranch($id);

        $this->ViewBranchModal = true;

    }

    public function render(): View
    {

        return view('livewire.branch-view');

    }
}
