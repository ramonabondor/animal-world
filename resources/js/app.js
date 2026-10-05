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
