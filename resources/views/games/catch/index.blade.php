@extends('layout')

@section('title', 'Catch the Objects')

@section('content')

<div class="catch-game-page">

    <h1>🎈 Catch the Objects!</h1>

    <p class="catch-intro" id="catch-instruction">
        Catch the Star! ⭐
    </p>

    <div class="catch-info">
    <div>🎮 Level: <span id="catch-level">1</span> / 6</div>
    <div>⭐ Score: <span id="catch-score">0</span> / <span id="catch-goal">5</span></div>
    <div>⏱️ Time: <span id="catch-time">30</span>s</div>
</div>
<div id="catch-feedback" class="catch-feedback" aria-live="polite"></div>

    <div id="catch-area" class="catch-area">

        <div id="catch-start-screen" class="catch-overlay">
            <h2>Ready to play? 🎉</h2>
            <p id="catch-start-instruction">Catch only the Stars! ⭐</p>
            <button id="catch-start" class="catch-action-button">
                ▶️ Start Game
            </button>
        </div>

        <div id="catch-finish-screen" class="catch-overlay" style="display:none;">
            <h2 id="catch-finish-title">🌟 Level Complete!</h2>
            <p id="catch-final-score"></p>
            <button id="catch-next" class="catch-action-button">
                ➡️ Next Level
            </button>
        </div>

    </div>

</div>



@endsection