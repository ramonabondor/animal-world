@extends('layout')

@section('title', 'Colors Game')

@section('content')

<div class="colors-game-page">
    <h1>🎨 Find the Color!</h1>

    <div class="colors-score">
        ⭐ <span id="colors-score">0</span> / 5
    </div>

    <div id="colors-question" class="colors-question">
        Find the color!
    </div>

    <div id="colors-options" class="colors-options"></div>

    <div id="colors-message" class="colors-message" aria-live="polite"></div>

    <div id="colors-finished" class="colors-finished" style="display:none;">
        <div class="finish-stars">⭐ ⭐ ⭐</div>
        <h2>🎉 Amazing!</h2>
        <p>You found all the colors!</p>
        <button id="colors-play-again" class="play-again-button">
            🔄 Play Again
        </button>
    </div>
</div>



@endsection