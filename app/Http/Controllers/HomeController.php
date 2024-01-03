<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        $title = "Home";
        $user = auth()->user();
        $users = User::paginate(5);
        return view('welcome', compact('title', 'user', 'users'));
    }
}
