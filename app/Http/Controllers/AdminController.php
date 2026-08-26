<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    // GET /administrators -> raw PHP এর admin.php
    public function index(Request $request)
    {
        $query = User::where('role', 'admin');

        if ($request->filled('keyword')) {
            $query->where('username', 'like', '%' . $request->keyword . '%');
        }

        $admins = $query->orderBy('id', 'desc')->paginate(15);

        return view('admins.index', compact('admins'));
    }

    // GET /administrators/create -> raw PHP এর admin-add.php (ফর্ম)
    public function create()
    {
        return view('admins.create');
    }

    // POST /administrators -> raw PHP এর admin-add.php (submit লজিক)
    public function store(Request $request)
    {
        $request->validate([
            'username'    => 'required|string|min:3|unique:users,username',
            'full_name'   => 'required|string|max:255',
            'email'       => 'required|email|unique:users,email',
            'password'    => 'required|string|min:6|confirmed',
        ], [
            'username.min' => 'Username is too short!',
            'username.unique' => 'Username already exists!',
            'email.unique' => 'Email already exists!',
        ]);

        User::create([
            'name'     => $request->full_name,
            'username' => $request->username,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'admin',
        ]);

        return redirect()->route('admins.index')->with('success', 'Admin added successfully...');
    }

    // GET /administrators/{admin}/edit -> raw PHP এর admin-edit.php (ফর্ম)
    public function edit(User $admin)
    {
        return view('admins.edit', compact('admin'));
    }

    // PUT /administrators/{admin} -> raw PHP এর admin-edit.php (update লজিক)
    public function update(Request $request, User $admin)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'email'     => ['required', 'email', Rule::unique('users', 'email')->ignore($admin->id)],
            'password'  => 'nullable|string|min:6|confirmed',
        ]);

        $data = [
            'name'  => $request->full_name,
            'email' => $request->email,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $admin->update($data);

        return redirect()->route('admins.edit', $admin->id)->with('success', 'Changes Saved...');
    }

    // GET /administrators/{admin}/delete -> raw PHP এর admin-delete.php
    public function destroy(User $admin)
    {
        if ($admin->id === 1) {
            return redirect()->route('admins.index')->with('error', 'The primary admin cannot be deleted!');
        }

        $admin->delete();

        return redirect()->route('admins.index')->with('success', 'Admin deleted successfully...');
    }
//admin deleted option


    // public function destroy(User $admin)
    // {
    //     $adminCount = User::where('role', 'admin')->count();

    //     if ($adminCount <= 1) {
    //         return redirect()->route('admins.index')->with('error', 'At least one admin must remain — cannot delete the last admin!');
    //     }

    //     if ($admin->id === auth()->id()) {
    //         return redirect()->route('admins.index')->with('error', 'You cannot delete your own account while logged in!');
    //     }

    //     $admin->delete();

    //     return redirect()->route('admins.index')->with('success', 'Admin deleted successfully...');
    // }

}
