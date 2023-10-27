<?php

namespace App\Livewire;

use App\Livewire\Forms\UserForm;
use App\Models\Branch;
use App\Models\Department;
use App\Models\User;
use App\Traits\EncryptDecrypt;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;
use Spatie\Permission\Models\Role;
use Illuminate\Validation\Rule;

class UserEdit extends Component
{
    use EncryptDecrypt;

    public UserForm $form;

    #[Locked]
    public string $id;

    #[Locked]
    public string $privilege;

    #[Locked]
    public string $branch;

    #[Locked]
    public string $department;


    public bool $EditUserModal = false;




    #[On('dispatch-edit-user')]
    public function set_user(User $id): void
    {
        $this->form->setUser($id);

        $this->EditUserModal = true;
    }

    public function edit(): void
    {

        $this->validate();

        //dd($this->validate(),$this->id);

        try{
            $update = $this->form->update();

            is_null($update)
                ? $this->dispatch('notify', title: 'success', message:  ' '.$this->form->name. ' Updated successfully')
                : $this->dispatch('notify', title: 'fail', message: 'Ops!! Something went wrong');

            $this->EditUserModal = false;

            $this->dispatch('dispatch-user-updated')->to(UserTable::class);

        }catch (QueryException $e){

            $errorCode = $e->errorInfo[1];

            ($errorCode == 1062)
                ? $this->dispatch('notify', title: 'fail', message: 'we have a duplicate entry problem')
                : $this->dispatch('notify', title: 'fail', message: 'Something strange happened ' .$errorCode);
        }

    }

    public function render(): View
    {
        $branches   = Branch::where('status', 1)->get();
        $departments = Department::where('status', 1)->get();
        $roles = Role::all();

        return view('livewire.user.user-edit',
            [
                'branches' => $branches,
                'departments' => $departments,
                'roles' => $roles,
            ]
        );
    }
}
