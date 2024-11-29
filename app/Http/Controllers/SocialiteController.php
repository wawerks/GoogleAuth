<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Exception; // Ensure Exception class is imported

class SocialiteController extends Controller
{
    /**
     * Function: google login
     * description: this function will redirect to google
     * @param NA
     * @return void
     */
    public function googleLogin()
    {
        return Socialite::driver('google')
                        ->scopes(['profile', 'email'])  // Request only profile and email
                        ->redirect();
    }
    
    
    /**
     * Handle Google callback.
     */
    public function googleAuthentication()
{
    try {
        // Retrieve the user's information from Google
        $googleUser = Socialite::driver('google')->user();

        // Check if the user is already registered
        $user = User::where('google_id', $googleUser->id)
                    ->orWhere('email', $googleUser->email)
                    ->first();

        if ($user) {
            // Log in the existing user
            Auth::login($user);
            return redirect()->route('dashboard');
        } else {
            // Create a new user if not found
            $userData = User::create([
                'name' => $googleUser->name,
                'email' => $googleUser->email,
                'password' => Hash::make(Str::random(16)), // Random password for new users
                'google_id' => $googleUser->id,
                'profile_image' => $googleUser->avatar,
            ]);

            // Log in the new user
            Auth::login($userData);
            return redirect()->route('dashboard');
        }
    } catch (Exception $e) {
        \Log::error('Google Authentication Error: ' . $e->getMessage());
        return redirect()->route('login')->with('error', 'Authentication failed. Please try again.');
    }
}

        
}
