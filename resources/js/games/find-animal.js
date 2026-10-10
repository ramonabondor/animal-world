document.addEventListener('DOMContentLoaded', () => {
  if (!document.querySelector('.game-container')) return;
// games/animals/index.blade.php
const animals = JSON.parse(document.getElementById('animal-game-data').textContent);

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

function getRoundOptions(target) {
    // Toate animalele, mai puțin răspunsul corect
    const otherAnimals = animals.filter(
        animal => animal.name !== target.name
    );

    // Alegem 5 animale aleatorii
    const randomAnimals = shuffle(otherAnimals).slice(0, 5);

    // Adăugăm animalul corect și amestecăm din nou
    return shuffle([
        target,
        ...randomAnimals
    ]);
}

function newRound() {

    roundLocked = false;

    message.textContent = '';

    targetAnimal = getRandomAnimal();

    previousAnimal = targetAnimal;

    targetName.textContent =
        targetAnimal.name;

    animalsContainer.innerHTML = '';

    const roundAnimals = getRoundOptions(targetAnimal);

    roundAnimals.forEach(animal => {

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
    if (animal.name === targetAnimal.name) {

        message.textContent = '⭐ Great job! ⭐';

        button.classList.add('correct');

        const successSound =
            new Audio('/assets/sounds/success.wav');

        successSound.play();

        // Creștem scorul și runda
        score++;
        round++;

        // Actualizăm scorul afișat
        scoreElement.textContent = score;

        // Dacă am ajuns la 5 răspunsuri corecte,
        // terminăm jocul.
        if (score >= totalRounds) {

            setTimeout(() => {
                finishGame();
            }, 1200);

        } else {

            setTimeout(() => {
                newRound();
            }, 1200);
        }

    } else {

        message.textContent = '💛 Try again!';

        button.classList.add('wrong');

        setTimeout(() => {
            button.classList.remove('wrong');
        }, 600);
    }
}

function finishGame() {
    animalsContainer.style.display = 'none';

    document.querySelector('.question')
        .style.display = 'none';

    message.style.display = 'none';

    gameFinished.style.display = 'block';

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

    document.querySelector('.question')
        .style.display = 'inline-block';

    message.style.display =
        'block';

    newRound();
}

playAgainButton.addEventListener(
    'click',
    restartGame
);


newRound();

});
