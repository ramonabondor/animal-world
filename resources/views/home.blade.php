@extends('layout')
@section('content')
<section class="home-screen">
    <div class="cloud cloud-one"></div>
    <div class="cloud cloud-two"></div>

    <div class="home-title">
        <div class="rainbow">🌈</div>
        <h1>Animal World</h1>
        <p>Let's learn and play!</p>
    </div>

    <div class="home-cards">
        <a class="home-card card-pink" href="{{ route('animals.index') }}">
            <span class="card-art">🐶</span>
            <strong>Animals</strong>
            <small>Meet our friends</small>
        </a>
        <a class="home-card card-blue" href="{{ route('colors') }}">
            <span class="card-art">🎨</span>
            <strong>Colors</strong>
            <small>Learn colors</small>
        </a>
        <a class="home-card card-green" href="{{ route('games.index') }}">
            <span class="card-art">🧩</span>
            <strong>Games</strong>
            <small>Let's play!</small>
        </a>
    </div>
</section>
@endsection
