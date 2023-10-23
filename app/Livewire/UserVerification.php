<?php

namespace App\Livewire;

use App\Models\User;
use App\Traits\EncryptDecrypt;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class UserVerification extends Component
{
    use EncryptDecrypt;

    #[Locked]
    public string $id;

    #[Locked]
    public string $name;

    #[Locked]
    public string $email;


    public bool $EmailVerificationModal = false;

    #[On('dispatch-user-email-verification')]
    public function emails($id,$name,$email): void
    {
        if (empty($id || $name || $email)){

            $this->dispatch('notify', title: 'fail', message: 'Hmm!! Suspicious Activity. please contact support for Technical assistance');

        }else{
            $this->id = $this->decryptId($id);
            $this->name = $this->decryptId($name);
            $this->email = $this->decryptId($email);

            $this->EmailVerificationModal = true;
        }
    }

    public function sendEmail(): void
    {
        if ($this->id == Auth::id()){
            $this->dispatch('notify', title: 'fail', message: 'Hmm!! Suspicious Activity. please contact support for Technical assistance');
            $this->EmailVerificationModal = false;
        }else{
            try{

                $user = User::findOrFail($this->id);
                $user->sendEmailVerificationNotification();

                $this->dispatch(
                    'notify',
                    title: 'success',
                    message:  'A new verification link has been sent to ' .$this->email
                );

                $this->EmailVerificationModal = false;

            }catch (QueryException $e){

                $this->dispatch('notify', title: 'fail', message: $e->errorInfo[1]);

            }
        }
    }


    public function render(): View
    {
        return view('livewire.user.user-verification');
    }
}
