@extends('layouts.head')

@section('content')
    @if($user->role === 'admin')
        @include('components.admin.dashboard')
    @else
        <h1>halaman users</h1>
    @endif
@endsection