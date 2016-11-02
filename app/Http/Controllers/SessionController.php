<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserRequest as UserRequest;
use App\Models\User as User;


class SessionController extends Controller
{
    public function signin(Request $request)
    {
        # code...
    }

    public function signup(UserRequest $request)
    {
        $request->merge(['last_login_at' => \Carbon::now(), 'last_login_ip_address' => $request->ip()]);
        $user = User::create($request->all());
        if ($user->id) {
            return 'berhasil';
        }
    }

    public function signout()
    {
        return redirect()->route('home');
    }
}
