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

<script>
document.addEventListener('DOMContentLoaded', () => {
    const shapes = [
        { name: 'Circle', color: '#ffca55', figure: '<circle cx="50" cy="50" r="36"/>' },
        { name: 'Square', color: '#64b5f6', figure: '<rect x="14" y="14" width="72" height="72" rx="3"/>' },
        { name: 'Triangle', color: '#ff8a80', figure: '<polygon points="50,10 91,86 9,86"/>' },
        { name: 'Rectangle', color: '#81c784', figure: '<rect x="6" y="26" width="88" height="48" rx="3"/>' },
        { name: 'Star', color: '#ffd54f', figure: '<polygon points="50,6 61,37 94,37 68,57 78,91 50,71 22,91 32,57 6,37 39,37"/>' },
        { name: 'Heart', color: '#f48fb1', figure: '<path d="M50 88 C35 75 8 55 8 32 C8 7 39 6 50 27 C61 6 92 7 92 32 C92 55 65 75 50 88Z"/>' },
        { name: 'Oval', color: '#b39ddb', figure: '<ellipse cx="50" cy="50" rx="43" ry="29"/>' },
        { name: 'Diamond', color: '#80deea', figure: '<polygon points="50,6 92,50 50,94 8,50"/>' }
    ];

    const reviewColors = [
        { name: 'Red', hex: '#ef5350' },
        { name: 'Yellow', hex: '#ffd54f' },
        { name: 'Blue', hex: '#42a5f5' },
        { name: 'Green', hex: '#66bb6a' },
        { name: 'Purple', hex: '#ab47bc' },
        { name: 'Orange', hex: '#ffa726' },
        { name: 'Pink', hex: '#f48fb1' },
        { name: 'Turquoise', hex: '#26c6da' }
    ];

    const el = id => document.getElementById(id);
    const targetElement = el('shapes-target');
    const dropZone = el('shapes-drop-zone');
    const optionsElement = el('shapes-drag-options');
    const feedback = el('shapes-feedback');
    const transition = el('shapes-transition');
    const finished = el('shapes-finished');
    let stage = 'match';
    let round = 0;
    let deck = [];
    let target = null;
    let distractorShape = null;
    let otherColor = null;
    let locked = false;
    let nextTimer = null;
    let drag = null;

    function shuffle(items) {
        const result = [...items];
        for (let i = result.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [result[i], result[j]] = [result[j], result[i]];
        }
        return result;
    }

    function svg(shape, mode = 'full', white = false) {
        const fill = white ? '#ffffff' : shape.color;
        const stroke = white ? '#7e90a9' : '#ffffff';
        const clip = mode === 'left'
            ? '<clipPath id="half-left"><rect x="0" y="0" width="50" height="100"/></clipPath>'
            : mode === 'right'
                ? '<clipPath id="half-right"><rect x="50" y="0" width="50" height="100"/></clipPath>'
                : '';
        const clipAttribute = mode === 'full' ? '' : `clip-path="url(#half-${mode})"`;
        return `<svg viewBox="0 0 100 100" class="shapes-drag-svg" aria-hidden="true" xmlns="http://www.w3.org/2000/svg">
            <defs>${clip}</defs>
            <g ${clipAttribute} fill="${fill}" stroke="${stroke}" stroke-width="2.5" stroke-linejoin="round">${shape.figure}</g>
            ${mode === 'left' ? '<line x1="50" y1="5" x2="50" y2="95" stroke="#8a98ae" stroke-width="1.5" stroke-dasharray="4 4"/>' : ''}
        </svg>`;
    }

    function clearDrag() {
        if (drag?.ghost) drag.ghost.remove();
        if (drag?.button) drag.button.classList.remove('is-dragging');
        drag = null;
        dropZone.classList.remove('drag-over');
    }

    function newRound() {
        clearDrag();
        locked = false;
        feedback.textContent = '';
        target = { ...deck[round] };
        if (stage === 'puzzle') {
            const pickedColors = shuffle(reviewColors).slice(0, 2);
            target.color = pickedColors[0].hex;
            target.colorName = pickedColors[0].name;
            otherColor = pickedColors[1];
            distractorShape = shuffle(shapes.filter(shape => shape.name !== target.name))[0];
        }
        el('shapes-score').textContent = round;
        dropZone.classList.remove('is-correct');
        targetElement.innerHTML = stage === 'match'
            ? svg(target, 'full', true)
            : svg(target, 'left');
        el('shapes-instruction').textContent = stage === 'match'
            ? 'Drag the matching shape into the white shape!'
            : `Complete the ${target.colorName.toUpperCase()} ${target.name.toUpperCase()}!`;
        el('shapes-options-label').textContent = stage === 'match'
            ? 'Choose a shape and drag it up:'
            : 'Find the matching shape AND color:';

        const choices = stage === 'match'
            ? shuffle([target, ...shuffle(shapes.filter(shape => shape.name !== target.name)).slice(0, 3)])
            : shuffle([
                target,
                { ...target, color: otherColor.hex, colorName: otherColor.name },
                { ...distractorShape, color: target.color, colorName: target.colorName },
                { ...distractorShape, color: otherColor.hex, colorName: otherColor.name }
            ]);
        optionsElement.replaceChildren();

        choices.forEach(shape => {
            const button = document.createElement('button');
            button.type = 'button';
            button.className = 'shapes-drag-choice';
            const optionLabel = stage === 'match' ? shape.name : `${shape.colorName} ${shape.name}`;
            button.setAttribute('aria-label', optionLabel);
            button.title = optionLabel;
            button.innerHTML = svg(shape, stage === 'match' ? 'full' : 'right');
            button.addEventListener('pointerdown', event => beginDrag(event, button, shape));
            // Keyboard accessibility: focus a choice and press Enter/Space to place it.
            button.addEventListener('keydown', event => {
                if (event.key === 'Enter' || event.key === ' ') {
                    event.preventDefault();
                    checkAnswer(shape);
                }
            });
            optionsElement.appendChild(button);
        });
    }

    function beginDrag(event, button, shape) {
        if (locked || drag || event.button !== 0) return;
        event.preventDefault();
        const ghost = button.cloneNode(true);
        ghost.classList.add('shapes-drag-ghost');
        ghost.setAttribute('aria-hidden', 'true');
        document.body.appendChild(ghost);
        drag = { button, ghost, shape, pointerId: event.pointerId };
        button.classList.add('is-dragging');
        button.setPointerCapture(event.pointerId);
        moveGhost(event.clientX, event.clientY);

        const move = e => {
            if (!drag || e.pointerId !== drag.pointerId) return;
            moveGhost(e.clientX, e.clientY);
        };
        const end = e => {
            if (!drag || e.pointerId !== drag.pointerId) return;
            const chosen = drag.shape;
            const inside = isInsideDrop(e.clientX, e.clientY);
            button.removeEventListener('pointermove', move);
            button.removeEventListener('pointerup', end);
            button.removeEventListener('pointercancel', cancel);
            clearDrag();
            if (inside) checkAnswer(chosen);
        };
        const cancel = e => {
            if (!drag || e.pointerId !== drag.pointerId) return;
            button.removeEventListener('pointermove', move);
            button.removeEventListener('pointerup', end);
            button.removeEventListener('pointercancel', cancel);
            clearDrag();
        };
        button.addEventListener('pointermove', move);
        button.addEventListener('pointerup', end);
        button.addEventListener('pointercancel', cancel);
    }

    function isInsideDrop(x, y) {
        const rect = dropZone.getBoundingClientRect();
        return x >= rect.left && x <= rect.right && y >= rect.top && y <= rect.bottom;
    }

    function moveGhost(x, y) {
        if (!drag) return;
        drag.ghost.style.left = `${x}px`;
        drag.ghost.style.top = `${y}px`;
        dropZone.classList.toggle('drag-over', isInsideDrop(x, y));
    }

    function checkAnswer(shape) {
        if (locked) return;
        if (shape.name !== target.name || (stage === 'puzzle' && shape.color !== target.color)) {
            feedback.textContent = '💛 Try again!';
            dropZone.classList.add('is-wrong');
            setTimeout(() => dropZone.classList.remove('is-wrong'), 550);
            return;
        }
        locked = true;
        targetElement.innerHTML = svg(target, 'full');
        dropZone.classList.add('is-correct');
        feedback.textContent = stage === 'match' ? '⭐ Perfect match!' : '🧩 Puzzle complete!';
        optionsElement.querySelectorAll('button').forEach(button => button.disabled = true);
        round++;
        el('shapes-score').textContent = round;
        nextTimer = setTimeout(() => {
            if (round >= deck.length) endStage();
            else newRound();
        }, 1100);
    }

    function endStage() {
        el('shapes-instruction').hidden = true;
        dropZone.hidden = true;
        el('shapes-options-label').hidden = true;
        optionsElement.hidden = true;
        feedback.hidden = true;
        if (stage === 'match') transition.hidden = false;
        else finished.hidden = false;
    }

    function startStage(nextStage) {
        clearTimeout(nextTimer);
        clearDrag();
        stage = nextStage;
        round = 0;
        deck = shuffle(shapes);
        el('shapes-stage-label').textContent = stage === 'match'
            ? 'Part 1 · Match the Shape!'
            : 'Part 2 · Match the Shape & Color!';
        el('shapes-score').textContent = 0;
        el('shapes-total').textContent = deck.length;
        transition.hidden = true;
        finished.hidden = true;
        el('shapes-instruction').hidden = false;
        dropZone.hidden = false;
        el('shapes-options-label').hidden = false;
        optionsElement.hidden = false;
        feedback.hidden = false;
        newRound();
    }

    el('shapes-review-start').addEventListener('click', () => startStage('puzzle'));
    el('shapes-play-again').addEventListener('click', () => startStage('match'));
    startStage('match');
});
</script>
@endsection
