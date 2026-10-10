@extends('layout')

@section('title', 'Games')

@section('content')

<div class="games-hub">

    <h1>🎮 Let's Play!</h1>

    <p class="games-intro">
        Choose a game and have fun learning!
    </p>

    <div class="games-grid">

        <a href="{{ route('games.animals') }}"
           class="game-card animals-game">

            <div class="game-icon">🐶</div>

            <h2>Find the Animal</h2>

            <p>
                Can you find the correct animal?
            </p>
        </a>

            <a href="{{ route('games.counting') }}"
   class="game-card counting-game">

    <div class="game-icon">🔢</div>

    <h2>Count the Objects</h2>

    <p>
        Count the objects and choose the right number!
    </p>

</a>

       <a href="{{ route('games.catch') }}" class="game-card catch-game">
    <div class="game-icon">🎈</div>
    <h2>Catch the Objects</h2>
    <p>Catch objects and collect points!</p>
</a>


        <a href="{{ route('games.colors') }}" class="game-card colors-game">
    <div class="game-icon">🎨</div>
    <h2>Colors</h2>
    <p>Find the correct color!</p>
</a>

<a href="{{ route('games.shapes') }}" class="game-card shapes-game">
    <div class="game-icon">🔷</div>
    <h2>Shapes</h2>
    <p>Learn and recognize shapes!</p>
</a>

        <a href="{{ route('games.memory') }}" class="game-card memory-game">
    <div class="game-icon">🧠</div>
    <h2>Memory</h2>
    <p>Find the matching pairs!</p>
</a>

    </div>

</div>

@endsection