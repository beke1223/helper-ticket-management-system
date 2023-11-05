<?php
namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GithubAuthController extends Controller
{
    public function GithubAuthUser()
    {
        // Redirect the user to GitHub for authentication
        return Socialite::driver('github')->redirect();
    }

    public function GithubAuthentication()
    {
        try {
            // Retrieve user data from GitHub
            $githubUser = Socialite::driver('github')->user();
        } catch (\Exception $e) {
            // Handle any exceptions, such as InvalidStateException, here
            return redirect('/login')->with('error', 'GitHub authentication failed.');
        }

        // Check if a user with this GitHub email already exists in your database
        $user = User::where('email', $githubUser->email)->first();

        if (!$user) {
            // If the user doesn't exist, create a new user
            $user = User::create([
                'name' => $githubUser->name,
                'email' => $githubUser->email,
                'password' => bcrypt('password'), // You should generate a secure password
            ]);
        }

        // Log in the user
        Auth::login($user);

        return redirect('/dashboard');
    }
}

?>