@extends('layout')
@section('content')
<div class="page-heading blue-heading">
    <a class="circle-nav" href="{{ route('home') }}">←</a>
    <h1>🎨 Colors</h1>
    <span class="heading-paw">🌈</span>
</div>
<p class="page-subtitle">Tap a color and say its name!</p>

<div class="color-grid">
@foreach([['Red','#ff6f7d','❤️'],['Blue','#45a7f5','💙'],['Yellow','#ffd447','💛'],['Green','#76d84d','💚'],['Purple','#a979ed','💜'],['Orange','#ff9b4a','🧡']] as [$name,$color,$heart])
    <button class="color-box" style="--box-color: {{ $color }}" onclick="sayColor('{{ $name }}')">
        <span>{{ $heart }}</span>
        <strong>{{ $name }}</strong>
    </button>
@endforeach
</div>
@endsection
