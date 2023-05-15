<?php

namespace App\Http\Controllers;

use App\Models\MapQuestion;
use App\Models\MapQuiz;
use Illuminate\Support\Facades\Cache;
//use Illuminate\Http\Request;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class MapQuizController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('MapQuiz/ChooseQuiz', [
            'quizzes' => MapQuiz::all()
        ]);
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
        $validated = Request::validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:500',
        ]);
       $mapquizzes = MapQuiz::create($validated);
        if ($images = Request::file('images')) {
            foreach ($images as $image) {
                $mapquizzes->addMedia($image)->toMediaCollection('images');
            }
        }
    }

    /**
     * Display the specified resource.
     */

    public $questions = [];

    public function show(MapQuiz $mapQuiz, $id)
    {

            foreach (MapQuestion::select('id', 'question')->where('map_quiz_id', $id)->get() as $value) {
                array_push($this->questions, $value);
                shuffle($this->questions);
            }
            Cache::add('key', $this->questions, 600);
            $cacheQ = cache('key');


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

        if (Request::input('lat') == 0) {
            $distance = 0;
            $score = 0;
            $location = array('lat' => 0, 'lng' => 0);
        }
        else {

            $mq = MapQuestion::where('id', $cacheQ[Request::input('currentq')]->id)->first();
            $distance = haversineGreatCircleDistance(Request::input('lat'), Request::input('lng'), $mq->lat, $mq->lng);

            $score = 0;
            Cache::add('score', $score, 600);
            $cachedScore = cache('score');

            if (Request::input('currentq') == count($this->questions)) {
                Cache::flush();

            }
            if ($distance <= 50000) {
                Cache::put('score', $cachedScore = $cachedScore + 5000);
            } elseif ($distance > 50000) {
                Cache::put('score', $cachedScore = $cachedScore + (50000 - $distance));

            } elseif ($distance > 100000) {
                $cachedScore = $cachedScore + 0;
            }
            $location = array('lat' => $mq->lat, 'lng' => $mq->lng);
        }




          return Inertia::render('MapQuiz/PlayQuiz', [


            'quiz' => MapQuiz::where('id', $id)->get(),
            'questions' => $cacheQ,
            'score' => cache('score'),
            'distance' => $distance,
            'location' => $location,


        ]);





    }
    public function submitanswer(Request $request)
    {









    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MapQuiz $mapQuiz)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MapQuiz $mapQuiz)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MapQuiz $mapQuiz)
    {
        //
    }
}
