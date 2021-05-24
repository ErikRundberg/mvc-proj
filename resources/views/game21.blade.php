@extends('layouts.default')
@section('content')

{{-- Select screen --}}

@empty (session("dh"))
    <div class="flex-row flex-center center bit-font">
        <form method="post" class="flex wide-gap">
            @csrf
            @if (session("bank") > 0)
                <label class="padded">Choose amount of die</label>
                <div>
                    <button class="dice-button" type="submit" name="start" value="1"><div class="dice-utf8"><span class="dice-1"></span></div></button>
                    <button class="dice-button" type="submit" name="start" value="2"><div class="dice-utf8"><span class="dice-2"></span><span class="dice-2"></span></div></button>
                </div>
                @if (session("name") === null)
                    <div>
                        <label for="name">Name: </label>
                        <input type="text" name="name" required>
                    </div>
                @endif
            @endif
            @if (session("bank") <= 0)
                <div>
                    <button class="dice-button disabled" type="submit" name="start" value="1" disabled><div class="dice-utf8"><span class="dice-1"></span></div></button>
                    <button class="dice-button disabled" type="submit" name="start" value="2" disabled><div class="dice-utf8"><span class="dice-2"></span><span class="dice-2"></span></div></button>
                </div>
            @endif
            <label for="bet">Bet: <output id="money">0</output> / {{ session("money") }}</label>
            <input type="range" name="bet" value="0" min="0" max="{{ session("money") / 2}}" oninput="document.getElementById('money').value = this.value" step="0.5">
            <p>Bank's money: {{ session("bank") }}</p>
            @if (session("bank") <= 0)
                <h1>YOU WON!</h1>
            @endif
            <button class="reset-button" type="submit" name="reset"><span class="bit-font">Submit score</span></button>
        </form>
    </div>
@endempty

{{-- Game screen --}}

 @if (session("dh"))
    <div class="flex flex-center center bit-font">
        <div class="die-box flex flex-center gap">

{{-- Displays dice --}}

            @if (session("die") and session("compSum") == null)
                <div class="flex-row">
                @foreach (session("die") as $d)
                    <div class="dice-utf8"><span class="dice-{{ $d }}"></span></div>
                @endforeach
                </div>

{{-- Displays round --}}

                @if (session("sum"))
                    <p>Rolled: {{ session("dieSum") }}</p>
                    <p>Sum: {{ session("sum") }}</p>
                @endif
            @endif
            @if (session("winner"))
                <p>You rolled: {{ session("sum") }}</p>
                <p>Computer rolled: {{ session("compSum") }}</p>
                <p>{{ session("winner") }} Won!</p>
                <form method="post" class="flex-row gap">
                    @csrf
                    <button class="action-button button" type="submit" name="back">Back</button>
                </form>
            @endif
        </div>

{{-- Action buttons --}}
        @if (session("compSum") == null)
            <form method="post" class="flex-row gap">
                @csrf
                @empty (session("sum"))
                    <button class="action-button button button-wide" type="submit" name="roll">Start</button>
                @endempty
                @if (session("sum"))
                    <button class="action-button button" type="submit" name="roll">Roll</button>
                    <button class="action-button button" type="submit" name="stay">Stay</button>
                @endif
            </form>
        @endif
    </div>

@endif

@stop
