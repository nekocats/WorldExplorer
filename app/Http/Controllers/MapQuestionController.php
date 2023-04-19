<?php

namespace App\Http\Controllers;

use App\Models\MapQuestion;
use Illuminate\Http\Request;

class MapQuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'question' => 'required|string|max:255',
            'lat' => 'required',
            'lng' => 'required',
            'map_quiz_id' => 'required',

        ]);
       $mapquestion = MapQuestion::create($validated);
        if ($images = $request->file('images')) {
            foreach ($images as $image) {
                $mapquestion->addMedia($image)->toMediaCollection('images');
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(MapQuestion $mapQuestion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MapQuestion $mapQuestion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MapQuestion $mapQuestion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MapQuestion $mapQuestion)
    {
        //
    }
}
