<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Game21Controller;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\HighscoresController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home', ["title" => "Home"]);
});

Route::get('/hiscore', [HighscoresController::class, 'show']);

Route::get('/session', [SessionController::class, 'show']);
Route::get('/session/destroy', [SessionController::class, 'destroy']);

Route::get('/game21', [Game21Controller::class, 'show']);
Route::post('/game21', [Game21Controller::class, 'show']);
