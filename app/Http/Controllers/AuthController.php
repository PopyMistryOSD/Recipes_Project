<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    // GET /login -> raw PHP এর index.php এর সমতুল্য
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        return view('auth.login');
    }

    // POST /login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // raw PHP এর মতোই username দিয়ে login, কিন্তু role='admin' বাধ্যতামূলক
        if (Auth::attempt([
            'username' => $credentials['username'],
            'password' => $credentials['password'],
            'role'     => 'admin',
        ], $request->boolean('remember'))) {

            $request->session()->regenerate(); // session fixation attack থেকে বাঁচার জন্য
            return redirect()->intended(route('dashboard'));
        }

        throw ValidationException::withMessages([
            'username' => 'Invalid Username or Password!',
        ]);
    }

    // POST /logout -> raw PHP এর logout.php এর সমতুল্য
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
