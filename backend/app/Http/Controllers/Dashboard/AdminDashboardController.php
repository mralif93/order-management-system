<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminProfileRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminDashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index');
    }

    public function profile()
    {
        $admin = Auth::guard('web')->user();
        return view('dashboard.profile', compact('admin'));
    }

    public function profileUpdate(AdminProfileRequest $request)
    {
        $admin = Auth::guard('web')->user();
        $admin->update($request->validated());

        return redirect()->route('admin.profile')
            ->with('success', 'Profile updated successfully.');
    }

    public function passwordUpdate(AdminProfileRequest $request)
    {
        $admin = Auth::guard('web')->user();
        $admin->update(['password' => Hash::make($request->validated()['new_password'])]);

        return redirect()->route('admin.profile')
            ->with('success', 'Password changed successfully.');
    }
}
