<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Auth;

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
    protected $redirectTo;

    protected function redirectTo(){

        if(Auth()->user()->username == "admin")
        {
            return route('admin.dashboard');
        }
        else
        {
            return route('home');
        }
        
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        return redirect()->route('login');
    }

    public function login(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        if(auth()->attempt(array('username'=>$username, 'password'=>$password)))
        {
            if(auth()->user()->username == 'admin')
            {
                return redirect()->route('home-admin');
            }
            else
            {
                return redirect()->route('home-klien');
            }
            
        }
        else
        {
            return redirect()->route('login')->with('error', 'Password Anda Salah');
        }

        
        
    }
    public function logout(){
        Auth::logout();
        return redirect('/home');
    }

}
