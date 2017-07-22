<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectPath = '/home';

    /**
     * Redirect user to OAuth Provider.
     *
     * @param $provider
     * @return Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from provider. check if user already
     * exists in our db by looking up their provider_id in the db.
     * If user exists, log them in. Otherwise, create a new user then log them in.
     * After login, redirect them to the authenticated users homepage.
     *
     * @param $provider
     * @return Response
     */
    public function handleProviderCallback($provider)
    {
        try {
            $user = Socialite::driver($provider)->user();
        } catch (Exception $e) {
            return redirect("auth/$provider");
        }
        $authUser = $this->findOrCreateUser($user, $provider);
        Auth::login($authUser, true);

        return redirect($this->redirectPath);
    }

    /**
     * If a user has registered before using social auth, return the user
     * else, create a new user object.
     *
     * @param $user Socialite user object
     * @param $provider Social auth provider
     * @return User
     */
    public function findOrCreateUser($user, $provider)
    {
        $authUser = User::where('provider_id', $user->id)->first();
        if ($authUser) {
            return $authUser;
        }

        return User::create([
            'name'        => $user->name,
            'handle'      => $user->nickname,
            'provider'    => $provider,
            'provider_id' => $user->id,
            'avatar'      => $user->avatar_original,
        ]);
    }

}
