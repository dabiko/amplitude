<?php

namespace App\Livewire\Forms;

use App\Models\Branch;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Attributes\Rule;
use Livewire\Form;

class BranchForm extends Form
{
    public ?Branch $branch;

    #[Rule('required', message: ' Branch name is required')]
    #[Rule('string', message: 'Invalid branch name')]
    #[Rule('min:4', message: 'Branch name  can not be less than 4 characters')]
    #[Rule('max:20', message: 'Branch name  can not be more than 20 characters')]
    #[Rule('unique:'.Branch::class.',name', message: ' :input has already been created')]
    public string $name;

    public function setBranch(Branch $branch): void
    {
        $this->branch = $branch;

        $this->name = $branch->name;
    }

    public function store(): void
    {
        Branch::create([
            'name' => $this->name,
            'user_id' => Auth::id(),
            'slug' => Str::slug($this->name, '-'),
            'status' => 1,
        ]);

        $this->reset($this->name = ' ');
    }

    public function update(): void
    {
        $this->branch->update([
            'name' => $this->name,
            'slug' => Str::slug($this->name, '-'),
            'updated_by' => Auth::id(),
        ]);
    }
}
