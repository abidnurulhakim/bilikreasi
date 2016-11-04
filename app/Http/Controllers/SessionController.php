<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\RegisterRequest;
use App\Models\User;


class SessionController extends Controller
{
    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->input('username'))->orWhere('username', $request->input('username'))->first();
        if ($user && \Hash::check($request->input('password'), $user->getOriginal('password'))) {
            \Auth::login($user);
            return redirect()->route('home.index');
        }
        return redirect()->route('home.login');
    }

    public function register(RegisterRequest $request)
    {
        $request->merge(['last_login_at' => \Carbon::now(), 'last_login_ip_address' => $request->ip()]);
        $user = User::create($request->all());
        if ($user->id) {
            \Auth::login($user);
            return redirect()->route('home.index');
        }
    }

    public function logout()
    {
        \Auth::logout();
        return redirect()->route('home.index');
    }
}
