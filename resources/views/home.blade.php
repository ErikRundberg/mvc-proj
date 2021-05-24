@extends('layouts.default')
@section('content')
<div class="center">
    <h1>Welcome to Dice!</h1>
    <br>
    <a class="button" href="{{ url('/session') }}">Session</a>
</div>
@stop
