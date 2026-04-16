<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdminSellerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $sellerId = $this->route('seller')?->id;

        return [
            'name'      => 'required|string|max:255',
            'email'     => ['required', 'string', 'email', 'max:255', Rule::unique('sellers')->ignore($sellerId)],
            'password'  => $sellerId ? 'nullable|string|min:8' : 'required|string|min:8',
            'phone'     => 'nullable|string|max:20',
            'is_active' => 'sometimes|boolean',
            'is_locked' => 'sometimes|boolean',
        ];
    }
}

