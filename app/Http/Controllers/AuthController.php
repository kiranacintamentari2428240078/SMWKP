<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view('Wisatawan.login');
    }

    public function proses(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Capture requested role from form
        $requestedRole = $request->input('role');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Validate if the user's role matches the requested role
            if ($requestedRole && $user->role !== $requestedRole) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return back()->withErrors([
                    'email' => 'Peran yang dipilih tidak sesuai dengan akun Anda.'
                ]);
            }

            $request->session()->regenerate();

            return match ($user->role) {
                'wisatawan' => redirect()->route('wisatawan.homepage'),
                'mitra' => redirect()->route('resto.dashboard'),
                'admin_dinas' => redirect()->route('dinas.dashboard'),
                default => redirect()->route('login'),
            };
        }

        return back()->withErrors([
            'email' => 'Email atau password salah'
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('homepage');
    }
}