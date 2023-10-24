<?php

namespace App\Livewire;

use Illuminate\View\View;
use Livewire\Attributes\Title;
use Livewire\Component;

class UserDefaultPasswordIndex extends Component
{
    #[Title('Update Password')]
    public function render(): View
    {
        return view('livewire.password.user-default-password-index');
    }
}
