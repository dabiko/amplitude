<?php

namespace App\Livewire\Forms;

use App\Models\User;
use App\Traits\EncryptDecrypt;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Rule;
use Livewire\Form;

class UserForm extends Form
{
    use EncryptDecrypt;

    public ?User $user;

    #[Rule('required', message: ' Name is required')]
    #[Rule('string', message: 'Invalid name')]
    #[Rule('min:4', message: 'Name  can not be less than 4 characters')]
    #[Rule('max:20', message: 'Name can not be more than 20 characters')]
    public string $name;

    #[Rule('required', message: ' Username is required')]
    #[Rule('string', message: 'Invalid username')]
    #[Rule('min:4', message: 'Name  can not be less than 4 characters')]
    #[Rule('max:20', message: 'Name can not be more than 20 characters')]
    #[Rule('unique:'.User::class.',username', message: ' :input has already been taken as username')]
    public string $username;

    #[Rule('required', message: ' Email is required')]
    #[Rule('string', message: 'Invalid email')]
    #[Rule('email', message: 'Invalid email format')]
    #[Rule('min:4', message: 'Email  can not be less than 4 characters')]
    #[Rule('max:30', message: 'Email can not be more than 30 characters')]
    #[Rule('unique:'.User::class.',email', message: ' An account with :input exist already')]
    public string $email;

    #[Rule('required', message: ' Privilege is required')]
    #[Rule('string', message: 'Invalid privilege')]
    public string $privilege;

    #[Rule('required', message: ' Branch is required')]
    #[Rule('string', message: 'Invalid branch')]
    public string $branch;

    #[Rule('required', message: ' Department is required')]
    #[Rule('string', message: 'Invalid department')]
    public string $department;

    public function setUser(User $user): void
    {
        $this->user = $user;

        $this->name = $user->name;
        $this->username = $user->username;
        $this->email = $user->email;
        $this->privilege = $user->role_id;
        $this->branch = $user->branch_id;
        $this->department = $user->department_id;

    }

    public function store(): void
    {
        User::create([
            'name' => str($this->name)->squish(),
            'username' => $this->username,
            'email' => $this->email,
            'role_id' => $this->decryptId($this->privilege),
            'branch_id' => $this->decryptId($this->branch),
            'department_id' => $this->decryptId($this->department),
            'status' => str(0)->squish(),
            'situation' => str(0)->squish(),
            'password' => Hash::make('password'),
        ]);

        $this->reset(
            $this->name = ' ',
            $this->username = ' ',
            $this->email = ' ',
            $this->privilege = ' ',
            $this->branch = ' ',
            $this->department = ' ',
        );
    }

    public function update(): void
    {
        $this->user->update([
            'name' => str($this->name)->squish(),
            'username' => $this->username,
            'email' => $this->email,
            'role_id' => $this->decryptId($this->privilege),
            'branch_id' => $this->decryptId($this->branch),
            'department_id' => $this->decryptId($this->department),
        ]);
    }
}
