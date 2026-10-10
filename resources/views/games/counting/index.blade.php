@extends('layout')

@section('title', 'Count the Objects')

@section('content')

<div class="counting-game">

    <h1>🔢 Count the Objects!</h1>

    <div class="counting-score">
        ⭐ <span id="counting-score">0</span> / 5
    </div>

    <div class="counting-question">
        How many are there?
    </div>

    <div id="objects-container" class="objects-container"></div>

    <div id="number-options" class="number-options"></div>

    <div id="counting-message" class="counting-message"></div>

    <div id="counting-finished"
         class="counting-finished"
         style="display: none;">

        <div class="finish-stars">⭐ ⭐ ⭐</div>

        <h2>🎉 Amazing!</h2>

        <p id="counting-final-message">
            Great counting!
        </p>

        <button id="counting-play-again"
                class="play-again-button">
            🔄 Play Again
        </button>

    </div>

</div>



@endsection