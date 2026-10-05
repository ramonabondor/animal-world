@extends('layout')
@section('content')
<div class="page-heading blue-heading">
    <a class="circle-nav" href="{{ route('home') }}">←</a>
    <h1>🐾 Animals</h1>
    <span class="heading-paw">🐾</span>
</div>
<p class="page-subtitle">Tap an animal to learn more and hear its sound!</p>

<div class="animal-grid">
@foreach($animals as $animal)
    <a class="animal-card" href="{{ route('animals.show',$animal) }}">
        <div class="animal-picture">
            <img src="{{ asset('assets/images/'.$animal->image) }}" alt="{{ $animal->name }}">
        </div>
        <div class="animal-name">{{ $animal->name }}</div>
        <button class="mini-sound" type="button" aria-label="Hear {{ $animal->name }}" onclick="event.preventDefault(); event.stopPropagation(); playSound('{{ asset('assets/sounds/'.$animal->sound) }}')">🔊</button>
    </a>
@endforeach
</div>
@endsection
