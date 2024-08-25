@extends('layouts.app')

@section('content')
    <h1>Admin Dashboard</h1>
    <h2>Manage Categories</h2>
    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        <input type="text" name="name" placeholder="Category Name" required>
        <button type="submit">Add Category</button>
    </form>

    <h2>Pending Sounds</h2>
    <ul>
        @foreach($pendingSounds as $sound)
            <li>
                <h3>{{ $sound->name }}</h3>
                <form action="{{ route('sounds.approve', $sound->id) }}" method="POST">
                    @csrf
                    <button type="submit">Approve</button>
                </form>
                <form action="{{ route('sounds.delete', $sound->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>

    <h2>Manage Users</h2>
    <!-- Implement user management here -->
@endsection
