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

<script>
document.addEventListener('DOMContentLoaded', () => {

    const colors = [
        { name: 'Red', hex: '#ef5350', emoji: '❤️' },
        { name: 'Blue', hex: '#42a5f5', emoji: '💙' },
        { name: 'Yellow', hex: '#ffd54f', emoji: '💛' },
        { name: 'Green', hex: '#66bb6a', emoji: '💚' },
        { name: 'Orange', hex: '#ffa726', emoji: '🧡' },
        { name: 'Purple', hex: '#ab47bc', emoji: '💜' },
        { name: 'Pink', hex: '#f48fb1', emoji: '🩷' },
        { name: 'Brown', hex: '#8d6e63', emoji: '🤎' }
    ];

    const totalRounds = 5;

    const scoreElement = document.getElementById('colors-score');
    const questionElement = document.getElementById('colors-question');
    const optionsElement = document.getElementById('colors-options');
    const messageElement = document.getElementById('colors-message');
    const finishedElement = document.getElementById('colors-finished');
    const playAgainButton = document.getElementById('colors-play-again');

    let score = 0;
    let targetColor = null;
    let previousColor = null;
    let roundLocked = false;

    function shuffle(array) {
        return [...array].sort(() => Math.random() - 0.5);
    }

    function newRound() {
        roundLocked = false;
        messageElement.textContent = '';

        let availableColors = colors.filter(
            color => color.name !== previousColor
        );

        targetColor = shuffle(availableColors)[0];
        previousColor = targetColor.name;

        questionElement.textContent =
            `Find the ${targetColor.name.toUpperCase()} color! ${targetColor.emoji}`;

        const otherColors = shuffle(
            colors.filter(color => color.name !== targetColor.name)
        ).slice(0, 3);

        const options = shuffle([targetColor, ...otherColors]);

        optionsElement.innerHTML = '';

        options.forEach(color => {
            const button = document.createElement('button');

            button.type = 'button';
            button.className = 'color-choice';
            button.style.backgroundColor = color.hex;
            button.setAttribute('aria-label', color.name);

            const label = document.createElement('span');
            label.textContent = color.name;

            button.appendChild(label);

            button.addEventListener('click', () => {
                checkAnswer(color, button);
            });

            optionsElement.appendChild(button);
        });
    }

    function checkAnswer(color, button) {
        if (roundLocked) return;

        if (color.name === targetColor.name) {
            roundLocked = true;

            button.classList.add('correct');
            messageElement.textContent = '⭐ Great job! ⭐';

            score++;
            scoreElement.textContent = score;

            document.querySelectorAll('.color-choice')
                .forEach(choice => choice.disabled = true);

            if (score >= totalRounds) {
                setTimeout(finishGame, 1100);
            } else {
                setTimeout(newRound, 1100);
            }
        } else {
            messageElement.textContent = '💛 Try again!';
            button.classList.add('wrong');

            setTimeout(() => {
                button.classList.remove('wrong');
            }, 600);
        }
    }

    function finishGame() {
        questionElement.style.display = 'none';
        optionsElement.style.display = 'none';
        messageElement.style.display = 'none';
        finishedElement.style.display = 'block';
    }

    function restartGame() {
        score = 0;
        previousColor = null;

        scoreElement.textContent = '0';

        questionElement.style.display = 'block';
        optionsElement.style.display = 'grid';
        messageElement.style.display = 'block';
        finishedElement.style.display = 'none';

        newRound();
    }

    playAgainButton.addEventListener('click', restartGame);

    newRound();
});
</script>

@endsection