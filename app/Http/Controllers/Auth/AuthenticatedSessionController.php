<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Mahasiswa;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate the login form
        $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        // Check if login is email or NIM
        $loginField = filter_var($request->login, FILTER_VALIDATE_EMAIL) ? 'email' : 'nim';

        // If using NIM, we need to find the associated user
        if ($loginField === 'nim') {
            $mahasiswa = Mahasiswa::where('nim', $request->login)->first();

            if (!$mahasiswa) {
                return back()->withErrors([
                    'login' => 'NIM tidak ditemukan.',
                ]);
            }

            $user = User::find($mahasiswa->user_id);

            if (!$user || !Hash::check($request->password, $user->password)) {
                return back()->withErrors([
                    'login' => 'Kredensial yang diberikan tidak sesuai dengan data kami.',
                ]);
            }

            Auth::login($user, $request->boolean('remember'));

            $request->session()->regenerate();

            return redirect()->intended(RouteServiceProvider::HOME);
        }

        // Using email
        $credentials = [
            'email' => $request->login,
            'password' => $request->password,
        ];

        
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended(RouteServiceProvider::HOME);
        }

        return back()->withErrors([
            'login' => 'Kredensial yang diberikan tidak sesuai dengan data kami.',
        ]);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
