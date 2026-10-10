@extends('layout')

@section('title', 'Memory Game')

@section('content')
<div class="memory-page"
     data-animal-dog="{{ asset('assets/images/dog.jpg') }}"
     data-animal-cat="{{ asset('assets/images/cat.jpg') }}"
     data-animal-lion="{{ asset('assets/images/lion.jpg') }}">
    <h1>🧠 Memory Adventure!</h1>
    <p class="memory-subtitle" id="memory-instruction">Find the matching pairs!</p>

    <div class="memory-stats">
        <div>🎮 Level: <span id="memory-level">1</span> / 3</div>
        <div>⭐ Pairs: <span id="memory-pairs">0</span> / <span id="memory-total">3</span></div>
        <div>👆 Moves: <span id="memory-moves">0</span></div>
    </div>

    <div id="memory-board" class="memory-board" aria-label="Memory cards"></div>
    <p id="memory-message" class="memory-message" aria-live="polite"></p>

    <div id="memory-overlay" class="memory-panel">
        <h2 id="memory-panel-title">Ready to play? 🎉</h2>
        <p id="memory-panel-text">Find the matching animal pairs!</p>
        <button type="button" id="memory-action" class="memory-action">▶️ Start Game</button>
    </div>
</div>

@endsection
