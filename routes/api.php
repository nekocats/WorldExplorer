<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Score;
use App\Models\MapQuiz;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/users', function () {
    return \App\Models\User::all();
});

Route::get('/scores', function () {
    return Score::all();
});
Route::get('/map_quizzes', function () {
    return MapQuiz::all();
});