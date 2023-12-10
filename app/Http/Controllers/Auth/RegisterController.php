<?php

namespace App\Http\Controllers\Auth;

use App\General;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

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
    //protected $redirectTo = RouteServiceProvider::HOME;

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
            'cedula' => ['required', 'string', 'max:13', 'unique:users'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $total_turnos_x_defecto = General::valor('turnos_x_cliente');
        $user = User::create([
            'cedula' => $data['cedula'],
            'name' => $data['name'],
            'email' => $data['email'],
            'turnos_disponibles'    =>  $total_turnos_x_defecto,
            'password' => Hash::make($data['password']),
        ]);
        $rol_cliente = Role::where('name','cliente')->first();
        $user->assignRole($rol_cliente);

        return $user;
    }

    protected function redirectTo()
    {
        $user = Auth::user();
        if($user->hasRole('cliente')){
            return '/perfil';
        }else{
            return RouteServiceProvider::HOME;
        }
        return '/path';
    }

}
