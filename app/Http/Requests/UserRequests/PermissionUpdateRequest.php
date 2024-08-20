<?php

namespace App\Http\Requests\UserRequests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class PermissionUpdateRequest extends FormRequest
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
    public function rules(): array
    {
        $permissionId = $this->route('permission') ? $this->route('permission')->id : null;
        return [
            'name' => 'required|unique:permissions,name,' . $permissionId . '|max:255',
            'description' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Le champ nom est obligatoire.',
            'name.unique' => 'Ce nom de permission est déjà pris.',
            'description.string' => 'La description doit être une chaîne de caractères.',
        ];
    }
}
