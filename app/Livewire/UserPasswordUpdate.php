<?php

namespace App\Livewire;

use App\Models\User;
use App\Traits\EncryptDecrypt;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class UserPasswordUpdate extends Component
{
    use EncryptDecrypt;

    #[Locked]
    public string $id;

    #[Locked]
    public string $name;

    #[Locked]
    public string $email;

    public bool $ResetPasswordModal = false;

    #[On('dispatch-user-reset-password')]
    public function resetInfo($id,$name,$email): void
    {
        if (empty($id || $name || $email )){

            $this->dispatch('notify', title: 'fail', message: 'Hmm!! Suspicious Activity. please contact support for Technical assistance');

        }else{
            $this->id = $this->decryptId($id);
            $this->name = $this->decryptId($name);
            $this->email = $this->decryptId($email);

            $this->ResetPasswordModal = true;
        }
    }

    public function sendEmail(): void
    {
        if ($this->id == Auth::id()){
            $this->dispatch('notify', title: 'fail', message: 'Hmm!! Suspicious Activity on your account. Please contact Technical support for assistance');
            $this->ResetPasswordModal = false;
        }else{

            try{

                $user = User::findOrFail($this->id);

                $status = Password::sendResetLink(
                    $user->only('email')
                );

                ($status)
                   ? $this->dispatch(
                        'notify',
                        title: 'success',
                        message:  'A new password reset link was sent to ' .$this->email
                    )
                   :  $this->dispatch(
                    'notify',
                    title: 'fail',
                    message:  'There was an error'
                    );
                $this->ResetPasswordModal = false;

            }catch (QueryException $e){

                $this->dispatch('notify', title: 'fail', message: $e->errorInfo[1]);

            }
        }
    }

    public function render(): View
    {
        return view('livewire.user.user-password-update');
    }
}
