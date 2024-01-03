@extends('layouts.home')

@section('content')
    @if (!auth()->check())
        <a href="/login"
            class="relative flex h-9 w-full items-center justify-center px-4 before:absolute before:inset-0 before:rounded-full before:bg-primary before:transition before:duration-300 hover:before:scale-105 active:duration-75 active:before:scale-95 sm:w-max astro-UY3JLCBK">
            <span class="relative text-sm font-semibold text-white astro-UY3JLCBK">Login</span>
        </a>
    @else
        <div class="relative">
            <a href="#" id="profile-menu-trigger">
                @if ($user->profile_image_path)
                    <img src="{{ Storage::url($user->profile_image_path) }}" alt="user-avatar" width="35" height="35"
                        class="rounded-full" />
                @else
                    <img src="./assets/images/profile-default.png" alt="default-avatar" width="35" height="35"
                        class="rounded-full" />
                @endif
            </a>
            <div id="profile-menu" class="hidden absolute right-0 mt-2 bg-white rounded-lg shadow-lg">
                <a href="/dashboard" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Dashboard</a>
                <a href="/profile" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                <a href="/logout" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">Log
                    Out</a>
            </div>
        </div>
    @endif
@endsection
