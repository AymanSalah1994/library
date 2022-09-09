<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;


class AuthController extends Controller
{
    //
    # code...
    public function register()
    {
        return view('auth/register');
    }

    public function handleRegister(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'password' => 'required|string|max:50|min:5'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        Auth::login($user);
        return redirect(route('books.all'));
    }

    public function login()
    {
        return view('auth/login');
    }
    public function handleLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:100',
            'password' => 'required|string|max:50|min:5'
        ]);


        $is_login = Auth::attempt(['email' => $request->email, 'password' => $request->password]);

        if (!$is_login) {
            return back();
        } else {
            return redirect(route('books.all'));
        }
    }

    public function logout()
    {
        Auth::logout();
        return back();
    }

    public function redirect()
    {
        return Socialite::driver('github')->redirect();
    }

    public function callback()
    {
        $user = Socialite::driver('github')->user();
        $email = $user->email;
        $db_user  = User::where('email', $email)->first();
        if ($db_user) {
            Auth::login($db_user);
            return redirect(route('books.all'));
        } else {
            $new_user = User::create([
                'name' => $user->name,
                'email' => $user->email,
                'password' => Hash::make($user->id),
                'oauth_token' => $user->token
            ]);
            Auth::login($new_user);
            return redirect(route('books.all'));
        }
        // dd($user);
    }
}
