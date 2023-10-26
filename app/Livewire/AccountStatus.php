<?php

namespace App\Livewire;

use Illuminate\View\View;
use Livewire\Attributes\Title;
use Livewire\Component;

class AccountStatus extends Component
{
    #[Title('Account Status')]
    public function render(): View
    {
        return view('livewire.user.account-status');
    }
}
