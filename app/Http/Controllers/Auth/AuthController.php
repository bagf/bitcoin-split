<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    protected $loginPath;
    protected $redirectAfterLogout;
    protected $redirectPath;
    protected $redirectTo;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->loginPath = action('Auth\AuthController@getLogin');
        $this->redirectAfterLogout = $this->loginPath;
        $this->redirectPath = $this->loginPath;
        $this->redirectTo = action('ClientSplitController@index');

        $this->middleware('guest', ['except' => ['getLogout','getLanding']]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'wallet_addr' => 'required|max:255',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);
    }

    public function postRegisterFirst(Request $request)
    {
        if (User::count() > 0) {
            abort(400, "Registration closed");
        }

        return $this->postRegister($request);
    }

    public function getLanding()
    {
        if (User::count() > 0) {
            return redirect($this->redirectTo);
        }

        return redirect(action('Auth\AuthController@getRegister'));
    }
}
