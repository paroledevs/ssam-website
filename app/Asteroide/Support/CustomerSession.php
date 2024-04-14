<?php

namespace App\Asteroide\Support;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CustomerSession
{
    public $password;

    public $customer;

    public function __construct($password, $customer)
    {
        $this->password = $password;
        $this->customer = $customer;
    }

    protected function guard()
    {
        return Auth::guard('shop');
    }

    public function setPassword()
    {
        $this->customer->password = Hash::make($this->password);
        $this->customer->save();

        return $this;
    }

    public function credentials()
    {
        return [
            'email' => $this->customer->email,
            'password' => $this->password,
        ];
    }

    public function login()
    {
        if ($auth = $this->guard()->attempt($this->credentials(), $remember = true)) {
            $token = Str::random(80);

            $this->customer->forceFill([
                'api_token' => $token,
            ])->save();
        }

        return $auth;
    }

    public static function configure($password, $customer)
    {
        return (new CustomerSession($password, $customer))->setPassword();
    }
}
