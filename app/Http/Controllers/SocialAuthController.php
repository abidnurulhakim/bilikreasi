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

        auth()->login($user);

        return redirect()->route('home.index');
    }
}
