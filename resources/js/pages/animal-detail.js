// animals/show.blade.php
document.addEventListener('DOMContentLoaded', function () {
    if (!document.querySelector('#animalVoice')) return;

    const audio = document.getElementById('animalVoice');

    audio.volume = 1;

    audio.play().catch(function () {
        console.log('Browser blocked automatic audio playback.');
    });
});
