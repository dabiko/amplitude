<?php

namespace App\Livewire\Forms;

use App\Models\Department;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Attributes\Rule;
use Livewire\Form;

class DepartmentForm extends Form
{
    public ?Department $department;

    #[Rule('required', message: ' Department name is required')]
    #[Rule('string', message: 'Invalid department name')]
    #[Rule('min:4', message: 'Department name  can not be less than 4 characters')]
    #[Rule('max:20', message: 'Department name  can not be more than 20 characters')]
    #[Rule('unique:'.Department::class.',name', message: ' :input has already been created')]
    public string $name;

    public function setDepartment(Department $department): void
    {
        $this->department = $department;

        $this->name = $department->name;

    }

    public function store(): void
    {
        Department::create([
            'name' => $this->name,
            'user_id' => Auth::id(),
            'slug' => Str::slug($this->name, '-'),
            'status' => 1,
        ]);

        $this->reset($this->name = ' ');
    }


    public function update(): void
    {
        $this->department->update([
            'name' => $this->name,
            'slug' => Str::slug($this->name, '-'),
            'updated_by' => Auth::id(),
        ]);
    }
}
