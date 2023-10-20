<?php

namespace App\Livewire;

use Illuminate\View\View;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;

class BranchIndex extends Component
{
    #[Title('Branches')]
    public function render(): View
    {
        return view('livewire.branch.branch-index');
    }
}
