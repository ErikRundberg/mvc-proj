<!doctype html>
<html lang=en>
<head>
    <meta charset="utf-8">
    <title>{{ $title ?? "Game"}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ URL::asset('favicon.ico') }}" type="image/x-icon"/>
    <link rel="stylesheet" href="{{ URL::asset('css/style.css') }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
    <script>0</script>
    <header>
        <a href="<?= url("/") ?>"><img src="{{ URL::asset('img/diceHeader.png')}}" alt="Dice"></a>
        <nav>
            <a href="<?= url("/") ?>">Home</a>
            <a href="<?= url("/game21") ?>">Game 21</a>
            <a href="<?= url("/hiscore") ?>">Highscore</a>
        </nav>
    </header>
    <main>
@yield("content")
    </main>
        <footer>
            <div class="center">
                <a href="https://github.com/Erru17/mvc-proj"><span class="material-icons">account_circle</span> Made by Erru17 </a>
            </div>
        </footer>
    </body>
</html>
