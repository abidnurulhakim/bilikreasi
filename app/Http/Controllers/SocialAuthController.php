<?php

namespace App\Http\Controllers;

use App\Services\SocialAccountService;
use Illuminate\Http\Request;
use Socialite;

class SocialAuthController extends Controller
{
    public function facebookRedirect()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function facebookCallback(SocialAccountService $service)
    {
        $user = $service->createOrGetUser(Socialite::driver('facebook')->user(), 'facebook');

        auth()->login($user, true);

        return redirect()->route('user.show', $user);
    }

    public function googleRedirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function googleCallback(SocialAccountService $service)
    {
        $user = $service->createOrGetUser(Socialite::driver('google')->user(), 'google');

        auth()->login($user, true);

        return redirect()->route('user.show', $user);
    }
}
