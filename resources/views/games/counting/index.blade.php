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

<script>



    const objects = [
        { emoji: '🍎', name: 'apples' },
        { emoji: '⭐', name: 'stars' },
        { emoji: '🎈', name: 'balloons' },
        { emoji: '🍓', name: 'strawberries' },
        { emoji: '🐥', name: 'chicks' },
        { emoji: '🌸', name: 'flowers' }
    ];

    const totalRounds = 5;

    let previousObject = null;
    let previousCount = null;
    let roundLocked = false;
    let score = 0;
    let round = 0;
    let correctAnswer = 0;

    const scoreElement =
        document.getElementById('counting-score');

    const questionElement =
        document.querySelector('.counting-question');

    const objectsContainer =
        document.getElementById('objects-container');

    const numberOptions =
        document.getElementById('number-options');

    const message =
        document.getElementById('counting-message');

    const finished =
        document.getElementById('counting-finished');

    const finalMessage =
        document.getElementById('counting-final-message');

    const playAgain =
        document.getElementById('counting-play-again');


    function randomNumber(min, max) {
        return Math.floor(
            Math.random() * (max - min + 1)
        ) + min;
    }


    function shuffle(array) {
        const copy = [...array];

        for (let i = copy.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));

            [copy[i], copy[j]] =
                [copy[j], copy[i]];
        }

        return copy;
    }


    function createAnswers(correct) {
        const answers = new Set();

        answers.add(correct);

        while (answers.size < 3) {
            answers.add(randomNumber(1, 10));
        }

        return shuffle([...answers]);
    }

function newCountingRound() {
    roundLocked = false;
    message.textContent = '';

    let object;

    do {
        object = objects[randomNumber(0, objects.length - 1)];
    } while (
        previousObject &&
        object.name === previousObject.name
    );

    do {
        correctAnswer = randomNumber(1, 10);
    } while (correctAnswer === previousCount);

    previousObject = object;
    previousCount = correctAnswer;

    questionElement.textContent =
        `How many ${object.name}?`;

    objectsContainer.innerHTML = '';

    for (let i = 0; i < correctAnswer; i++) {
    const item = document.createElement('span');

    item.className = 'counting-object';
    item.textContent = object.emoji;

    // Fiecare obiect apare puțin după cel anterior
    item.style.animationDelay = `${i * 0.08}s`;

    objectsContainer.appendChild(item);
}

    numberOptions.innerHTML = '';

    const answers = createAnswers(correctAnswer);

    answers.forEach(answer => {
        const button = document.createElement('button');

        button.className = 'number-button';
        button.textContent = answer;

        button.addEventListener('click', () => {
            checkCountingAnswer(answer, button);
        });

        numberOptions.appendChild(button);
    });
}


    function checkCountingAnswer(answer, button) {
        if (roundLocked) return;

            if (answer === correctAnswer) {
            roundLocked = true;

            message.textContent = '⭐ Great job! ⭐';
            button.classList.add('correct');

            score++;
            round++;

            scoreElement.textContent = score;

            document
                .querySelectorAll('.number-button')
                .forEach(btn => btn.disabled = true);

            if (round >= totalRounds) {
                setTimeout(finishCountingGame, 1000);
            } else {
                setTimeout(newCountingRound, 1000);
            }
        } else {

            message.textContent = '💛 Try again!';

            button.classList.add('wrong');

            setTimeout(() => {
                button.classList.remove('wrong');
            }, 600);
        }
    }


    function finishCountingGame() {
        questionElement.style.display = 'none';
        objectsContainer.style.display = 'none';
        numberOptions.style.display = 'none';
        message.style.display = 'none';

        finished.style.display = 'block';

        finalMessage.textContent =
            `You counted ${score} correctly! ⭐`;
    }


    function restartCountingGame() {
        score = 0;
        round = 0;

        scoreElement.textContent = '0';

        questionElement.style.display = 'block';
        objectsContainer.style.display = 'flex';
        numberOptions.style.display = 'flex';
        message.style.display = 'block';

        finished.style.display = 'none';

        newCountingRound();
    }


    playAgain.addEventListener(
        'click',
        restartCountingGame
    );

    newCountingRound();
</script>

@endsection