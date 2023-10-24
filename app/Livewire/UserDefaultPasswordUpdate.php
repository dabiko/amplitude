<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Illuminate\Validation\Rules;


class UserDefaultPasswordUpdate extends Component
{
    public bool $UpdatePasswordModal = true;

    public string $password;
    public string $password_confirmation;


    public function update(User $user): void
    {
        $this->validate([
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        try{
            if (Hash::check($this->password, Auth::user()->password)){

                $this->dispatch('notify', title: 'fail', message: 'Ops! You are still using the default password');

            }else{

                User::findOrFail(Auth::id())->update([
                    'password' => Hash::make($this->password),
                ]);

                $this->dispatch('notify', title: 'success', message:  'Password updated successfully !!');

                $this->UpdatePasswordModal = false;

                $this->redirect('/dashboard');
            }

        }catch (QueryException $e){

            $errorCode = $e->errorInfo[1];

            ($errorCode == 1062)
                ? $this->dispatch('notify', title: 'fail', message: 'we have a duplicate entry problem')
                : $this->dispatch('notify', title: 'fail', message: 'Something string happened ' .$errorCode );
        }
    }


    public function render(): View
    {
       $this->UpdatePasswordModal = true;
        return view('livewire.password.user-default-password-update');
    }
}
