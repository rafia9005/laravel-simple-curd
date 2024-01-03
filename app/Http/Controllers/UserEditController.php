<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserEditController extends Controller
{

    public function updateUser(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required|string|max:255',
        ]);

        $user = User::find($id);

        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'role' => $request->input('role'),
        ]);

        return redirect()->route('dashboard')->with('success', 'User updated successfully');
    }

    public function deleteUser($id)
    {
        User::find($id)->delete();

        return redirect()->route('dashboard')->with('success', 'User deleted successfully');
    }
}
