<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Validated;
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function showRegistrationForm()
    {
        return view('welcome');
    }
    public function register(Request $request)
    {
        $request->validate([
            'fname'=> ['required', 'string', 'max:255'],
            'lname'=> ['required', 'string', 'max:255'],
            'email'=> ['required', 'string', 'email', 'unique:users'],
            'password'=> ['required', 'string', 'min:8', 'confirmed'],
            'date'=> ['required', 'numeric'],
            'month'=> ['required', 'numeric'],
            'year'=> ['required', 'numeric'],
        ]);

        $userInfo = array();
        
        $userInfo['fname'] = $request->get('fname');
        $userInfo['lname'] = $request->get('lname');
        $userInfo['email'] = $request->get('email');

        $birthday =  strtotime($request->get('year') . '-' . $request->get('month') . '-' . $request->get('date'));
        $birthday = date('Y-m-d', $birthday);
        $userInfo['b_day'] = $birthday;

        $userInfo['sex'] = $request->get('sex') == 'male' ? 1 : 0;
        $userInfo['password'] = bcrypt($request->get('password'));


        $user= User::create($userInfo);

        Auth::loginUsingId($user->id);

        return redirect()->route('dashboard');
    }
}
