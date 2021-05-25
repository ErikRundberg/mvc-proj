@extends('layouts.default')
@section('content')
<div class="center">
    <h1>Hall of Heroes</h1>
    <hr>
    @php
        $i = 1;
    @endphp
    @foreach ($hiscores as $h)
        <p>#{{ $i }} {{ $h->name }} - {{ $h->money }}p [{{ $h->win }}W {{ $h->lose }}L]</p>
        @php
            $i++;
        @endphp
    @endforeach
    <div class="histogram">
        <h2>Histogram</h2>
        <p>rolled</p>
        <p>1: {{ $histograms->one }} times</p>
        <p>2: {{ $histograms->two }} times</p>
        <p>3: {{ $histograms->three }} times</p>
        <p>4: {{ $histograms->four }} times</p>
        <p>5: {{ $histograms->five }} times</p>
        <p>6: {{ $histograms->six }} times</p>
    </div>
</div>
@stop
