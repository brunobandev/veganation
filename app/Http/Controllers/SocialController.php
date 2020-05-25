<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Validator,Redirect,Response,File;
use Socialite;
use Carbon\Carbon;
use App\User;

class SocialController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        $getInfo = Socialite::driver($provider)->stateless()->user();

        $user = $this->createUser($getInfo,$provider);

        auth()->login($user);

        return redirect()->to('/home');

    }

    function createUser($getInfo,$provider){

        $user = User::where('email', $getInfo->email)->first();

        if (!$user) {
            $user = User::create([
                'name' => $getInfo->name,
                'email' => $getInfo->email,
                'provider' => $provider,
                'provider_id' => $getInfo->id,
                'avatar' => $getInfo->avatar,
                'email_verified_at' => Carbon::now(),
                'password' => Hash::make(Str::random(10)),
            ]);
        }
        return $user;
    }
}
