<?php

namespace App\Livewire\Forms;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Rule;
use Livewire\Form;
use Spatie\Permission\Models\Permission;

class PermissionForm extends Form
{
    public ?Permission $permission;

    #[Rule('required', message: ' Permission name is required')]
    #[Rule('string', message: 'Invalid permission name')]
    #[Rule('min:4', message: 'Permission name  can not be less than 4 characters')]
    #[Rule('max:20', message: 'Permission name  can not be more than 20 characters')]
    #[Rule('unique:'.Permission::class.',name', message: ' :input has already been created')]
    public string $name;

    #[Rule('required', message: ' Group name is required')]
    #[Rule('string', message: 'Invalid group name')]
    #[Rule('min:4', message: 'Group name  can not be less than 4 characters')]
    #[Rule('max:20', message: 'Group name  can not be more than 20 characters')]
//    #[Rule('unique:'.Permission::class.',group_name', message: ' :input has already been created')]
    public string $group_name;


    public function setPermission(Permission $permission): void
    {
        $this->permission = $permission;

        $this->name = $permission->name;
        $this->group_name = $permission->group_name;

    }

    public function store(): void
    {
        Permission::create([
            'user_id' => Auth::id(),
            'name' => str($this->name)->squish(),
            'group_name' =>str($this->group_name)->squish(),
        ]);

        $this->reset($this->name = ' ', $this->group_name = ' ');
    }

    public function update(): void
    {
        $this->permission->update([
            'name' => str($this->name)->squish(),
            'group_name' => str($this->group_name)->squish(),
            'updated_by' => Auth::id(),
        ]);
    }
}
