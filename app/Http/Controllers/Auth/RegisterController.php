<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\UserProfile;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
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
    protected $redirectTo = '/';

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
    protected function validator(array $data) {

        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'gender' => ['string', 'min:8', 'max:9'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'name.required' => 'Este campo no puede quedar vacío',
            'name.string' => 'Estás ingresando caracteres no permitidos',
            'name.max' => 'El nombre es demasiado largo',
            'lastname.required' => 'Este campo no puede quedar vacío',
            'lastname.string' => 'Estás ingresando caracteres no permitidos',
            'lastname.max' => 'El apellido es demasiado largo',
            'gender.string' => 'Hay un error con este dato',
            'gender.min' => 'Hay un error con este dato',
            'gender.max' => 'Hay un error con este dato',
            'email.required' => 'Este campo no puede quedar vacío',
            'email.string' => 'Estás ingresando caracteres no permitidos',
            'email.email' => 'Debes ingresar una dirección válida',
            'email.max' => 'El correo electrónico es demasiado largo',
            'email.unique' => 'Este correo ya se encuentra en uso',
            'password.required' => 'Este campo no puede quedar vacío',
            'password.string' => 'Estás ingresando caracteres no permitidos',
            'password.min' => 'La contraseña es demasiado corta',
            'password.confirmed' => 'Las contraseñas no coinciden'
        ]);

    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data) {

        $nickgen = substr(mb_strtolower($data['name']), 0, 1).$data['lastname'].rand(100,999);

        $userCreated = User::create([
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'nickname' => $nickgen,
            'remember_token' => Str::random(10),
        ]);

        $userProfile = new UserProfile();
        $userProfile->user_id = $userCreated->id;
        $userProfile->name = $data['name'];
        $userProfile->lastname = $data['lastname'];
        $userProfile->gender = $data['gender'];

        $userProfile->save();

        return $userCreated;

    }
}
