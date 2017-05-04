<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::orderBy('created_at', 'DESC')->paginate();
        return view('user.index', compact('users'));
    }

    public function view($user)
    {
        $user = User::findOrFail($user);
        return view('user.edit', compact('user'));
    }

    public function create()
    {
        return view('user.create');
    }

    public function update(Request $request, $user)
    {
        $user = User::findOrFail($user);
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,'.$user->id,
            'wallet_addr' => 'required|max:255',
            'password' => 'confirmed',
        ]);

        $user->fill($request->only([ 'name', 'email', ]));
        if ($request->get('password')."" != '') {
            $user->password = bcrypt($request->get('password'));
        }

        $user->save();

        return back();
    }

    public function save(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users',
            'wallet_addr' => 'required|max:255',
            'password' => 'required|confirmed',
        ]);

        $user = new User($request->only([ 'name', 'email', ]));
        $user->password = bcrypt($request->get('password'));

        $user->save();

        return redirect()->action('Auth\UserController@view', compact('user'));
    }

    public function delete($user)
    {
        $user = User::findOrFail($user);
        if (auth()->user()->id != $user->id) {
            $user->delete();
        }

        return redirect()->action('Auth\UserController@index');
    }

    public function getChangePassword()
    {
        return view('user.change_password');
    }

    public function postChangePassword(Request $request)
    {
        $this->validate($request, [
            'oldpassword' => 'required',
            'password' => 'required|min:6',
        ]);

        $user = auth()->user();
        $email = $user->email;
        $password = $request->get('oldpassword');

        if (!auth()->attempt(compact('email', 'password'), false, false)) {
            return back()->withErrors('Invalid current password');
        }

        $user->password = bcrypt($request->get('password'));
        $user->save();

        return back()->with('status', 'Password updated');
    }
}
