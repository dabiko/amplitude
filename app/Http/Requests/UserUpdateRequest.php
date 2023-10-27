<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(User $user): array
    {
        return [
            'form.name' => ['required', 'string', 'min:4', 'max:20'],
            'form.username' => ['required', 'string', 'min:4', 'max:20',
                Rule::unique('users', 'id')->ignore($user->id)],
            'form.email' => ['required', 'string', 'email', 'min:4', 'max:30',
                Rule::unique('users', 'id')->ignore($user->id)],
            'form.privilege' => ['required', 'string'],
            'form.branch' => ['required', 'string'],
            'form.department' => ['required', 'string'],
        ];
    }
}
