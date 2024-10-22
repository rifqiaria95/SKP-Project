<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
    public function __construct()
    {
        $this->middleware('guest');
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
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    public function postregister(Request $request)
    {
        // Pesan error khusus
        $messages  = [
            'required'       => 'Kolom :attribute harus diisi.',
            'string'         => 'Kolom :attribute harus berupa teks.',
            'numeric'        => 'Kolom :attribute harus berupa angka.',
            'alpha'          => 'Kolom :attribute harus berupa teks.',
            'max'            => 'Kolom :attribute maksimal :max kata.',
            'min'            => 'Kolom :attribute maksimal :min kata.',
            'after_or_equal' => 'Tidak boleh isi tanggal yang sudah lewat.',
        ];
        
        // Tentukan aturan validasi berdasarkan role
        $rules = [
            'name'     => 'required', 'string', 'max:255',
            'email'    => 'required', 'string', 'email', 'max:255', 'unique:users',
            'password' => 'required', 'string', 'min:8', 'confirmed',
        ];

        // Lakukan validasi terlebih dahulu
        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json([
                'status'    => 400,
                'errors'    => $validator->messages()
            ]);
        }

        $user                    = new User;
        $user->role              = 'karyawan';
        $user->status_user       = 1;
        $user->name              = $request->name;
        $user->email             = $request->email;
        $user->email_verified_at = now();
        $user->password          = bcrypt($request->password);
        $user->remember_token    = Str::random(60);
        $user->save();

        toastr()->success('You Are Registered', 'Success!');
        return redirect('/');
    }
}
