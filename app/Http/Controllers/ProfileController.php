<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
            $title = "Profile";
            $user = auth()->user();
            return view("profile", compact('title', 'user'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        $user->email = $request->input('email');
        if ($request->input('name')) {
            $user->name = $request->input('name');
        } else {
            return redirect()->back()->with('error', 'Name field cannot be empty');
        }
        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully');
    }

    public function updatePassword(Request $request)
    {
        $user = auth()->user();
        $newPassword = $request->input('new_password');
        $confirmPassword = $request->input('confirm_password');
    
        if (strlen($newPassword) < 8) {
            return redirect()->back()->with('error', 'Password must be at least 8 characters long');
        }
    
        if ($newPassword !== $confirmPassword) {
            return redirect()->back()->with('error', 'Passwords do not match');
        } else {
            $user->password = bcrypt($newPassword);
            $user->save();
            return redirect()->back()->with('success', 'Password updated successfully');
        }
    }
    

    public function profileImageUpdate(Request $request)
    {
        $user = auth()->user();

        if ($request->hasFile('profile_image')) {
            $imagePath = $request->file('profile_image')->store('public/profile_images');
            $user->profile_image_path = $imagePath;
            $user->save();
            return redirect()->back()->with('success', 'Profile image updated successfully');
        } else {
            return redirect()->back()->with('error', 'No file was uploaded');
        }
    }
}
