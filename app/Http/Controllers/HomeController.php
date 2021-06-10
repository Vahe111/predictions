<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Match;
use App\User;
use App\UserChampion;
use App\UserMatch;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $matches = null;
        if(Auth::user()) {
            $matches = Match::whereNull('score1')->whereNull('score2')->where('deadline', '>', Carbon::now())->
            with([
                'userMatch' => function ($userMatch) {
                    return $userMatch->where('user_id', Auth::user()->id);
                }
            ])->get();
        }

      //  dd($matches);

        return view('home', compact('matches'));
    }

    public function saveResults(Request $request) {
        // dd($request->matches);
        foreach ($request->matches as $matchId => $results) {
            if ($results['score1'] && $results['score2']) {
                UserMatch::updateOrCreate([
                    'user_id' => Auth::user()->id,
                    'match_id' => $matchId
                ],
                    [
                        'user_id' => Auth::user()->id,
                        'match_id' => $matchId,
                        'score1' => $results['score1'],
                        'score2' => $results['score2']
                    ]);
            }
        }

        return redirect()->back();
    }

    public function table() {

        $completedMatches = Match::whereNotNull('score1')->whereNotNull('score2')->get();

        // $predictions = UserMatch::with('user')->get();
        $userPredictions = User::with('predictions')->get();

        $users = [];
        $positions = [];

        foreach($completedMatches as $match) {
            foreach($userPredictions as $userPrediction) {
                if (count($userPrediction->predictions)) {
                    foreach($userPrediction->predictions as $prediction) {
                        if(!isset($users[$userPrediction->id])) {
                            $users[$userPrediction->id]['name'] = $userPrediction->name . ' ' . $userPrediction->surname;
                            $users[$userPrediction->id]['points'] = 0;
                            $users[$userPrediction->id]['results'] = 0;
                            $users[$userPrediction->id]['differences'] = 0;
                            $users[$userPrediction->id]['outcome'] = 0;
                            $positions[$userPrediction->id] = 0;
                        }
                        if($prediction->match_id == $match->id && $prediction->score1 && $prediction->score2 && $match->score1 && $match->score2) {
                            if($match->score1 == $prediction->score1 && $match->score2 == $prediction->score2) {
                                $users[$userPrediction->id]['points'] += 3;
                                $users[$userPrediction->id]['results'] += 1;
                                $positions[$userPrediction->id] += 3;
                            } else if (($match->score1 - $match->score2) == ($prediction->score1 - $prediction->score2)) {
                                $users[$userPrediction->id]['points'] += 2;
                                $users[$userPrediction->id]['differences'] += 1;
                                $positions[$userPrediction->id] += 2;
                            } else if (($match->score1 > $match->score2 && $prediction->score1 > $prediction->score2)
                                || ($match->score1 < $match->score2 && $prediction->score1 < $prediction->score2)
                                || ($match->score1 == $match->score2 && $prediction->score1 == $prediction->score2)) {
                                $users[$userPrediction->id]['points'] += 1;
                                $users[$userPrediction->id]['outcome'] += 1;
                                $positions[$userPrediction->id] += 1;
                            }
                        }
                    }
                } else {
                    $users[$userPrediction->id]['name'] = $userPrediction->name . ' ' . $userPrediction->surname;
                    $users[$userPrediction->id]['points'] = 0;
                    $users[$userPrediction->id]['results'] = 0;
                    $users[$userPrediction->id]['differences'] = 0;
                    $users[$userPrediction->id]['outcome'] = 0;
                    $positions[$userPrediction->id] = 0;
                }
            }
        }



        uasort($positions, function($a, $b) {
            if ($a == $b) {
                return 0;
            }
            return ($a > $b) ? -1 : 1;
        });

        $i = 1;
        foreach($positions as $key => $value) {
            $users[$key]['position'] = $i;
            $i++;
        }

        return view('table', compact('users'));
    }

    public function results() {
        $matches = Match::whereNotNull('score1')->whereNotNull('score2')->where('score1', '!=', 10)->where('score2', '!=', 10)->get();

        return view('results', compact('matches'));
    }

    public function others()
    {
        $userPredictions = User::with(['predictions' => function ($query) {
            $query->with('match');
        }])->get();

        return view('others', compact('userPredictions'));
    }

    public function champion()
    {
        $userChampion = null;
        if(Auth::user()) {
            $userChampion = UserChampion::where('user_id', Auth::user()->id)->get();
        } else {
            return redirect()->route('table');
        }

        //  dd($matches);
        return view('champion', compact('userChampion'));
    }

    public function saveChampion(Request $request) {
        // dd($request->matches);

        foreach ($request->champion as $userId => $team) {
            UserChampion::updateOrCreate([
                'user_id' => Auth::user()->id,
            ],
                [
                    'user_id' => Auth::user()->id,
                    'team' => $team
                ]);
        }

        return redirect()->back();
    }
}
