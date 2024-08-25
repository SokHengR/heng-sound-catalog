@extends('layouts.app')

@section('content')
    <h1>Upload New Sound</h1>
    <form action="{{ route('sounds.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="text" name="name" placeholder="Sound Name" required>
        <textarea name="description" placeholder="Description" required></textarea>
        <select name="category_id" required>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
        <input type="file" name="sound" accept="audio/*" required>
        <button type="submit">Upload</button>
    </form>
@endsection
