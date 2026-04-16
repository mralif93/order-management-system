<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Customer;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Redirect to the correct dashboard if any guard is already authenticated.
     * Returns a redirect response or null if no guard is authenticated.
     */
    private function redirectIfAnyAuthenticated(): ?\Illuminate\Http\RedirectResponse
    {
        if (Auth::guard('web')->check()) {
            return redirect()->route('admin.dashboard');
        }
        if (Auth::guard('seller')->check()) {
            return redirect()->route('seller.dashboard');
        }
        if (Auth::guard('customer')->check()) {
            return redirect()->route('customer.dashboard');
        }
        return null;
    }

    /**
     * Show the login form for customers.
     */
    public function showLogin()
    {
        if ($redirect = $this->redirectIfAnyAuthenticated()) {
            return $redirect;
        }
        return view('auth.login', ['title' => 'Customer Login']);
    }

    /**
     * Handle a customer authentication attempt.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('customer')->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('customer.dashboard'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * Show the login form for admins.
     */
    public function showAdminLogin()
    {
        if ($redirect = $this->redirectIfAnyAuthenticated()) {
            return $redirect;
        }

        return view('auth.login', ['title' => 'Admin Login', 'isAdmin' => true]);
    }

    /**
     * Handle an admin authentication attempt.
     */
    public function adminLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('web')->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * Show the login form for sellers.
     */
    public function showSellerLogin()
    {
        if ($redirect = $this->redirectIfAnyAuthenticated()) {
            return $redirect;
        }
        return view('auth.login', ['title' => 'Seller Login', 'isSeller' => true]);
    }

    /**
     * Handle a seller authentication attempt.
     */
    public function sellerLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::guard('seller')->attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('seller.dashboard'));
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * Show the registration form for sellers.
     */
    public function showSellerRegister()
    {
        return view('auth.register', ['title' => 'Seller Registration', 'isSeller' => true]);
    }

    /**
     * Handle the registration request for sellers.
     */
    public function sellerRegister(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:30',
            'email' => 'required|string|email|max:255|unique:sellers',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $seller = \App\Models\Seller::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_active' => true,
        ]);

        Auth::guard('seller')->login($seller);
        $request->session()->regenerate();

        return redirect()->route('seller.dashboard');
    }

    /**
     * Show the registration form.
     */
    public function showRegister()
    {
        return view('auth.register', ['title' => 'Customer Registration']);
    }

    /**
     * Handle the registration request for customers.
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:customers',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $customer = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_active' => true,
        ]);

        Auth::guard('customer')->login($customer);
        $request->session()->regenerate();

        return redirect()->route('customer.dashboard')
            ->with('success', 'Welcome, ' . $customer->name . '! Your account has been created successfully.');
    }

    /**
     * Show the forgot password form.
     */
    public function showForgotPassword()
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle the forgot password request.
     */
    public function forgotPassword(Request $request)
    {
        // Placeholder for forgot password logic
        return back()->with('status', 'Password reset links are currently disabled.');
    }

    /**
     * Log the user out of the application.
     */
    public function logout(Request $request)
    {
        $redirectTo = '/';

        if (Auth::guard('web')->check()) {
            Auth::guard('web')->logout();
            $redirectTo = route('admin.login');
        } elseif (Auth::guard('customer')->check()) {
            Auth::guard('customer')->logout();
            $redirectTo = route('login');
        } elseif (Auth::guard('seller')->check()) {
            Auth::guard('seller')->logout();
            $redirectTo = route('seller.login');
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect($redirectTo);
    }

    public function sellerLogout(Request $request)
    {
        Auth::guard('seller')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('seller.login');
    }

}
