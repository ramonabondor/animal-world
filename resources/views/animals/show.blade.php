@extends('layout')
@section('content')
<div class="detail-page">
    <a class="circle-nav back-floating" href="{{ route('animals.index') }}">←</a>
    <a class="circle-nav home-floating" href="{{ route('home') }}">🏠</a>

    <div class="detail-animal">
        <img src="{{ asset('assets/images/'.$animal->image) }}" alt="{{ $animal->name }}">
    </div>

    <div class="detail-panel">
        <h1>{{ $animal->name }}</h1>
        <p class="detail-description">{{ $animal->description }}</p>
        <p class="detail-color">Color: <strong>{{ $animal->color }}</strong></p>
      <audio id="animalVoice" autoplay>
    <source
        src="{{ asset('assets/voices/' . strtolower($animal->name) . '.mp3') }}"
        type="audio/mpeg"
    >
</audio>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const audio = document.getElementById('animalVoice');

    audio.volume = 1;

    audio.play().catch(function () {
        console.log('Browser blocked automatic audio playback.');
    });
});
</script>

        <div class="animal-navigation">

    <a
        href="{{ route('animals.show', $previousAnimal) }}"
        class="animal-nav-button"
    >
        ← Previous
    </a>

    <a
        href="{{ route('animals.show', $nextAnimal) }}"
        class="animal-nav-button next"
    >
        Next →
    </a>

</div>
       
    </div>
</div>
@endsection
