@extends('layouts.app')

@section('content')
    <h1>Sound Catalog</h1>
    <form action="{{ route('sounds.search') }}" method="GET">
        <input type="text" name="query" placeholder="Search for sounds">
        <button type="submit">Search</button>
    </form>

    @foreach($categories as $category)
        <h2>{{ $category->name }}</h2>
        <ul>
            @foreach($category->sounds as $sound)
                <li>
                    <h3>{{ $sound->name }}</h3>
                    <audio controls>
                        <source src="{{ asset('storage/sounds/' . $sound->path) }}" type="audio/mpeg">
                        Your browser does not support the audio element.
                    </audio>
                    <a href="{{ route('sounds.download', $sound->id) }}">Download</a>
                    <form action="{{ route('sounds.complain', $sound->id) }}" method="POST">
                        @csrf
                        <input type="text" name="complaint_type" placeholder="Complaint type">
                        <textarea name="details" placeholder="Details"></textarea>
                        <button type="submit">Complain</button>
                    </form>
                </li>
            @endforeach
        </ul>
    @endforeach
@endsection
