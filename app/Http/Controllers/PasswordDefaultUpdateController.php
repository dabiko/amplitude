<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Livewire\Attributes\Title;

class PasswordDefaultUpdateController extends Controller
{

    public function index(): View
    {
        return view('auth.update-default-password');
    }
}
