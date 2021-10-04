<?php

use App\Http\Controllers;
use Illuminate\Support\Facades\Route;

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
    return view('minigames.requirements');
});

Route::get('{minigame}', [Controllers\MinigameController::class, 'play']);

Route::group(['prefix' => 'api'], function(){
    // USERS
    Route::post('users/register', [Controllers\UserController::class, 'register']);
    Route::post('users/login-or-register', [Controllers\UserController::class, 'loginOrRegister']);
    Route::post('users/logout', [Controllers\UserController::class, 'logout']);
    
    Route::get('users/{wallet}/minigames/{slug}/lives', [Controllers\UserController::class, 'lives']);
    Route::get('users/{wallet}/minigames/{slug}/ranking', [Controllers\UserController::class, 'ranking']);
    Route::get('users/{wallet}/minigames/{slug}/round/{round_name}/ranking', [Controllers\UserController::class, 'roundRanking']);
    Route::get('users/{wallet}/minigames/{slug}/ranking/active', [Controllers\UserController::class, 'activeRoundRanking']);
    Route::get('users/{wallet}/minigames/{slug}/ranking/previous', [Controllers\UserController::class, 'previousRoundRanking']);
    
    
    // MINIGAMES
    Route::get('minigames/{slug}/ranking', [Controllers\MinigameController::class, 'ranking']);
    Route::get('minigames/{slug}/round/{round_name}/ranking', [Controllers\MinigameController::class, 'roundRanking']);
    Route::get('minigames/{slug}/ranking/active', [Controllers\MinigameController::class, 'activeRoundRanking']);
    Route::get('minigames/{slug}/ranking/previous', [Controllers\MinigameController::class, 'previousRoundRanking']);
    
    
    // SCORES
    Route::post('users/{wallet}/minigames/{slug}/score', [Controllers\ScoreController::class, 'store']);
    Route::get('users/{wallet}/minigames/{slug}/highscore', [Controllers\ScoreController::class, 'highscore']);
});