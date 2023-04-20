<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;
use Inertia\Inertia;
class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::all();
        return Inertia::render('Questions/Index', [
            'questions' => $questions,
        ]);
    }

    public function create()
    {
        return Inertia::render('Questions/Create');
    }

    public function store(Request $request)
    {
            $validated = $request->validate([
            'question' => 'required|string|max:255',
            'quiz_id' => 'required'
        ]);

    }

    public function edit(Question $question)
    {
        //
    }

    public function update(Request $request, Question $question)
    {
        //
    }

    public function destroy(Question $question)
    {
        //
    }
}
