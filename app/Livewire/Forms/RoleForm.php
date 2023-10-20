<?php

namespace App\Livewire\Forms;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Rule;
use Livewire\Form;
use Spatie\Permission\Models\Role;

class RoleForm extends Form
{

    public ?Role $role;

    #[Rule('required', message: ' Role name is required')]
    #[Rule('string', message: 'Invalid role name')]
    #[Rule('min:4', message: 'Role name  can not be less than 4 characters')]
    #[Rule('max:20', message: 'ROle name  can not be more than 20 characters')]
    #[Rule('unique:'.Role::class.',name', message: ' :input has already been created')]
    public string $name;


    public function setRole(Role $role): void
    {
        $this->role = $role;

        $this->name = $role->name;

    }

    public function store(): void
    {
        Role::create([
            'name' => str($this->name)->squish(),
            'user_id' => Auth::id(),
        ]);

        $this->reset($this->name = ' ');
    }


    public function update(): void
    {
        $this->role->update([
            'name' => $this->name,
            'updated_by' => Auth::id(),
        ]);
    }
}
