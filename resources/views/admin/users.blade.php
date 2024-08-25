@extends('layouts.app')

@section('content')
    <h1>Manage Users</h1>
    <ul>
        @foreach($users as $user)
            <li>
                <h3>{{ $user->name }}</h3>
                <form action="{{ route('users.ban', $user->id) }}" method="POST">
                    @csrf
                    <button type="submit">Ban User</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection
