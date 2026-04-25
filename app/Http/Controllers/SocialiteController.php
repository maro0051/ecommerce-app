<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class SocialiteController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $socialiteUser = Socialite::driver('google')->user();
        
        $existingUser = User::where('email', $socialiteUser->getEmail())->first();
        
        if ($existingUser) {
            Auth::login($existingUser);
        } else {
            $newUser = User::create([
                'name' => $socialiteUser->getName(),
                'email' => $socialiteUser->getEmail(),
                'password' => bcrypt(uniqid()),
                'role' => 'customer',
            ]);
            Auth::login($newUser);
        }
        
        return redirect('/');
    }

    public function redirectToApple()
    {
        return Socialite::driver('apple')->redirect();
    }

    public function handleAppleCallback()
    {
        $socialiteUser = Socialite::driver('apple')->user();
        
        $existingUser = User::where('email', $socialiteUser->getEmail())->first();
        
        if ($existingUser) {
            Auth::login($existingUser);
        } else {
            $newUser = User::create([
                'name' => $socialiteUser->getName() ?? 'Apple User',
                'email' => $socialiteUser->getEmail(),
                'password' => bcrypt(uniqid()),
                'role' => 'customer',
            ]);
            Auth::login($newUser);
        }
        
        return redirect('/');
    }
}