<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            "username" => "required",
            "password" => "required"
        ]);

        $user = User::where('username', $request->username)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            $user->last_login = now()->format("Y-m-d H:i:s");
            $user->save();

            Auth::login($user);
            return redirect('/dashboard');
        }
        return back()->with('fail', 'Username or Password Invalid');
    }

    public function loginView()
    {
        return view('pages.auth.login');
    }

    public function registerView()
    {
        return view('pages.auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            "name" => "required",
            "email" => "required",
            "address" => "required",
            "phone" => "required",
            "password" => "required",
        ]);

        $user = new User();
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect('/login');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }

    public function profile()
    {
        return view('profile');
    }

    public function updatePassword(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $currentPassword = $request->currentPassword;
        $newPassword = $request->newPassword;

        if (Hash::check($currentPassword, $user->password)) {
            $user->password = Hash::make($newPassword);
            $user->save();
            return redirect('/profile')->with('success', 'Password has been updated');
        }

        return redirect('/profile')->with('fail', 'Current password is incorrect');
    }

    public function updateProfile(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->address = $request->address;
        $user->phone = $request->phone;
        $user->save();
        return redirect('/profile')->with('success', 'Profile has been updated');
    }
}
