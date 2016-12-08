<?php

namespace App\Services;

use App\Models\User as User;
use App\Models\SocialAccount;
use Laravel\Socialite\Contracts\User as ProviderUser;

class SocialAccountService
{
    public function createOrGetUser(ProviderUser $providerUser, $provider = 'facebook')
    {
        $account = SocialAccount::whereProvider($provider)
            ->whereProviderUserId($providerUser->getId())
            ->first();

        if ($account) {
            return $account->user;
        } else {

            $account = new SocialAccount([
                'provider_user_id' => $providerUser->getId(),
                'provider_token' => $providerUser->token,
                'provider' => 'facebook'
            ]);

            $user = User::whereEmail($providerUser->getEmail())->first();

            if (!$user) {
                $user = new User();
                $user->email = $providerUser->getEmail();
                $user->name = $providerUser->getName();
                $user->password = 'bilikreasiok';
                $user->gender = 'male';
                $user->confirmed = true;
                if (!empty($providerUser->getAvatar())) {
                    $img = \Image::make($providerUser->getAvatar());
                    $filename = 'storage/'.$user->attachmentable['photo']['path']['storage']."/".uniqid().'.jpg';
                    $img->save($filename);
                    $user->photo = $filename;
                }
                $user->save();
            }

            $account->user()->associate($user);
            $account->save();

            return $user;

        }

    }
}