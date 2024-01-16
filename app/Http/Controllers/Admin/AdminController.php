<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

use Illuminate\Validation\ValidationException;

class AdminController extends Controller
{

    public function login_form()
    {
        $moduleName = "Admin Login";
        return view('admin.auth.login-form', compact('moduleName'));
    }

    public function login_functionality(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        if (Auth::guard('admins')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('admin.dashboard');
        } else {
            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }
    }

    public function dashboard()
    {
        $moduleName = "Dashboard";
        return view('admin.main', compact('moduleName'));
    }

    public function logout(Request $request)
    {
        Auth::guard('admins')->logout();
        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login.form');
    }

    public function profile()
    {
        $moduleName = "Profile";
        return view('admin.auth.profile', compact('moduleName'));
    }

    public function updateprofile(Request $request)
    {
        $moduleName = "profile";
        // Get the current user
        $user = Auth::guard('admins')->user();

        // Verify the current password
        if (Hash::check($request->input('current_password'), $user->password)) {
            // Update the password
            $user->update([
                'password' => Hash::make($request->input('password')),
            ]);

            return redirect()->route('admin.profile')->with('success', 'Profile password updated successfully.');
        } else {

            return redirect()->back()->with('error', 'Current ' . $moduleName . ' password is incorrect.');
        }
    }
}
