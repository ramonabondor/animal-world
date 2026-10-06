<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Animal World' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@600;700;800;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body>
    <div class="app-shell">
        <header class="topbar">
            <a class="icon-button" href="{{ route('home') }}" aria-label="Home">🏠</a>
            <a class="brand" href="{{ route('home') }}">Animal World <span>🐾</span></a>
            <nav class="nav">
                <a href="{{ route('animals.index') }}">🐾 Animals</a>
                <a href="{{ route('colors') }}">🎨 Colors</a>
                <a href="{{ route('games.index') }}">🧩 Game</a>
            </nav>
        </header>

        <main class="container">@yield('content')</main>

        <footer class="footer">Made for little learners 💛</footer>
    </div>
</body>
</html>
