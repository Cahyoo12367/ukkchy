<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('auth.index');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user()->load('role.menus');

            $role = $user->role;
            $menus = $role ? $role->menus : collect(); // ambil menu dari role tunggal

            session([
                'user_data' => [
                    'name'  => $user->name,
                    'email' => $user->email,
                    'role'  => $role?->name ?? '-',
                    'menus' => $menus->pluck('name')->toArray(),
                ]
            ]);

            return redirect()->intended('/dashboard'); // ganti sesuai dashboard kamu
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput($request->only('email'));
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
