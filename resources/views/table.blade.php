@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <table id="example" class="display" style="width:100%">
                    <thead>
                    <tr>
                        <th>Position</th>
                        <th>Name</th>
                        <th>Results</th>
                        <th>Differences</th>
                        <th>Outcome</th>
                        <th>Points</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $user['position'] }}</td>
                        <td>{{ $user['name'] }}</td>
                        <td>{{ $user['results'] }}</td>
                        <td>{{ $user['differences'] }}</td>
                        <td>{{ $user['outcome'] }}</td>
                        <td style="font-weight: bold">{{ $user['points'] }}</td>
                    </tr>
                    @endforeach

                </table>
            </div>
        </div>

    </div>

    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                "order": [[ 0, "asc" ]]
            });
        } );
    </script>

@endsection