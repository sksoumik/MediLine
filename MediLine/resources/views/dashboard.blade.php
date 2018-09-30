@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Admin Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    You are logged in as admin!
                        <br><br>

                        <table class="table">
                            <thead>
                            <tr>
                                <th>User</th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    @if(!$user->adminFlag)
                                        <td>{{$user->name}}</td>
                                        <td>
                                            {!!Form::open(['action' => ['DashboardController@destroy', $user->id], 'method' => 'POST'])!!}
                                            {{Form::hidden('_method', 'DELETE')}}
                                            {{Form::submit('Delete Profile', ['class' => 'btn btn-danger'])}}
                                            {!!Form::close()!!}
                                        </td>
                                        <td> <a class="btn btn-danger" href="profile/{{$user->id}}">View Profile</a></td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="text-center">
                            {!!$users->links();!!}
                        </div>
                </div>

            </div>
        </div>

    </div>

</div>
@endsection
