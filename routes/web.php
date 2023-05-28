<?php

use App\Http\Controllers\MapQuestionController;
use App\Http\Controllers\MapQuizController;
use App\Models\MapQuiz;
use App\Models\Score;
use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

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
Route::get('/quiz', function () {
    return Inertia::render('Quiz');
})->name('quiz');

Route::get('/gameselect', function () {
    return Inertia::render('GameSelect');
})->name('gameselect');

Route::get('/mapquizzes', function () {
    return Inertia::render('MapQuiz/Quizzes', [
        'quizzes' => MapQuiz::where('user_id', Auth::id())->get()
    ]);
})->name('mapquizzes');

Route::group(['middleware' => ['can:manage maps']], function () {
    Route::get('/admin/mapquizzes', function () {
        return Inertia::render('MapQuiz/AdminQuizzes', [
            'quizzes' => MapQuiz::query()
            ->when(Request::input('search'), function ($query, $search) {
                $query->where('title', 'like', '%' . $search . '%')
                    ->OrWhere('description', 'like', '%' . $search . '%');
            })->paginate(8)
        ]);
    })->name('adminmapquizzes');
});
Route::delete('destroy/{id}', [MapQuizController::class,'destroy'])->name('destroyMapQuiz');

Route::get('/choosemapquiz', [MapQuizController::class, 'index'])->name('choosequiz');


Route::name('quizmap.')->prefix('quizmap')->group(function () {


    Route::get('ranking/{id}', function (string $id) {
        return Inertia::render('Ranking', [
            'users' => User::all(),
            'scores' => Score::where('map_quiz_id', $id)->with('user')->orderBy('score', 'desc')->get()
        ]);
    })->name('ranking');
    Route::get('/{id}', function (string $id) {
        if (MapQuiz::where('id', $id)->first()->user_id == Auth::id()  || Auth::user()->can('manage maps')) {
            return Inertia::render('MapQuiz/MapQuizForm', [
                'quiz' => $id,
                'markers' => MapQuiz::where('id', $id)->with('questions')->get()
            ]);
        } else {
            return redirect()->back();
        }

    })->name('getQuiz');


    Route::post('store', [MapQuestionController::class, 'store'])->name('store');
    Route::get('show/{id}', [MapQuizController::class, 'show'])->name('show');
    Route::post('show/{id}', [MapQuizController::class, 'show'])->name('show');


    Route::delete('destroy/{id}', [MapQuestionController::class,'destroy'])->name('destroy');
    Route::post('submitanswer', [MapQuizController::class, 'submitanswer'])->name('submitanswer');
});

Route::get('/quiz', function () {
    return Inertia::render('Quiz');
})->name('quiz');
Route::get('/finish', function () {
    return Inertia::render('Finish');
})->name('finish');


Route::resource('mapquiz',MapQuizController::class);



Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');
});
