<?php

namespace App\Livewire;

use App\Livewire\Forms\UserForm;
use App\Models\Branch;
use App\Models\Department;
use App\Models\User;
use Illuminate\View\View;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class UserCreate extends Component
{
    public UserForm $form;

    public bool $CreateUserModal = false;

    public function save(): void
    {
        $this->validate();

        $user = $this->form->store();

        //$user->sendEmailVerificationNotification();

//       $new_user = User::where('email', $this->form->email);
//
//        ($new_user->sendEmailVerificationNotification())
//            ? $this->dispatch(
//            'notify',
//            title: 'success',
//            message:  'A new verification link has been sent to ' .$this->form->email
//        )
//
//            : $this->dispatch(
//            'notify',
//            title: 'fail',
//            message:  'There was an error while sending email to ' .$this->form->email
//        );

        is_null($user)
            ? $this->dispatch('notify', title: 'success', message:  ' '.$this->form->name. ' created successfully')
            : $this->dispatch('notify', title: 'fail', message: 'Ops!! Something went wrong');

        $this->dispatch('dispatch-user-created')->to(UserTable::class);

        $this->CreateUserModal = false;


    }

    public function render(): View
    {
        $branches   = Branch::where('status', 1)->get();
        $departments = Department::where('status', 1)->get();
        $roles = Role::all();

        return view('livewire.user.user-create',
            [
                'branches' => $branches,
                'departments' => $departments,
                'roles' => $roles,
            ]
        );
    }
}
