<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\RegisterRequest;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->middleware('auth', ['except' => [
            'login', 'register'
        ]]);
        $this->middleware('guest', ['except' => [
            'logout'
        ]]);
    }

    public function login(LoginRequest $request)
    {
        $user = UserService::login($request->get('username'), $request->get('password'), $request->get('remember_me'));
        if ($user) {
            \Session::flash('success', "Anda masuk sebagai $user->name");
            return redirect()->route('user.show', $user);
        }
        \Session::flash('error', "Username dan password tidak sesuai");
        return redirect()->route('home.login');
    }

    public function register(RegisterRequest $request)
    {
        $request->merge(['last_login_at' => \Carbon::now(), 'last_login_ip_address' => $request->ip()]);
        $user = UserService::register($request->all());
        if ($user) {
            \Session::flash('success', "Anda masuk sebagai $user->name");
            return redirect()->route('user.show', $user);
        }
        return redirect()->route('home.register');
    }

    public function logout()
    {
        \Auth::logout();
        \Session::flash('info', 'Terima kasih');
        return redirect()->route('home.index');
    }
}
