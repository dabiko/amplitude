<?php

namespace App\Http\Requests;

use App\Models\Branch;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BranchUpdateRequest extends FormRequest
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
    public function rules(Branch $branch): array
    {
        return [
            'name' => ['required', 'string', 'min:4', 'max:20',
                Rule::unique('branches', 'id')->ignore($branch->id)],
        ];
    }
}
