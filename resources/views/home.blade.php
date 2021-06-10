@extends('layouts.app')

@section('content')
<div class="container">

    @if($matches)
    <form method="post" action="{{ route('saveResults') }}">
        {!! csrf_field() !!}
        <div class="row">
            <?php $i = 1; ?>
            @foreach($matches as $match)
                <div class="col-md-4" style="{{ $i % 2 == 0 ? "padding: 15px; background-color: silver" : "padding: 15px;" }}">
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
                            <div class="input-group mb-3">
                                <input style="width: 90px;" type="number" class="form-control" value="{{ isset($match->userMatch[0]) ? $match->userMatch[0]->score1 : null}}" name="matches[{{$match->id}}][score1]">
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="input-group mb-3">
                                <input style="width: 90px;" type="number" class="form-control" value="{{ isset($match->userMatch[0]) ? $match->userMatch[0]->score2 : null}}" name="matches[{{$match->id}}][score2]">
                            </div>

                        </div>
                    </div>
                </div>
                    <?php $i++; ?>
            @endforeach
        </div>
        <input type="submit" name="Save">
    </form>
    @endif


</div>
@endsection
