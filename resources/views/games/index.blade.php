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

        <div class="game-card catch-game coming-soon">

            <div class="game-icon">🎈</div>

            <h2>Catch the Object</h2>

            <p>
                Catch the objects as they appear!
            </p>

            <span>Coming soon</span>
        </div>


        <div class="game-card colors-game coming-soon">

            <div class="game-icon">🎨</div>

            <h2>Colors</h2>

            <p>
                Learn and match the colors!
            </p>

            <span>Coming soon</span>
        </div>


        <div class="game-card shapes-game coming-soon">

            <div class="game-icon">🔷</div>

            <h2>Shapes</h2>

            <p>
                Discover circles, squares and more!
            </p>

            <span>Coming soon</span>
        </div>


        <div class="game-card memory-game coming-soon">

            <div class="game-icon">🧠</div>

            <h2>Memory</h2>

            <p>
                Find the matching pairs!
            </p>

            <span>Coming soon</span>
        </div>

    </div>

</div>

@endsection