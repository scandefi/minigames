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
    
    
    // MINIGAMES
    Route::get('minigames/{slug}/ranking', [Controllers\MinigameController::class, 'ranking']);
    
    
    // SCORES
    Route::post('users/{wallet}/minigames/{slug}/score', [Controllers\ScoreController::class, 'store']);
});