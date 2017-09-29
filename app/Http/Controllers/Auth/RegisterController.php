<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
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
            		
			'tip_doc'=> '',
			'num_doc'=> '', 
			'nom_usr'=> 'required|string|max:255',
			'ape_usr'=> 'required|string|max:255',
			'usuario'=> 'required|string|max:255',
			'crg_usr'=> 'required|string|max:255',
			'tip_ dep'=> 'required|string|max:255',
			'dep_usr'=> '',
			'crd_usr'=> '', 
			'tel_fij'=> '', 
			'tel_cel'=> '',
			'dir_mail'=> 'required|string|email|max:255|unique:users',
			'password'=> 'required|string|min:6|confirmed',
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
		
        $user = User::create([
			'tip_doc'=> $data['tip_doc'], 
			'num_doc'=> $data['num_doc'], 
			'nom_usr'=> $data['nom_usr'], 
			'ape_usr'=> $data['ape_usr'], 
			'usuario'=> $data['usuario'], 
			'crg_usr'=> $data['crg_usr'], 
			'tip_ dep'=> $data['tip_ dep'], 
			'dep_usr'=> $data['dep_usr'], 
			'crd_usr'=> $data['crd_usr'],  
			'tel_fij'=> $data['tel_fij'], 
			'tel_cel'=> $data['tel_cel'], 
			'dir_mail'=> $data['dir_mail'], 
			'password'=> bcrypt($data['password']),
        ]);
		
		
		
    }
}
