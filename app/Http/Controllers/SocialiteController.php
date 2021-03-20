<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
      
            $user = Socialite::driver('google')->user();
            
            Auth::login(User::updateOrCreate(
                    [
                        'email' => $user->getEmail(),
                    ],
                    [
                        'google_id' => $user->getId(),
                        'nama' => $user->getName(),
                        'username' => $user->getNickname() ?? '-',
                        'updated_at' => now()
                    ]
                )
            );

            return redirect()->route('home');
      
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
