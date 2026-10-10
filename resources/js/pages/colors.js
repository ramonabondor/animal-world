// colors/index.blade.php
document.addEventListener('DOMContentLoaded', () => {
    if (!document.getElementById('colors-stage-label')) return;

    const colors = [
        { name: 'Red', hex: '#ef5350' },
        { name: 'Blue', hex: '#42a5f5' },
        { name: 'Yellow', hex: '#ffd54f' },
        { name: 'Green', hex: '#66bb6a' },
        { name: 'Orange', hex: '#ffa726' },
        { name: 'Purple', hex: '#ab47bc' },
        { name: 'Pink', hex: '#f48fb1' },
        { name: 'Brown', hex: '#8d6e63' },
        { name: 'Black', hex: '#30343b' },
        { name: 'White', hex: '#ffffff' },
        { name: 'Gray', hex: '#9e9e9e' },
        { name: 'Turquoise', hex: '#26c6da' },
        { name: 'Gold', hex: '#e4ae22' },
        { name: 'Lime', hex: '#a4d65e' }
    ];

    const findRounds = 8;
    const reviewRounds = 8;
    const stageLabel = document.getElementById('colors-stage-label');
    const scoreElement = document.getElementById('colors-score');
    const totalElement = document.getElementById('colors-total');
    const questionElement = document.getElementById('colors-question');
    const optionsElement = document.getElementById('colors-options');
    const messageElement = document.getElementById('colors-message');
    const transitionElement = document.getElementById('colors-transition');
    const finishedElement = document.getElementById('colors-finished');
    const reviewButton = document.getElementById('colors-review-start');
    const playAgainButton = document.getElementById('colors-play-again');

    let stage = 'find';
    let round = 0;
    let locked = false;
    let target = null;
    let deck = [];
    let nextRoundTimer = null;

    function speakColor(name) {
        if (!('speechSynthesis' in window)) {
            messageElement.textContent = 'Audio is not supported in this browser.';
            return;
        }

        window.speechSynthesis.cancel();
        const speech = new SpeechSynthesisUtterance(name);
        speech.lang = 'en-US';
        speech.rate = 0.8;
        speech.pitch = 1.05;
        window.speechSynthesis.speak(speech);
    }

    function shuffle(items) {
        const result = [...items];
        for (let i = result.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [result[i], result[j]] = [result[j], result[i]];
        }
        return result;
    }

    function makeDeck() {
        // Each stage uses 8 distinct colors, without repeating a target.
        return shuffle(colors).slice(0, stage === 'find' ? findRounds : reviewRounds);
    }

    function makeButton(color) {
        const button = document.createElement('button');
        button.type = 'button';
        button.className = 'color-choice';
        button.style.backgroundColor = color.hex;
        button.setAttribute('aria-label', color.name);

        // Both stages use color-only buttons, without visible names.
        const hiddenName = document.createElement('span');
        hiddenName.className = 'visually-hidden-color';
        hiddenName.textContent = color.name;
        button.appendChild(hiddenName);

        button.addEventListener('click', () => checkAnswer(color, button));
        return button;
    }

    function newRound() {
        locked = false;
        messageElement.textContent = '';
        target = deck[round];
        scoreElement.textContent = round;

        if (stage === 'find') {
            questionElement.textContent = `Find the ${target.name.toUpperCase()} color!`;
        } else {
            questionElement.replaceChildren();
            const listenButton = document.createElement('button');
            listenButton.type = 'button';
            listenButton.className = 'play-again-button';
            listenButton.textContent = '🔊 Listen Again';
            listenButton.setAttribute('aria-label', 'Listen to the color again');
            listenButton.addEventListener('click', () => speakColor(target.name));
            questionElement.appendChild(listenButton);
        }

        const others = shuffle(colors.filter(c => c.name !== target.name)).slice(0, 3);
        const choices = shuffle([target, ...others]);
        optionsElement.replaceChildren(...choices.map(makeButton));

        if (stage === 'review') {
            speakColor(target.name);
        }
    }

    function checkAnswer(color, button) {
        if (locked) return;

        if (color.name !== target.name) {
            messageElement.textContent = '💛 Try again!';
            button.classList.add('wrong');
            setTimeout(() => button.classList.remove('wrong'), 600);
            return;
        }

        locked = true;
        button.classList.add('correct');
        messageElement.textContent = '⭐ Great job! ⭐';
        optionsElement.querySelectorAll('button').forEach(b => b.disabled = true);
        round++;
        scoreElement.textContent = round;

        nextRoundTimer = setTimeout(() => {
            const total = stage === 'find' ? findRounds : reviewRounds;
            if (round >= total) {
                showStageEnd();
            } else {
                newRound();
            }
        }, 950);
    }

    function showStageEnd() {
        if ('speechSynthesis' in window) window.speechSynthesis.cancel();
        questionElement.hidden = true;
        optionsElement.hidden = true;
        messageElement.hidden = true;
        if (stage === 'find') {
            transitionElement.hidden = false;
        } else {
            finishedElement.hidden = false;
        }
    }

    function startStage(nextStage) {
        clearTimeout(nextRoundTimer);
        if ('speechSynthesis' in window) window.speechSynthesis.cancel();
        stage = nextStage;
        round = 0;
        locked = false;
        deck = makeDeck();
        stageLabel.textContent = stage === 'find'
            ? 'Part 1 · Find the Color!'
            : "Part 2 · Let's Review the Colors!";
        totalElement.textContent = deck.length;
        scoreElement.textContent = '0';
        transitionElement.hidden = true;
        finishedElement.hidden = true;
        questionElement.hidden = false;
        optionsElement.hidden = false;
        messageElement.hidden = false;
        newRound();
    }

    reviewButton.addEventListener('click', () => startStage('review'));
    playAgainButton.addEventListener('click', () => startStage('find'));
    startStage('find');
});
