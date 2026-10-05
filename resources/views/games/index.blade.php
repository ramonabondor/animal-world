@extends('layout')

@section('title', 'Animal Game')

@section('content')

<div class="game-container">

    <h1>🧩 Find the Animal!</h1>

    <div class="score">
        ⭐ <span id="score">0</span> / 5
    </div>

    <div class="question">
        Find the
        <strong id="target-name">...</strong>!
    </div>

    <button id="listen-button" class="listen-button">
        🔊 Listen
    </button>

    <div id="game-animals" class="game-animals"></div>

    <div id="message" class="game-message"></div>
        <div id="game-finished" class="game-finished" style="display: none;">

    <div class="finish-stars">
        ⭐ ⭐ ⭐
    </div>

    <h2>🎉 Amazing!</h2>

    <p id="final-message">
        Great job!
    </p>

    <button id="play-again" class="play-again-button">
        🔄 Play Again
    </button>

</div>
</div>

<script>
const animals = {!! json_encode(
    $animals->map(function ($animal) {
        return [
            'name' => $animal->name,
            'image' => asset('assets/images/' . $animal->image),
            'sound' => asset('assets/sounds/' . $animal->sound),
        ];
    })->values()
) !!};

let targetAnimal = null;
let previousAnimal = null;

let score = 0;
let round = 0;

const totalRounds = 5;

let roundLocked = false;

const scoreElement =
    document.getElementById('score');

const targetName =
    document.getElementById('target-name');

const animalsContainer =
    document.getElementById('game-animals');

const message =
    document.getElementById('message');

const listenButton =
    document.getElementById('listen-button');

const gameFinished =
    document.getElementById('game-finished');

const finalMessage =
    document.getElementById('final-message');

const playAgainButton =
    document.getElementById('play-again');


function getRandomAnimal() {

    let animal;

    do {

        const randomIndex =
            Math.floor(Math.random() * animals.length);

        animal = animals[randomIndex];

    } while (
        previousAnimal &&
        animal.name === previousAnimal.name &&
        animals.length > 1
    );

    return animal;
}


function shuffle(array) {

    const copy = [...array];

    for (let i = copy.length - 1; i > 0; i--) {

        const j =
            Math.floor(Math.random() * (i + 1));

        [copy[i], copy[j]] =
            [copy[j], copy[i]];
    }

    return copy;
}


function newRound() {

    roundLocked = false;

    message.textContent = '';

    targetAnimal = getRandomAnimal();

    previousAnimal = targetAnimal;

    targetName.textContent =
        targetAnimal.name;

    animalsContainer.innerHTML = '';

    const shuffledAnimals =
        shuffle(animals);

    shuffledAnimals.forEach(animal => {

        const button =
            document.createElement('button');

        button.className =
            'game-animal';

        button.innerHTML = `
            <img
                src="${animal.image}"
                alt="${animal.name}"
            >

            <span>${animal.name}</span>
        `;

        button.addEventListener(
            'click',
            () => checkAnswer(animal, button)
        );

        animalsContainer.appendChild(button);
    });
}


function checkAnswer(animal, button) {

    if (roundLocked) {
        return;
    }

    if (animal.name === targetAnimal.name) {

        roundLocked = true;

        score++;
        round++;

        scoreElement.textContent = score;

        message.textContent =
            '⭐ Great job! ⭐';

        button.classList.add('correct');

        const successSound =
            new Audio('/assets/sounds/success.wav');

        successSound.play();

        if (round >= totalRounds) {

            setTimeout(() => {
                finishGame();
            }, 1200);

        } else {

            setTimeout(() => {
                newRound();
            }, 1200);
        }

    } else {

        message.textContent =
            'Try again! 😊';

        button.classList.add('wrong');

        setTimeout(() => {

            button.classList.remove('wrong');

        }, 500);
    }
}


function finishGame() {

    animalsContainer.style.display =
        'none';

    listenButton.style.display =
        'none';

    document.querySelector('.question')
        .style.display = 'none';

    message.style.display =
        'none';

    gameFinished.style.display =
        'block';

    finalMessage.textContent =
        `You found ${score} animals! ⭐`;
}


function restartGame() {

    score = 0;
    round = 0;

    previousAnimal = null;
    targetAnimal = null;

    scoreElement.textContent =
        '0';

    gameFinished.style.display =
        'none';

    animalsContainer.style.display =
        'grid';

    listenButton.style.display =
        'block';

    document.querySelector('.question')
        .style.display = 'inline-block';

    message.style.display =
        'block';

    newRound();
}


listenButton.addEventListener(
    'click',
    () => {

        if (!targetAnimal) {
            return;
        }

        const audio =
            new Audio(targetAnimal.sound);

        audio.play();
    }
);


playAgainButton.addEventListener(
    'click',
    restartGame
);


newRound();
</script>

@endsection