<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Alert;

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

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login()
    {
        if(request()->captcha == request()->captcha2)
        {
            $login = request()->input('username');
            $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
            
            if(Auth::attempt([$field => $login, 'password' => request()->password])) 
            {
                return redirect('/home');
            } 
            else 
            {
                Alert::error('username / Password Salah', 'Pesan');
                
                return back();
            }
        }
        else
        {
            Alert::error('Captcha Salah', 'Pesan');
                
            return back();
        }
    }
}
