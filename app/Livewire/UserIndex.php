<?php

namespace App\Livewire;

use Illuminate\View\View;
use Livewire\Attributes\Title;
use Livewire\Component;

class UserIndex extends Component
{
    #[Title('User')]
    public function render(): View
    {
        return view('livewire.user.user-index');
    }
}
