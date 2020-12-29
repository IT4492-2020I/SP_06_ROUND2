<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Dung\User\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;


    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';


    public function username()
    {
        return 'email';
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    /**
     * Get the maximum number of attempts to allow.
     *
     * @return int
     */
    public function maxAttempts()
    {
        return 6;
    }

    /**
     * Get the number of minutes to throttle for.
     *
     * @return int
     */
    public function decayMinutes()
    {
        return 120;
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return redirect(route('home'));
    }

    /**
     * login controller
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $remember = $request->get('remember') == 'on' ? true : false;

        if (Auth::attempt($credentials, $remember)) {
            $enabled = \Auth::user()->status;

            if (!$enabled) {
                Auth::logout();
                return redirect(route('home'));
            }
            $role = Auth::user()->role;
            if ($role == User::ADMIN_ROLE) {
                return redirect(route('users.index'));
            } else {
                return redirect(route('home'));
            }
        }
        return redirect(route('login'));
    }
}
