@extends('layouts.default')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
            <h2>Client Splits</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Wallet Address</th>
                        <th>Client Percent</th>
                        <th>Owner Percent</th>
                        <th>Frequency</th>
                        <th>Created</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($clientSplits as $clientSpit)
                    <tr>
                        <td>{{ $clientSpit->wallet_address }}</td>
                        <td>{{ $clientSpit->client_percent }}</td>
                        <td>{{ $clientSpit->owner_percent }}</td>
                        <td>{{ $clientSpit->payout_frequency }}</td>
                        <td><nobr>{{ $clientSpit->created_at->format('Y-m-d H:i:s') }}</nobr></td>
                        <td><a href="{{ action('ClientSplitController@view', compact('clientSpit')) }}">View</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div style="text-align: center">
                {!! $clientSplits->render() !!}
            </div>
            <hr>

            <div class="btn-group">
                <a class="btn btn-link" href="{{ action('ClientSplitController@create') }}">Create Split</a>
            </div>

            <hr>
        </div>
	</div>
</div>
@endsection
