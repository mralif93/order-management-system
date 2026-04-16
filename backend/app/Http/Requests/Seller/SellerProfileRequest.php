<?php

namespace App\Http\Requests\Seller;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class SellerProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::guard('seller')->check();
    }

    public function rules(): array
    {
        $sellerId = Auth::guard('seller')->id();

        // Password change section
        if ($this->routeIs('seller.profile.password')) {
            return [
                'current_password'          => ['required', 'string', 'current_password:seller'],
                'new_password'              => ['required', 'string', Password::min(8), 'confirmed'],
                'new_password_confirmation' => ['required'],
            ];
        }

        // Profile info + address section
        return [
            'name'          => ['required', 'string', 'max:255'],
            'email'         => ['required', 'email', 'max:255', Rule::unique('sellers', 'email')->ignore($sellerId)],
            'phone'         => ['nullable', 'string', 'max:30'],
            'address_line1' => ['nullable', 'string', 'max:255'],
            'address_line2' => ['nullable', 'string', 'max:255'],
            'address_line3' => ['nullable', 'string', 'max:255'],
            'city'          => ['nullable', 'string', 'max:100'],
            'state'         => ['nullable', 'string', 'max:100'],
            'postal_code'   => ['nullable', 'string', 'max:20'],
            'country'       => ['nullable', 'string', 'max:100'],
        ];
    }

    public function messages(): array
    {
        return [
            'current_password.current_password' => 'The current password you entered is incorrect.',
            'new_password.confirmed'            => 'The new password confirmation does not match.',
        ];
    }
}

