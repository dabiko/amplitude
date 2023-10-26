<?php

namespace App\Livewire;

use Illuminate\View\View;
use Livewire\Attributes\Title;
use Livewire\Component;

class SessionIndex extends Component
{
    #[Title('Sessions')]
    public function render():View
    {
        return view('livewire.session.session-index');
    }
}
