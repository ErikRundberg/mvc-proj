@extends('layouts.default')
@section('content')
<div class="center">
    <h1>Hall of Heroes</h1>
    <hr>
    @php
        $i = 1;
    @endphp
    @foreach ($hiscores as $h)
        <p>#{{ $i }} {{ $h->name }} - {{ $h->money }} [{{ $h->win }}W {{ $h->lose }}L]</p>
        @php
            $i++;
        @endphp
    @endforeach
</div>
@stop
