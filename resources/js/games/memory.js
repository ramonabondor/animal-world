// games/memory/index.blade.php
document.addEventListener('DOMContentLoaded', () => {
    if (!document.querySelector('.memory-page')) return;

    const levels = [
        { title: 'Animals', items: [
            { id: 'dog', image: document.querySelector('.memory-page').dataset.animalDog },
            { id: 'cat', image: document.querySelector('.memory-page').dataset.animalCat },
            { id: 'lion', image: document.querySelector('.memory-page').dataset.animalLion }
        ]},
        { title: 'Colors', items: [
            { id: 'red', color: '#ef5350' }, { id: 'blue', color: '#42a5f5' },
            { id: 'yellow', color: '#ffd54f' }, { id: 'green', color: '#66bb6a' }
        ]},
        { title: 'Shapes', items: [
            { id: 'star', shape: 'star', color: '#ffd54f' },
            { id: 'heart', shape: 'heart', color: '#f48fb1' },
            { id: 'circle', shape: 'circle', color: '#ffad55' },
            { id: 'square', shape: 'square', color: '#64b5f6' },
            { id: 'triangle', shape: 'triangle', color: '#ef5350' },
            { id: 'diamond', shape: 'diamond', color: '#80deea' }
        ]}
    ];

    const board = document.getElementById('memory-board');
    const instruction = document.getElementById('memory-instruction');
    const levelText = document.getElementById('memory-level');
    const pairsText = document.getElementById('memory-pairs');
    const totalText = document.getElementById('memory-total');
    const movesText = document.getElementById('memory-moves');
    const message = document.getElementById('memory-message');
    const overlay = document.getElementById('memory-overlay');
    const panelTitle = document.getElementById('memory-panel-title');
    const panelText = document.getElementById('memory-panel-text');
    const actionButton = document.getElementById('memory-action');

    let levelIndex = 0;
    let firstCard = null;
    let secondCard = null;
    let locked = false;
    let matches = 0;
    let moves = 0;
    let pendingTimer = null;
    let playing = false;

    function shuffle(items) {
        const array = [...items];
        for (let i = array.length - 1; i > 0; i--) {
            const j = Math.floor(Math.random() * (i + 1));
            [array[i], array[j]] = [array[j], array[i]];
        }
        return array;
    }

    function resetSelection() {
        firstCard = null;
        secondCard = null;
        locked = false;
    }

    function showPanel(title, text, buttonText) {
        panelTitle.textContent = title;
        panelText.textContent = text;
        actionButton.textContent = buttonText;
        overlay.hidden = false;
    }

    function shapeSvg(item) {
        const figures = {
            star: '<polygon points="50,5 61,36 94,36 68,56 78,90 50,70 22,90 32,56 6,36 39,36"/>',
            heart: '<path d="M50 88 C36 76 7 56 7 32 C7 7 38 6 50 27 C62 6 93 7 93 32 C93 56 64 76 50 88Z"/>',
            circle: '<circle cx="50" cy="50" r="41"/>',
            square: '<rect x="11" y="11" width="78" height="78" rx="3"/>',
            triangle: '<polygon points="50,7 94,89 6,89"/>',
            diamond: '<polygon points="50,5 95,50 50,95 5,50"/>'
        };
        const svg = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
        svg.setAttribute('viewBox', '0 0 100 100');
        svg.setAttribute('class', 'memory-shape-svg');
        svg.setAttribute('aria-hidden', 'true');
        svg.innerHTML = `<g fill="${item.color}">${figures[item.shape]}</g>`;
        return svg;
    }

    function startLevel() {
        clearTimeout(pendingTimer);
        pendingTimer = null;
        resetSelection();
        matches = 0;
        moves = 0;
        playing = true;
        message.textContent = '';
        overlay.hidden = true;

        const level = levels[levelIndex];
        levelText.textContent = levelIndex + 1;
        pairsText.textContent = '0';
        totalText.textContent = level.items.length;
        movesText.textContent = '0';
        instruction.textContent = `Level ${levelIndex + 1}: Match the ${level.title}!`;
        board.classList.toggle('memory-board-six', level.items.length === 6);
        board.replaceChildren();

        const cards = shuffle(level.items.flatMap(item => [
            { ...item, copy: 1 }, { ...item, copy: 2 }
        ]));

        cards.forEach(item => {
            const card = document.createElement('button');
            card.type = 'button';
            card.className = 'memory-card';
            card.dataset.match = item.id;
            card.setAttribute('aria-label', 'Hidden memory card');
            card.setAttribute('aria-pressed', 'false');

            const inner = document.createElement('span');
            inner.className = 'memory-card-inner';

            const back = document.createElement('span');
            back.className = 'memory-card-back';
            back.textContent = '❓';
            back.setAttribute('aria-hidden', 'true');

            const front = document.createElement('span');
            front.className = 'memory-card-front';
            front.setAttribute('aria-hidden', 'true');

            if (item.image) {
                const picture = document.createElement('img');
                picture.src = item.image;
                picture.alt = '';
                picture.className = 'memory-animal-image';
                picture.draggable = false;
                front.appendChild(picture);
            } else if (item.color && !item.shape) {
                front.classList.add('memory-color-face');
                front.style.backgroundColor = item.color;
            } else if (item.shape) {
                front.classList.add('memory-shape-face');
                front.appendChild(shapeSvg(item));
            }

            inner.append(back, front);
            card.appendChild(inner);
            card.addEventListener('click', () => flipCard(card, item));
            board.appendChild(card);
        });
    }

    function flipCard(card, item) {
        if (!playing || locked || card === firstCard || card.classList.contains('matched')) return;

        card.classList.add('flipped');
        card.setAttribute('aria-label', item.id);
        card.setAttribute('aria-pressed', 'true');

        if (!firstCard) {
            firstCard = card;
            return;
        }

        secondCard = card;
        locked = true;
        moves++;
        movesText.textContent = moves;

        if (firstCard.dataset.match === secondCard.dataset.match) {
            firstCard.classList.add('matched');
            secondCard.classList.add('matched');
            firstCard.disabled = true;
            secondCard.disabled = true;
            matches++;
            pairsText.textContent = matches;
            message.textContent = '⭐ Great match!';
            resetSelection();

            if (matches === levels[levelIndex].items.length) {
                playing = false;
                pendingTimer = setTimeout(() => {
                    if (levelIndex === levels.length - 1) {
                        showPanel('🏆 Memory Champion!', 'Amazing! You completed all 3 levels!', '🔄 Play Again');
                    } else {
                        message.textContent = '🌟 Level Complete! Great job!';
                        pendingTimer = setTimeout(() => {
                            levelIndex++;
                            startLevel();
                        }, 2000);
                    }
                }, 650);
            }
        } else {
            message.textContent = '💛 Try again!';
            const a = firstCard;
            const b = secondCard;
            pendingTimer = setTimeout(() => {
                for (const c of [a, b]) {
                    c.classList.remove('flipped');
                    c.setAttribute('aria-label', 'Hidden memory card');
                    c.setAttribute('aria-pressed', 'false');
                }
                resetSelection();
            }, 1100);
        }
    }

    actionButton.addEventListener('click', () => {
        if (playing) return;
        if (matches === levels[levelIndex].items.length && levelIndex < levels.length - 1) {
            levelIndex++;
        } else if (matches === levels[levelIndex].items.length && levelIndex === levels.length - 1) {
            levelIndex = 0;
        }
        startLevel();
    });

    levelText.textContent = '1';
    totalText.textContent = levels[0].items.length;
});
