<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdminCustomerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $customerId = $this->route('customer')?->id;
        $isUpdate = $customerId !== null;

        return [
            'name' => $isUpdate ? 'sometimes|required|string|max:255' : 'required|string|max:255',
            'email' => $isUpdate
                ? ['sometimes', 'required', 'string', 'email', 'max:255', Rule::unique('customers')->ignore($customerId)]
                : ['required', 'string', 'email', 'max:255', Rule::unique('customers')],
            'password' => $isUpdate ? 'nullable|string|min:8' : 'required|string|min:8',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
            'is_active' => 'sometimes|boolean',
            'is_locked' => 'sometimes|boolean',
        ];
    }
}

