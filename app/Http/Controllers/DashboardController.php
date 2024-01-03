<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $title = "Dashboard";
        $user = auth()->user();
        $users = User::paginate(5);
        $totalUsers = $users->total();

        return view("dashboard", compact('title', 'user', 'users', 'totalUsers'));
    }
}
