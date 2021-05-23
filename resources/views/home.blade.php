@extends('layouts.default')
@section('content')
<div class="center">
    <h1>Welcome to Dice!</h1>
    <p>You can try our game at</p>
    <br>
    <a class="button" href="{{ url('/game21') }}">Game 21</a>
</div>
@stop
