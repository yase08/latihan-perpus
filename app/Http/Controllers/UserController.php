<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->get();
        $roles = $users->map(function ($user) {
            return $user->roles->pluck('name')->implode(', ');
        });

        return view('pages.user.index', compact('users', 'roles'));
    }

    public function create()
    {
        return view('pages.user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'email' => 'required',
            'password' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $avatarName = time() . '.' . $request->avatar->extension();

        $request->avatar->move(public_path('images'), $avatarName);

        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'phone' => $request->phone,
            'address' => $request->address,
            'avatar' => $avatarName
        ]);

        if ($request->role == 'admin') {
            $user->assignRole('admin');
        }

        $user->assignRole("user");

        return redirect('/dashboard/user')->with('success', 'User created successfully');
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('pages.user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            "username" => "required",
            'email' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $user = User::find($id);

        $avatarName = time() . '.' . $request->avatar->getClientOriginalExtension();

        $request->avatar->move(public_path('images'), $avatarName);

        $user->update([
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'avatar' => $avatarName
        ]);

        return redirect('/dashboard/user')->with('success', 'User updated successfully');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return back()->with('success', 'User deleted successfully');
    }
}
