<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected $redirectTo = RouteServiceProvider::HOME;

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
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email'    => 'required|string|email',
            'password' => 'required|string',
        ]);

        $email    = $request->email;
        $password = $request->password;

        if (Auth::attempt(['email'=>$email,'password'=>$password,'status_user'=> 1])) {
            toastr()->success('Kamu berhasil login', 'Success!');
            return redirect()->intended('dashboard');
        }elseif (Auth::attempt(['email'=>$email,'password'=>$password,'status_user'=> 0])) {
            toastr()->error('Maaf, akun yang kamu gunakan tidak aktif, Silakan kontak Admin.', 'Error!');
            return redirect()->intended('dashboard');
        }
        else{
            toastr()->error('Email atau Password yang kamu masukkan salah.', 'Error!');
            return redirect('login');
        }

    }
}
