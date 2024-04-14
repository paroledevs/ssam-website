<?php

namespace App\Http\Controllers\Dashboard;

use App\Asteroide\Facades\Monitor;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin')
            ->except('logout');
    }

    /**
     * Where to redirect users after login.
     */
    protected function redirectTo()
    {
        return route('users.index');
    }

    protected function showLoginForm()
    {
        return view('admin.login');
    }

    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('admin')->attempt($credentials, $remember = true)) {
            $user = Auth::guard('admin')->user();

            Monitor::auditAuth($user)->addDescription('Successful login');

            $token = Str::random(80);

            $user->forceFill([
                'api_token' => $token,
            ])->save();

            $request->session()->put('api_token', $token);

            return redirect()->intended($this->redirectTo());
        }

        Monitor::auditAuth()->addDescription('Login failed, bad credentials');

        $errors = (new MessageBag)->add('Email', 'These credentials do not match our records.');

        return back()->withErrors($errors);
    }

    public function logout()
    {
        Monitor::auditAuth(Auth::guard('admin')->user())->addDescription('Session ended');

        Auth::guard('admin')->logout();

        return redirect()->route('admin.login');
    }
}
