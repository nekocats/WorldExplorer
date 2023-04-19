<?php

use App\Http\Controllers\MapQuizController;
use App\Models\MapQuiz;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('welcome');
Route::get('/map', function () {
    return Inertia::render('Map');
})->name('map');


Route::get('/gameselect', function () {
    return Inertia::render('GameSelect');
})->name('gameselect');
<<<<<<< HEAD
Route::get('/quiz', function () {
    return Inertia::render('Quiz');
})->name('quiz');
=======

Route::get('/mapquizzes', function () {
    return Inertia::render('MapQuiz/Quizzes', [
        'quizzes' => MapQuiz::all()
    ]);
})->name('mapquizzes');
Route::resource('mapquiz',MapQuizController::class);
>>>>>>> 1a09a5d (carlos wanted)
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});
