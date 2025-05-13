<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login');  // This is the login view
    }

    // public function login(Request $request)
    // {
    //     // Validate input fields
    //     $request->validate([
    //         'username' => 'required|string',
    //         'password' => 'required|string',
    //     ]);

    //     // Check if user exists
    //     $user = User::where('username', $request->username)->first();

    //     if ($user && Hash::check($request->password, $user->password)) {
    //         // If credentials are correct, store user session data
    //         session(['user_id' => $user->id_user, 'role' => $user->role]);

    //         // Redirect user based on role
    //         if ($user->role === 'admin') {
    //             return redirect('/admin/index');
    //         } elseif ($user->role === 'komunitas') {
    //             return redirect('/');  // Redirect to komunitas index
    //         }
    //     }

    //     // If login fails
    //     return back()->with('error', 'Username or password is incorrect!');
    // }

    public function login(Request $request)
{
    $request->validate([
        'username' => 'required|string',
        'password' => 'required|string',
    ]);

    // Ambil kredensial
    $credentials = $request->only('username', 'password');

    if (Auth::attempt($credentials)) {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return redirect('/admin/index');
        } elseif ($user->role === 'komunitas') {
            return redirect('/');
        }
    }

    return back()->with('error', 'Username atau password salah!');
}


    public function logout()
    {
        // Clear session data and logout
        session()->flush();
        return redirect('/login');
    }
}