<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public static function register($attributes = [])
    {
        $user = new User();
        $user->fill($attributes);
        $user->password = $attributes['password'];
        if ($user->save()) {
            self::authenticate($user, false);
            return $user;
        }
        return null;
    }

    public static function login($usernameOrEmail, $password, $remember = false)
    {
        $user = User::where('email', $usernameOrEmail)->orWhere('username', $usernameOrEmail)->first();
        if ($user && \Hash::check($password, $user->password)) {
            self::authenticate($user, $remember);
            return $user;
        }
        return $user;
    }

    public static function changePassword(User $user, $oldPassword, $password)
    {
        if ($user && \Hash::check($oldPassword, $user->password)) {
            $user->password = $password;
            return $user->save();
        }
        return false;
    }

    private static function authenticate(User $user, $remember = false)
    {
        \Auth::login($user, $remember);
    }
}