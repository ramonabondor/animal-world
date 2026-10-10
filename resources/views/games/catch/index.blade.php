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

<script>
document.addEventListener('DOMContentLoaded', () => {

   const allObjects = ['⭐', '🎈', '🍎', '🍓', '🌸', '🐥'];

const levels = [
    {
        instruction: 'Catch only the Stars! ⭐',
        targets: ['⭐'],
        goal: 5,
        time: 30,
        speed: 4500,
        spawn: 650
    },
    {
        instruction: 'Catch Stars and Balloons! ⭐ 🎈',
        targets: ['⭐', '🎈'],
        goal: 8,
        time: 35,
        speed: 4200,
        spawn: 650
    },
    {
        instruction: 'Catch Stars, Balloons and Apples! ⭐ 🎈 🍎',
        targets: ['⭐', '🎈', '🍎'],
        goal: 10,
        time: 40,
        speed: 4000,
        spawn: 650
    },
    {
        instruction: 'Catch Stars, Balloons, Apples and Strawberries! ⭐ 🎈 🍎 🍓',
        targets: ['⭐', '🎈', '🍎', '🍓'],
        goal: 12,
        time: 40,
        speed: 3800,
        spawn: 600
    },
    {
        instruction: 'Catch Stars, Balloons, Apples, Strawberries and Flowers! ⭐ 🎈 🍎 🍓 🌸',
        targets: ['⭐', '🎈', '🍎', '🍓', '🌸'],
        goal: 15,
        time: 45,
        speed: 3600,
        spawn: 550
    },
    {
        instruction: 'Catch Them All! ⭐ 🎈 🍎 🍓 🌸 🐥',
        targets: ['⭐', '🎈', '🍎', '🍓', '🌸', '🐥'],
        goal: 18,
        time: 45,
        speed: 3400,
        spawn: 500
    }
];

    const gameArea = document.getElementById('catch-area');
    const levelElement = document.getElementById('catch-level');
    const scoreElement = document.getElementById('catch-score');
    const goalElement = document.getElementById('catch-goal');
    const instructionElement = document.getElementById('catch-instruction');

    const startScreen = document.getElementById('catch-start-screen');
    const finishScreen = document.getElementById('catch-finish-screen');
    const finishTitle = document.getElementById('catch-finish-title');
    const finalScore = document.getElementById('catch-final-score');

    const startButton = document.getElementById('catch-start');
    const nextButton = document.getElementById('catch-next');

    const feedbackElement = document.getElementById('catch-feedback');
    const startInstruction = document.getElementById('catch-start-instruction');
    let feedbackTimer = null;

    let currentLevel = 0;
    let score = 0;
    let gameActive = false;
    let spawnTimer = null;

    let timeLeft = 0;
    let countdownTimer = null;

    const timeElement = document.getElementById('catch-time');

    function removeObjects() {
        gameArea.querySelectorAll('.catch-object').forEach(object => {
            object.remove();
        });
    }

    function updateLevelInfo() {
    const level = levels[currentLevel];

    levelElement.textContent = currentLevel + 1;
    scoreElement.textContent = score;
    goalElement.textContent = level.goal;
    instructionElement.textContent = level.instruction;
    timeElement.textContent = timeLeft;
    startInstruction.textContent = level.instruction;
}

    function spawnObject() {
    if (!gameActive) return;

    const level = levels[currentLevel];

    const object = document.createElement('button');
    object.type = 'button';
    object.className = 'catch-object';

    // Toate obiectele pot apărea la fiecare nivel
    const emoji = allObjects[
        Math.floor(Math.random() * allObjects.length)
    ];

    object.textContent = emoji;
    object.setAttribute('aria-label', 'Catch ' + emoji);

    object.style.setProperty(
        '--fall-duration',
        `${level.speed / 1000}s`
    );

    gameArea.appendChild(object);

    const maxX = Math.max(
        0,
        gameArea.clientWidth - object.offsetWidth
    );

    object.style.left = `${Math.random() * maxX}px`;

    object.style.setProperty(
        '--fall-distance',
        `${gameArea.clientHeight + 100}px`
    );

    object.addEventListener('click', () => {
        if (!gameActive) return;

        // Verificăm dacă obiectul face parte din misiune
        if (level.targets.includes(emoji)) {
            score++;
            scoreElement.textContent = score;

            if (score >= level.goal) {
                object.remove();
                finishLevel();
                return;
            }
        } else {
            // Obiect greșit: nu acordăm puncte
            showCatchFeedback('💛 Try another object!');
        }

        object.remove();

    }, { once: true });

    object.addEventListener('animationend', () => {
        object.remove();
    }, { once: true });
}

    function startLevel() {
    clearInterval(spawnTimer);
    clearInterval(countdownTimer);
    removeObjects();
    clearTimeout(feedbackTimer);
    feedbackElement.textContent = '';

    const level = levels[currentLevel];

    score = 0;
    timeLeft = level.time;
    gameActive = true;

    startScreen.style.display = 'none';
    finishScreen.style.display = 'none';

    updateLevelInfo();

    spawnObject();

    spawnTimer = setInterval(spawnObject, level.spawn);

    countdownTimer = setInterval(() => {
        if (!gameActive) return;

        timeLeft--;
        timeElement.textContent = timeLeft;

        if (timeLeft <= 0) {
            finishLevel();
        }
    }, 1000);
}

    function finishLevel() {
    if (!gameActive) return;

    gameActive = false;

    clearInterval(spawnTimer);
    clearInterval(countdownTimer);
    removeObjects();

    const level = levels[currentLevel];
    const levelCompleted = score >= level.goal;
    const isLastLevel = currentLevel === levels.length - 1;

    if (!levelCompleted) {
        finishTitle.textContent = '⏰ Time is Up!';
        finalScore.textContent =
            `You caught ${score} out of ${level.goal} objects. Try again!`;

        nextButton.textContent = '🔄 Try Again';

    } else if (isLastLevel) {
        finishTitle.textContent = '🏆 You Won!';
        finalScore.textContent =
            'Amazing! You completed all 6 levels!';

        nextButton.textContent = '🔄 Play Again';

    } else {
        finishTitle.textContent = '🌟 Level Complete!';
        finalScore.textContent =
            `Great job! You caught ${score} objects!`;

        nextButton.textContent = '➡️ Next Level';
    }

    finishScreen.style.display = 'flex';
}

    function nextLevel() {
    const level = levels[currentLevel];

    if (score >= level.goal) {
        currentLevel = currentLevel === levels.length - 1
            ? 0
            : currentLevel + 1;
    }

    score = 0;
    timeLeft = levels[currentLevel].time;

    updateLevelInfo();

    finishScreen.style.display = 'none';
    startScreen.style.display = 'flex';
}

    startButton.addEventListener('click', startLevel);
    nextButton.addEventListener('click', nextLevel);

    timeLeft = levels[currentLevel].time;

    updateLevelInfo();

});

function showCatchFeedback(text) {
    clearTimeout(feedbackTimer);

    feedbackElement.textContent = text;

    feedbackTimer = setTimeout(() => {
        feedbackElement.textContent = '';
    }, 1200);
}
</script>

@endsection