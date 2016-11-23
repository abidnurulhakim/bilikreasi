<?php

namespace App\Services;

use App\Models\User;
use App\Models\UserSkill;
use App\Models\UserInterest;

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
        if ($user && decrypt($user->password) == $password) {
            self::authenticate($user, $remember);
            return $user;
        }
        return $user;
    }

    public static function changePassword(User $user, $oldPassword, $password)
    {
        if (decrypt($user->password) == $oldPassword) {
            $user->password = $password;
            return $user->save();
        }
        return false;
    }

    public static function updateSkill(User $user, $skills = [])
    {
        DB::transaction(function () {
            $user->skills()->delete();
            foreach ($skills as $skill) {
                if (!empty($skill)) {
                    $user = UserSkill::create(['user_id' => $user->id, 'name' => $skill]);
                    if (is_null($user->id)) {
                        DB::rollback();
                    }
                }
            }
        });
        DB::commit();
    }

    public static function updateInterest(User $user, $interests = [])
    {
        DB::transaction(function () {
            $user->interests()->delete();
            foreach ($interests as $interest) {
                if (!empty($interest)) {
                    $user = UserInterest::create(['user_id' => $user->id, 'name' => $interest]);
                    if (is_null($user->id)) {
                        DB::rollback();
                    }
                }
            }
        });
        DB::commit();
    }

    private static function authenticate(User $user, $remember = false)
    {
        \Auth::login($user, $remember);
    }
}