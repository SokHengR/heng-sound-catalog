<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sound Catalog</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <header>
        <nav>
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="/sound/index">Catalog</a></li>
                @auth
                    <li><a href="{{ route('sounds.upload') }}">Upload Sound</a></li>
                    @if(auth()->user()->is_admin)
                        <li><a href="{{ route('admin.dashboard') }}">Admin Dashboard</a></li>
                    @endif
                @endauth
                @guest
                    <li><a href="/login">Login</a></li>
                    <li><a href="/register">Register</a></li>
                @endguest
            </ul>
        </nav>
    </header>
    <main>
        @yield('content')
    </main>
    <footer>
        <p>&copy; {{ date('Y') }} Heng Sound Catalog</p>
    </footer>
</body>
</html>