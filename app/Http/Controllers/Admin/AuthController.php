<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Website\LoginRequest;
use Auth;

class AuthController extends Controller
{
    /**
     * Get login page
     */
    public function showLoginPage()
    {
        if (auth()->user()) {
            return redirect('/admin');
        }

        return view('admin.auth.login');
    }

    /**
     * Authenticate user
     */
    public function authenticate(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {

            if (!Auth::user()->hasRole('administrator')) {
                auth()->logout();
                $message = 'Anda tidak memiliki otorisasi ke halaman ini';
            } else {
                return redirect()->route('admin.home');
            }
        } else {
            $message = 'Email atau password salah';
        }

        return redirect()->back()->withErrors(['unauthenticate' => $message]);
    }

    /**
     * Logout
     */
    public function logout()
    {
        Auth::logout();

        return redirect()->route('admin.auth.login');
    }

    /**
     * change password
     */
    public function changePassword(ChangePasswordRequest $request)
    {
        $user = auth()->user();

        $user->update([
            'password' => Hash::make($request->password)
        ]);

        return redirect()->back()->with('success', true);
    }
}
