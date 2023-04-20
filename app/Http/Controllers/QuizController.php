<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;
use Inertia\Inertia;

class QuizController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:500',
        ]);
    }

    public function show(Quiz $quiz)
    {
        //
    }

    public function edit(Quiz $quiz)
    {
        //
    }

    public function update(Request $request, Quiz $quiz)
    {
        //
    }

    public function destroy(Quiz $quiz)
    {
        //
    }

    public function addQuestion(Request $request, Quiz $quiz)
    {
        //
    }
}