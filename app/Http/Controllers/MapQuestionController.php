<?php

namespace App\Http\Controllers;

use App\Models\MapQuestion;
use App\Models\MapQuiz;
use Illuminate\Http\Request;
use Inertia\Inertia;

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
    public function show(MapQuestion $mapQuestion, $id)
    {
        return Inertia::render('MapQuiz/PlayQuiz', [
            'quiz' => MapQuiz::where('id', $id)->get(),
            'id' => $id,

        ]);
    }

    public $distance = null;
    public function submitanswer(Request $request)
    {
        function haversineGreatCircleDistance(
            $latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000)
          {
            // convert from degrees to radians
            $latFrom = deg2rad($latitudeFrom);
            $lonFrom = deg2rad($longitudeFrom);
            $latTo = deg2rad($latitudeTo);
            $lonTo = deg2rad($longitudeTo);

            $latDelta = $latTo - $latFrom;
            $lonDelta = $lonTo - $lonFrom;

            $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) +
              cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
            return $angle * $earthRadius;
          }
          $mq = MapQuestion::where('id', $request->id)->first();

        $this->distance = haversineGreatCircleDistance($request->lat, $request->lng, $mq->lat, $mq->lng);



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
    public function destroy(MapQuestion $mapQuestion, $id)
    {
        MapQuestion::where('id', $id)->delete();
    }
}
