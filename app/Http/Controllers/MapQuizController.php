<?php

namespace App\Http\Controllers;

use App\Models\MapQuestion;
use App\Models\MapQuiz;
use App\Models\Score;
use Illuminate\Support\Facades\Auth;
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
            'user_id' => 'required'
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
    public $gameover = false;
    public function show(MapQuiz $mapQuiz, $id)
    {

        if (session()->has("key$id") != true) {
            $questions = [];
            foreach (MapQuestion::select('id', 'question', 'map_quiz_id')->where('map_quiz_id', $id)->get() as $value) {
                array_push($questions, $value);
                shuffle($questions);
            }
            session(["key$id" => $questions]);
        }

            $sessionQ = session("key$id");


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
            $firstQ = 0;
            $location = array('lat' => 999, 'lng' => 999);
            session(["score$id" => $score]);
            session(["currentQ$id" => $firstQ]);

        }
        else {
            function submitScore($amount, $gamestate, $id) {
                if (session("currentQ$id") == $amount) {
                    $gamestate = true;

                }
                if ($gamestate == true) {
                    if (Auth::check()) {
                        if (Score::where('user_id', Auth::id())->where('map_quiz_id', $id)->exists() && Score::where('user_id', Auth::id())->where('map_quiz_id', $id)->first()->score < session("score$id")) {
                            Score::where('map_quiz_id', $id)
                                ->where('user_id', Auth::id())
                                ->update(['score' => session("score$id")]);
                        } else {
                            Score::firstOrCreate(
                                ['map_quiz_id' => $id, 'user_id' => Auth::id()],
                                ['score' => session("score$id")]
                            );
                        }

                    }




                 }



            }


            $mq = MapQuestion::where('id', $sessionQ[session("currentQ$id")]->id)->first();

            $distance = haversineGreatCircleDistance(Request::input('lat'), Request::input('lng'), $mq->lat, $mq->lng);


            $sessionCurrentQ = session("currentQ$id");

            $sessionScore = session("score$id");


            switch ($distance) {
                case $distance <= 20000:
                    session(["score$id" =>  $sessionScore = $sessionScore + 5000]);
                    submitScore(count(session("key$id")) - 1, $this->gameover, $id);
                  break;
                case $distance > 20000 && $distance < 40000:
                    session(["score$id" =>  $sessionScore = $sessionScore + (5000 - ($distance / 100))]);
                    submitScore(count(session("key$id")) - 1, $this->gameover, $id);
                  break;
                case $distance > 40000 && $distance < 60000:
                    session(["score$id" =>  $sessionScore = $sessionScore + (4600 - ($distance / 100))]);
                    submitScore(count(session("key$id")) - 1, $this->gameover, $id);
                  break;
                case $distance > 60000 && $distance < 100000:
                    session(["score$id" =>  $sessionScore = $sessionScore + (4000 - ($distance / 100))]);
                    submitScore(count(session("key$id")) - 1, $this->gameover, $id);
                  break;
                case $distance > 100000 && $distance < 200000:
                    session(["score$id" =>  $sessionScore = $sessionScore + (3000 - ($distance / 100))]);
                    submitScore(count(session("key$id")) - 1, $this->gameover, $id);
                  break;
                case $distance > 200000 && $distance < 400000:
                    session(["score$id" =>  $sessionScore = $sessionScore + (1000 - ($distance / 1000))]);
                    submitScore(count(session("key$id")) - 1, $this->gameover, $id);
                  break;
                case $distance > 400000 && $distance < 600000:
                    session(["score$id" =>  $sessionScore = $sessionScore + (600 - ($distance / 1200))]);
                    submitScore(count(session("key$id")) - 1, $this->gameover, $id);
                  break;
                case $distance > 600000 && $distance < 1000000:
                    session(["score$id" =>  $sessionScore = $sessionScore + (100 - ($distance / 10000))]);
                    submitScore(count(session("key$id")) - 1, $this->gameover, $id);
                  break;


              }



            $location = array('lat' => $mq->lat, 'lng' => $mq->lng);



             session(["currentQ$id" => $sessionCurrentQ + 1]);

        }




          return Inertia::render('MapQuiz/PlayQuiz', [


            'quiz' => MapQuiz::where('id', $id)->get(),
            'questions' => $sessionQ,
            'score' => session("score$id"),
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
    public function destroy(MapQuiz $mapQuiz, $id)
    {
        MapQuiz::where('id', $id)->delete();
        return redirect()->back();
    }
}
