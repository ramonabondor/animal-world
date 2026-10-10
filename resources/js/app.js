import './bootstrap';

window.playSound = function (url) {
    const audio = new Audio(url);
    audio.currentTime = 0;
    audio.play().catch(() => {});
};

window.sayColor = function (name) {
    if ('speechSynthesis' in window) {
        window.speechSynthesis.cancel();
        const speech = new SpeechSynthesisUtterance(name);
        speech.rate = 0.75;
        speech.pitch = 1.15;
        window.speechSynthesis.speak(speech);
    }
};

// Page and game modules. Each runs only on its corresponding page.
import './pages/animal-detail.js';
import './pages/colors.js';
import './games/find-animal.js';
import './games/catch.js';
import './games/colors.js';
import './games/counting.js';
import './games/memory.js';
import './games/shapes.js';
