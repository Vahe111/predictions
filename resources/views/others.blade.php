@extends('layouts.app')

@section('content')
    <div class="container">
        @if($userPredictions && count($userPredictions))
            <div class="row">

                @foreach($userPredictions as $userPrediction)
                    <div class="col-md-3">
                        <div class="row" style="font-weight: bold;">
                            <div class="col-md-12" style="text-align: center">
                                {{ $userPrediction->name . " " . $userPrediction->surname }}
                            </div>
                        </div>
                        @foreach($userPrediction->predictions as $prediction)
                        <div class="row">
                            <div class="col-md-6">
                                {{ $prediction->match->team1 }}
                            </div>
                            <div class="col-md-6">
                                {{ $prediction->match->team2 }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                {{ $prediction->score1 }}
                            </div>
                            <div class="col-md-6">
                                {{ $prediction->score2 }}
                            </div>
                        </div>
                        @endforeach
                    </div>

                @endforeach
            </div>
        @endif

    </div>

@endsection