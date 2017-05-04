@extends('layouts.default')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading">Create Client Split</div>
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

                    <form class="form-horizontal" role="form" method="POST" action="{{ action('ClientSplitController@save') }}">
                        {!! csrf_field() !!}

                        <div class="form-group">
                            <label class="col-md-4 control-label">Wallet Address</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="wallet_address" value="{{ old('wallet_address') }}" required="required">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Client Address</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="client_address" value="{{ old('client_address') }}" required="required">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Client Percentage</label>
                            <div class="col-md-6">
                                <input type="number" class="form-control" name="client_percent" value="{{ old('client_percent') }}" min="0" max="100" required="required">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Owner Percentage</label>
                            <div class="col-md-6">
                                <input type="number" class="form-control" name="owner_percent" value="{{ old('owner_percent') }}" min="0" max="100" required="required">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Float Balance</label>
                            <div class="col-md-6">
                                <input type="number" class="form-control" name="float" step="0.0000000001" value="{{ old('float', '0') }}" required="required">
                                <span class="help-block">Maintain this balance when redrawing</span>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Payout Frequency</label>
                            <div class="col-md-6">
                                <select class="form-control" name="payout_frequency" required="required">
                                    <option value="">Please Select…</option>
                                    <option value="WEEKLY"{!! ((old('payout_frequency') === 'WEEKLY')?' selected="selected"':'') !!}>Weekly</option>
                                    <option value="MONTHLY"{!! ((old('payout_frequency') === 'MONTHLY')?' selected="selected"':'') !!}>Monthly</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Create
                                </button>
                            </div>
                        </div>
                    </form>
				</div>
			</div>
            <hr>

            <div class="btn-group">
                <a class="btn btn-link" href="{{ action('ClientSplitController@index') }}">Back</a>
            </div>

            <hr>
		</div>
	</div>
</div>
@endsection
