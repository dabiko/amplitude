<?php

namespace App\Livewire;

use App\Models\User;
use App\Traits\EncryptDecrypt;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class UserUpdateSituation extends Component
{
    use EncryptDecrypt;

    #[Locked]
    public string $id;

    #[Locked]
    public string $name;

    #[Locked]
    public string $situation;

    public bool $UpdateSituationModal = false;

    #[On('dispatch-update-user-situation')]
    public function situation($id,$name,$situation): void
    {
        if (empty($id || $name || $situation )){

            $this->dispatch('notify', title: 'fail', message: 'Hmm!! Suspicious Activity. please contact support for Technical assistance');

        }else{
            $this->id = $this->decryptId($id);
            $this->situation = $this->decryptId($situation);
            $this->name = $this->decryptId($name);

            $this->UpdateSituationModal = true;
        }
    }

    public function updateUserSituation(): void
    {
        if ($this->id == Auth::id()){
            $this->dispatch('notify', title: 'fail', message: 'Hmm!! Suspicious Activity. please contact support for Technical assistance');
            $this->UpdateSituationModal = false;
        }else{
            try{
                User::findOrFail($this->id)->update([
                    'situation' => $this->situation == 0 ? 1 : 0,
                ]);

                $this->dispatch('notify', title: 'success', message: $this->situation == 0 ? 'Account Blocked Successfully' : 'Account Unblocked Successfully');
                $this->dispatch('dispatch-situation-updated')->to(UserTable::class);

                $this->UpdateSituationModal = false;

            }catch (QueryException $e){

                $this->dispatch('notify', title: 'fail', message: $e->errorInfo[1]);

            }
        }
    }

    public function render(): View
    {
        return view('livewire.user.user-update-situation');
    }
}
