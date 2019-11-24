<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function getFacebookCallback()
    {
        $data = Socialite::driver('facebook')->user();
        $user = User::where('email', $data->email)->first();

        if (!is_null($user)) {
            Auth::login($user, true);
            $user->name = $data->user['name'];
            $user->facebook_id = $data->id;
            $user->save();
        } else {
            $user = new User();
            $user->name = $data->user['name'];
            $user->email = $data->email;
            $user->facebook_id = $data->id;
            $user->save();

            Auth::login($user, true);
        }

        return redirect(route('home'))->with('success', 'Successfully logged in!');
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function getGoogleCallback()
    {
        $data = Socialite::driver('google')->user();
        $user = User::where('email', $data->email)->first();

        if (!is_null($user)) {
            Auth::login($user, true);
            $user->name = $data->user['name'];
            $user->google_id = $data->id;
            $user->save();
        } else {
            $newUser = new User();
            $newUser->name = $data->user['name'];
            $newUser->email = $data->email;
            $newUser->google_id = $data->id;
            $newUser->save();

            Auth::login($newUser, true);
        }

        return redirect(route('home'))->with('status', 'Successfully logged in!');
    }
}
