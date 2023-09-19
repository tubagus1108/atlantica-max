<?php

namespace App\Providers;

use Illuminate\Auth\EloquentUserProvider as UserProvider;
use Illuminate\Contracts\Auth\Authenticatable as UserContract;


class AuthValidateStatusServiceProvider extends UserProvider {

    /**
     * Overrides the framework defaults validate credentials method 
     *
     * @param UserContract $user
     * @param array $credentials
     * @return bool
     */
    public function validateCredentials(UserContract $user, array $credentials)
    {
        $plain = $credentials['passwd'];
        $hashed = $user->getAuthPassword();

        // Memeriksa apakah password yang diberikan sesuai dengan hash MD5 yang disimpan di database
        return $plain === $hashed;
    }


}