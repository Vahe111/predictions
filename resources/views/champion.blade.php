@extends('layouts.app')

@section('content')
    <div class="container">


            <form method="post" action="{{ route('saveChampion') }}">
                {!! csrf_field() !!}
                <div class="row">
                    <?php $i = 1; ?>

                        <div class="col-md-4">

                                <div class="input-group mb-3">
                                    @if(isset($userChampion[0]))
                                    <input style="width: 200px;" type="text" class="form-control" value="{{ isset($userChampion[0]->team) ? $userChampion[0]->team : null}}" name="champion[{{Auth::user()->id}}]">
                                    @else
                                        <input style="width: 200px;" type="text" class="form-control" value="" name="champion[{{Auth::user()->id}}]">
                                        @endif
                                </div>

                        </div>
                        <?php $i++; ?>

                </div>
                <input type="submit" name="Save">
            </form>



    </div>
@endsection
