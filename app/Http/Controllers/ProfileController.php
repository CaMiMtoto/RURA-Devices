<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('admin.users.profile', compact('user'));
    }

    public function changePasswordView()
    {
        $user = auth()->user();
        return view('admin.users.change_password', compact('user'));
    }

    public function changePassword()
    {
        $data = request()->validate([
            'current_password' => ['required', 'string'],
            'new_password' => ['required', 'string', 'min:8'],
            'confirm_password' => ['required', 'string', 'min:8', 'same:new_password'],
        ]);

        $user = auth()->user();
        if (!Hash::check($data['current_password'], $user->password)) {
            return back()->withErrors(['current_password' => 'The provided password does not match your current password.']);
        }
        $user->password = Hash::make($data['new_password']);
        $user->save();
        return redirect()->route('admin.system.profile.index')->with('success', 'Password changed successfully.');
    }
}
