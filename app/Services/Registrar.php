<?php

namespace App\Services;

use App\Models\User;
use Validator;
use Illuminate\Contracts\Auth\Registrar as RegistrarContract;

class Registrar implements RegistrarContract {

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validator(array $data) {
        return Validator::make($data, [
                    'name' => 'required|max:255',
                    'email' => 'required|email|max:255|unique:users',
                    'password' => 'required|confirmed|min:6',
                    'currency' => 'required',
                    'username' => 'required|unique:users|max:255',
                    'lastname' => 'required|max:255',
                    'balance' => 'required|numeric',
                    'courtdate' => 'required|min:2|max:2'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    public function create(array $data) {
        return User::create([
                    'name' => $data['name'],
                    'lastname' => $data['lastname'],
                    'username' => $data['username'],
                    'email' => $data['email'],
                    'currency' => $data['currency'],
                    'password' => bcrypt($data['password']),
                    'balance' => $data['balance'],
                    'courtdate' => $data['courtdate']
        ]);
    }

}
