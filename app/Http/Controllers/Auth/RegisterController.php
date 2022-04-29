<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('guest');
    // }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'nama' => ['required', 'string', 'max:255'],
            'alamat' => ['required', 'string', 'max:45'],
            'no_telephone' => ['required', 'string', 'max:45'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }


    public function register(Request $request)
    {
        $username = $request->input('username');
        $nama = $request->input('nama');
        $alamat = $request->input('alamat');
        $no_telephone = $request->input('no_telephone');
        $password = $request->input('password');
        $re_password = $request->input('password_confirmation');

        if($password != $re_password)
        {
            return back()->with('error', 'Validasi Password Salah !');
        }

        $hash_Password = Hash::make($password);

        $data = new User();
        $data->username = $username;
        $data->nama = $nama;
        $data->alamat = $alamat;
        $data->no_telephone = $no_telephone;
        $data->password = $hash_Password;
        $data->save();

        return redirect('/login');
    }
}
