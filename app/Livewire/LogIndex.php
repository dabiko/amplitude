<?php

namespace App\Livewire;

use Illuminate\View\View;
use Livewire\Attributes\Title;
use Livewire\Component;

class LogIndex extends Component
{

    #[Title('Log')]
    public function render(): View
    {
        return view('livewire.log.log-index');
    }
}
