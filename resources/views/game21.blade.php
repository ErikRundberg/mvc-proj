@extends('layouts.default')
@section('content')

{{-- Select screen --}}
@empty (session("start"))
    <div class="flex-row flex-center center">
        <form method="post" class="flex gap">
            <label class="bit-font padded">Choose amount of die</label>
            @csrf
            <div>
                <button class="dice-button" type="submit" name="start" value="1"><div class="dice-utf8"><span class="dice-1"></span></div></button>
                <button class="dice-button" type="submit" name="start" value="2"><div class="dice-utf8"><span class="dice-2"></span><span class="dice-2"></span></div></button>
            </div>
            <button class="reset-button" type="submit" name="reset-button" value="1"><span class="bit-font">Reset score</span></button>
        </form>
    </div>
@endempty

@if (session("start"))
    <div class="flex flex-center center">
        <div class="die-box flex-row flex-center gap">
            @if (session("die"))
                @foreach (session("die") as $d)
                    <div class="dice-utf8"><span class="{{ $d }}"></span></div>
                @endforeach
                @if (session("sum"))
                    <p>Rolled: 3 (1+2)</p>
                    <p>Sum: 19</p>
                @endif
            @endif
        </div>
        <form method="post" class="flex-row gap">
            @csrf
            <button class="action-button button" type="submit" name="roll">Roll</button>
            <button class="button action-button" type="submit" name="stay">Stay</button>
        </form>
    </div>

@endif

@stop
