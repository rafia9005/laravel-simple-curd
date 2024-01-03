<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // show views
    public function indexLogin()
    {
        $title = "Halaman Login";
        return view('auth.login', compact('title'));
    }
    public function indexRegister()
    {
        $title = "Halaman Register";
        return view('auth.register', compact('title'));
    }
    // logic and validasi
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect('/dashboard');
        }

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect()->back()->withInput($request->only('email'))
                ->withErrors(['email' => 'Email Anda tidak terdaftar']);
        }

        return redirect()->back()->withInput($request->only('email'))
            ->withErrors(['password' => 'Password Anda salah']);
    }
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);
        if (User::where('email', $request->email)->exists()) {
            return redirect()->back()->with('error', 'Maaf, email Anda sudah terdaftar.');
        }
        if ($request->password !== $request->password_confirmation) {
            return redirect()->back()->with('error', 'Password tidak sama.');
        }
        if (strlen($request->password) < 8) {
            return redirect()->back()->with('error', 'Password must be at least 8 characters long');
        }
        

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Registration successful! Please log in.');
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}

