<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class AdminProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Auth::guard('web')->check();
    }

    public function rules(): array
    {
        $adminId = Auth::guard('web')->id();

        // Password change section
        if ($this->routeIs('admin.profile.password')) {
            return [
                'current_password'      => ['required', 'string', 'current_password:web'],
                'new_password'          => ['required', 'string', Password::min(8)->mixedCase()->numbers(), 'confirmed'],
                'new_password_confirmation' => ['required'],
            ];
        }

        // Profile info section
        return [
            'name'  => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users', 'email')->ignore($adminId)],
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

