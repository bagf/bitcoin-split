@extends('layouts.default')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Edit User</div>
				<div class="panel-body">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form class="form-horizontal" role="form" method="POST" action="{{ action('Auth\UserController@update', compact('user')) }}">
                        {!! csrf_field() !!}

                        <div class="form-group">
                            <label class="col-md-4 control-label">Name</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="name" value="{{ old('name', $user->name) }}" required="required">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">E-Mail Address</label>
                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" value="{{ old('email', $user->email) }}" required="required">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Password</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Confirm Password</label>
                            <div class="col-md-6">
                                <input type="password" class="form-control" name="password_confirmation">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Save
                                </button>
                            </div>
                        </div>
                    </form>
				</div>
			</div>
            
            <hr>
            
            <div class="btn-group">
                <a class="btn btn-link" href="{{ action('Auth\UserController@index') }}">Back</a>
            </div>
            <div class="pull-right">
                <form action="{{ action('Auth\UserController@delete', compact('user')) }}" method="post">
                    @if ($user->id == auth()->user()->id)
                    <span class="help-block">
                        <nobr>User currently logged in <a class="btn btn-danger" disabled="disabled" href="#">Remove</a></nobr>
                    </span>
                    @else
                    <button type="submit" class="btn btn-danger">Remove</button>
                    @endif
                    {!! csrf_field() !!}
                </form>
            </div>
            
            <hr>
		</div>
	</div>
</div>
@endsection
