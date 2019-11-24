<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use \App\User;
use Auth;
class AuthController extends Controller
{
    public function redirectToFacebook(){
        return Socialite::driver('facebook')->redirect();
    }

    public function getFacebookCallback(){
        $data = Socialite::driver('facebook')->user();
        $user = User::where('email',$data->email)->first();

        if(!is_null($user)){
            Auth::login($user);
            $user->name = $data->user['name'];
            $user->facebook_id = $data->id;
            $user->save();
        }else{
            $user = User::where('facebook_id',$data->id)->first();
            if(!is_null($user)){
                $user = new User();
                $user->name = $data->user['name'];
                $user->email = $data->email;
                $user->facebook_id = $data->id;
                $user->save();
            }

            Auth::login($user);
        }

        return redirect(route('/'))->with('success','Successfully logged in!');
    }

    public function redirectToGoogle(){
        return Socialite::driver('google')->redirect();
    }

    public function getGoogleCallback(){
        $data = Socialite::driver('google')->user();
        $user = User::where('email',$data->email)->first();

        if(!is_null($user)){
            Auth::login($user);
            $user->name = $data->user['name'];
            $user->google_id = $data->id;
            $user->save();
        }else{
            $newUser = User::where('google_id',$data->id)->first();
            if(!is_null($newUser)){
                $newUser = new User();
                $newUser->name = $data->user['name'];
                $newUser->email = $data->email;
                $newUser->google_id = $data->id;
                $newUser->save();
            }

            Auth::login($newUser);
        }

        return redirect(route('/'))->with('success','Successfully logged in!');
    }
}
