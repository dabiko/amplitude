<?php

namespace App\Livewire;

use Illuminate\View\View;
use Livewire\Component;

class UserView extends Component
{
    public function render(): View
    {
        return view('livewire.user.user-view');
    }
}
