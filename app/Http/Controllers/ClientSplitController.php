<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ClientSplit;

class ClientSplitController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $clientSplits = ClientSplit::orderBy('created_at', 'DESC')->paginate();
        return view('clientsplit.index', compact('clientSplits'));
    }

    public function view($clientSplit)
    {
        $clientSplit = ClientSplit::findOrFail($clientSplit);
        return view('clientsplit.edit', compact('clientSplit'));
    }

    public function create()
    {
        return view('clientsplit.create');
    }

    public function update(Request $request, $clientSplit)
    {
        $clientPercent = intval($request->get('client_percent'));
        $ownersPercent = intval($request->get('owner_percent'));

        $clientSplit = ClientSplit::findOrFail($clientSplit);
        $this->validate($request, [
            //'name' => 'required|string|max:255',
            'wallet_address' => 'required|max:255|unique:client_splits,wallet_address,'.$clientSplit->id,
            'client_address' => 'required|max:255',
            'client_percent' => 'required|numeric||min:0|max:'.($ownersPercent >= 100?100:(100 - $ownersPercent)),
            'owner_percent' => 'required|numeric||min:0|max:'.($clientPercent >= 100?100:(100 - $clientPercent)),
            'float' => 'required|numeric',
            'payout_frequency' => 'required|in:WEEKLY,MONTHLY',
        ]);

        $clientSplit->fill($request->all());
        $clientSplit->save();

        return back();
    }

    public function save(Request $request)
    {
        $clientPercent = intval($request->get('client_percent'));
        $ownersPercent = intval($request->get('owner_percent'));

        $this->validate($request, [
            //'name' => 'required|string|max:255',
            'wallet_address' => 'required|max:255|unique:client_splits',
            'client_address' => 'required|max:255',
            'client_percent' => 'required|numeric|min:0|max:'.($ownersPercent >= 100?100:(100 - $ownersPercent)),
            'owner_percent' => 'required|numeric|min:0|max:'.($clientPercent >= 100?100:(100 - $clientPercent)),
            'float' => 'required|numeric',
            'payout_frequency' => 'required|in:WEEKLY,MONTHLY',
        ]);

        $clientSplit = auth()->user()->clientSplits()->create($request->all());

        return redirect()->action('ClientSplitController@view', compact('clientSplit'));
    }

    public function delete($clientSplit)
    {
        ClientSplit::findOrFail($clientSplit)->delete();

        return redirect()->action('ClientSplitController@index');
    }
}
