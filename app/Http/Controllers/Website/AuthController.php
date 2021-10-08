<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Http\Requests\Website\LoginRequest;

class AuthController extends Controller
{
    	/**
         * Get login page
         */
        public function showLoginPage()
        {
            if (auth()->user()) {
                return redirect('/');
            }

            return view('website.auth.login');
        }

        /**
         * Authenticate user
         */
        public function authenticate(LoginRequest $request)
        {
            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)) {
                return redirect()->route('website.home');
            }

            return redirect()->back()->withErrors(['unauthenticate' => 'Email atau password salah']);
        }

        /**
         * Logout
         */
        public function logout()
        {
            Auth::logout();

            return redirect()->route('website.auth.login');
        }
    }
