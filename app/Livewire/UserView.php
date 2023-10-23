<?php

namespace App\Livewire;

use App\Models\User;
use App\Traits\EncryptDecrypt;
use Illuminate\View\View;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

class UserView extends Component
{
    use EncryptDecrypt;

    #[Locked]
    public string $id;
    public string $name;
    public string $username;
    public string $email;
    public string $role;
    public string $branch;
    public string $department;
    public string $created_at;
    public string $updated_at;

    public string $situation;

    public bool $ViewUserModal = false;

    #[On('dispatch-view-user')]
    public function user($id): void
    {
        $user = User::findOrFail($this->decryptId($id));

        $this->name = $user->name;
        $this->username = $user->username;
        $this->email = $user->email;
        $this->role = $user->role->name;
        $this->branch = $user->branch->name;
        $this->department = $user->department->name;
        $this->created_at = $user->created_at;
        $this->updated_at = $user->updated_at;

        $this->ViewUserModal = true;
    }


    public function render(): View
    {
        return view('livewire.user.user-view');
    }
}
