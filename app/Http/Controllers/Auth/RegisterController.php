<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller {
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
    public function __construct() {
        $this->middleware( 'guest' );
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator( array $data ) {
        return Validator::make( $data, [
            'name'          => ['required', 'string', 'max:255'],
            'email'         => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'      => ['required', 'string', 'min:8', 'confirmed'],
            'fathers_name'  => ['required', 'string', 'max:255'],
            'cell_no'       => ['required', 'string', 'max:255'],
            'nid'           => ['required', 'string', 'max:255'],
            'role_id'       => ['required', 'integer', 'max:255'],
            'division'      => ['required', 'string', 'max:255'],
            'district'      => ['required', 'string', 'max:255'],
            'subdistrict'   => ['required', 'string', 'max:255'],
            'trade_lisence' => ['nullable', 'string', 'max:255'],
            'shop_image'    => ['nullable', 'max:255'],
        ] );
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create( array $data ) {
        return User::create( [
            'name'          => $data['name'],
            'email'         => $data['email'],
            'password'      => Hash::make( $data['password'] ),
            'fathers_name'  => $data['fathers_name'],
            'cell_no'       => $data['cell_no'],
            'nid'           => $data['nid'],
            'role_id'       => $data['role_id'],
            'division'      => $data['division'],
            'district'      => $data['district'],
            'subdistrict'   => $data['subdistrict'],
            'trade_lisence' => $data['trade_lisence'],
        ] );
    }

    
}
