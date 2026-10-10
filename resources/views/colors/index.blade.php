@extends('layout')

@section('title', 'Colors Game')

@section('content')
<div class="colors-game-page">
    <h1>🎨 Color Adventure!</h1>
    <p class="colors-stage-label" id="colors-stage-label">Part 1 · Find the Color!</p>
    <div class="colors-score">⭐ <span id="colors-score">0</span> / <span id="colors-total">8</span></div>
    <div id="colors-question" class="colors-question" aria-live="polite"></div>
    <div id="colors-options" class="colors-options"></div>
    <div id="colors-message" class="colors-message" aria-live="polite"></div>

    <div id="colors-transition" class="colors-finished" hidden>
        <div class="finish-stars">⭐ ⭐ ⭐</div>
        <h2>🎉 Great job!</h2>
        <p>You found all the colors!</p>
        <h3>🌈 Let's Review the Colors!</h3>
        <p>Listen carefully and tap the correct color!</p>
        <button id="colors-review-start" type="button" class="play-again-button">▶️ Start Review</button>
    </div>

    <div id="colors-finished" class="colors-finished" hidden>
        <div class="finish-stars">🌈 ⭐ 🌈</div>
        <h2>🏆 Amazing!</h2>
        <p>You know your colors!</p>
        <button id="colors-play-again" type="button" class="play-again-button">🔄 Play Again</button>
    </div>
</div>


@endsection
