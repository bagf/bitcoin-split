@extends('layouts.default')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
            <h2>Users</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Created</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></td>
                        <td><nobr>{{ $user->created_at->format('Y-m-d H:i:s') }}</nobr></td>
                        <td><a href="{{ action('Auth\UserController@view', compact('user')) }}">View</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div style="text-align: center">
                {!! $users->render() !!}
            </div>
            <hr>
            
            <div class="btn-group">
                <a class="btn btn-link" href="{{ action('Auth\UserController@create') }}">Create User</a>
            </div>
            
            <hr>
        </div>
	</div>
</div>
@endsection
