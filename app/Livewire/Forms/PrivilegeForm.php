<?php

namespace App\Livewire\Forms;

use App\Traits\EncryptDecrypt;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Rule;
use Livewire\Form;
use Spatie\Permission\Models\Role;

class PrivilegeForm extends Form
{
    use EncryptDecrypt;

    #[Rule('required', message: ' Role is required')]
    #[Rule('string', message: 'Invalid Role')]
    public string $role;

//    #[Rule('required', message: ' Group name is required')]
//    #[Rule('string', message: 'Invalid group name')]
//    public string $group;

    #[Rule('required', message: ' Permission is required')]
    #[Rule('array', message: 'Invalid permission name')]
    public array $permissions;


    public function store(): void
    {
       $data = [];
       $role_id = $this->decryptId($this->role);
       $permissions = $this->permissions;

       foreach ($permissions as $key => $permission_ids){
           $data['role_id'] = $role_id;
           $data['permission_id'] = $permission_ids;

           DB::table('role_has_permissions')->insert($data);
       }
    }


}
