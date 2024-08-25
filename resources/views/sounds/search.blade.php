@extends('layouts.app')

@section('content')
    <h1>Search Results</h1>
    @if($sounds->isEmpty())
        <p>No sounds found.</p>
    @else
        <ul>
            @foreach($sounds as $sound)
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
    @endif
@endsection
