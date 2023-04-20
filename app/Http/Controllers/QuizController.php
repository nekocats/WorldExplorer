<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;
use Inertia\Inertia;

class QuizController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::with('questions')->get();
        return Inertia::render('Quizzes/Index', [
            'quizzes' => $quizzes,
        ]);
    }

    public function create()
    {
        return Inertia::render('Quizzes/Create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
        ]);

        $quiz = Quiz::create($validatedData);

        return redirect()->route('quizzes.show', $quiz->id);
    }

    public function show(Quiz $quiz)
    {
        $quiz->load('questions');
        return Inertia::render('Quizzes/Show', [
            'quiz' => $quiz,
        ]);
    }

    public function edit(Quiz $quiz)
    {
        return Inertia::render('Quizzes/Edit', [
            'quiz' => $quiz,
        ]);
    }

    public function update(Request $request, Quiz $quiz)
    {
        $validatedData = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
        ]);

        $quiz->update($validatedData);

        return redirect()->route('quizzes.show', $quiz->id);
    }

    public function destroy(Quiz $quiz)
    {
        $quiz->delete();

        return redirect()->route('quizzes.index');
    }

    public function addQuestion(Request $request, Quiz $quiz)
    {
        $questionIds = $request->input('questionIds');
        $quiz->questions()->sync($questionIds);

        return redirect()->route('quizzes.show', $quiz->id);
    }
}