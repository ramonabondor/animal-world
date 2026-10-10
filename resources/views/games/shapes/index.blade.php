@extends('layout')

@section('title', 'Shapes Game')

@section('content')
<div class="shapes-drag-page">
    <h1>🔷 Shape Adventure!</h1>
    <p id="shapes-stage-label" class="shapes-drag-stage">Part 1 · Match the Shape!</p>
    <div class="shapes-drag-score">⭐ <span id="shapes-score">0</span> / <span id="shapes-total">8</span></div>
    <p id="shapes-instruction" class="shapes-drag-instruction">Drag the matching shape into the white shape!</p>

    <div id="shapes-drop-zone" class="shapes-drop-zone" aria-label="Drop the correct shape here">
        <div id="shapes-target" class="shapes-target"></div>
        <span class="shapes-drop-hint">⬆️ Drop here</span>
    </div>

    <p id="shapes-options-label" class="shapes-options-label">Choose a shape and drag it up:</p>
    <div id="shapes-drag-options" class="shapes-drag-options"></div>
    <p id="shapes-feedback" class="shapes-drag-feedback" aria-live="polite"></p>

    <div id="shapes-transition" class="shapes-drag-overlay" hidden>
        <h2>🎉 Great job!</h2>
        <p>You matched all the shapes!</p>
        <h3>🧩 Match the Shape &amp; Color!</h3>
        <p>Find the missing half with the matching shape and color.</p>
        <button id="shapes-review-start" class="shapes-drag-action" type="button">▶️ Start Puzzle</button>
    </div>

    <div id="shapes-finished" class="shapes-drag-overlay" hidden>
        <h2>🏆 Amazing!</h2>
        <p>You completed all the shape puzzles!</p>
        <button id="shapes-play-again" class="shapes-drag-action" type="button">🔄 Play Again</button>
    </div>
</div>


@endsection
