@extends('layout')

@section('title', 'Animal Game')

@section('content')

<div class="game-container">

    <h1>🧩 Find the Animal!</h1>

    <div class="score">
        ⭐ <span id="score">0</span> / 5
    </div>

    <div id="message" class="game-message"></div>

    <div class="question">
        Find the
        <strong id="target-name">...</strong>!
    </div>

    <div id="game-animals" class="game-animals"></div>

        <div id="game-finished" class="game-finished" style="display: none;">

    <div class="finish-stars">
        ⭐ ⭐ ⭐
    </div>

    <h2>🎉 Amazing!</h2>

    <p id="final-message">
        Great job!
    </p>

    <button id="play-again" class="play-again-button">
        🔄 Play Again
    </button>

</div>
</div>

<script type="application/json" id="animal-game-data">{!! json_encode(
    $animals->map(function ($animal) {
        return [
            'name' => $animal->name,
            'image' => asset('assets/images/' . $animal->image),
            'sound' => asset('assets/sounds/' . $animal->sound),
        ];
    })->values()
) !!}</script>

@endsection