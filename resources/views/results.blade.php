@extends('layouts.app')

@section('content')
    <div class="container">
        @if($matches)
                <div class="row">
                    <?php $i = 1; ?>
                    @foreach($matches as $match)
                        <div class="col-md-3" style="{{ $i % 2 == 0 ? "padding: 15px; background-color: silver" : "padding: 15px;" }}">
                            <div class="row" style="font-weight: bold;">
                                <div class="col-md-6">
                                    {{ $match->team1 }}
                                </div>
                                <div class="col-md-6">
                                    {{ $match->team2 }}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    {{ $match->score1 }}

                                </div>
                                <div class="col-md-6">
                                    {{ $match->score2 }}

                                </div>
                            </div>
                        </div>
                        <?php $i++; ?>
                    @endforeach
                </div>
        @endif

    </div>

@endsection