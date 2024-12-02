<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\backend\HomePageSections;
use App\Models\backend\Orders;
use App\Models\frontend\Customer;
use App\Models\frontend\User;
use App\Models\OrderItem;
use App\Models\PaymentDetail;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;

class GoogleLoginController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')
    ->stateless()
    ->with(['prompt' => 'select_account'])
    ->redirect();
    }


    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->stateless()->setHttpClient(new \GuzzleHttp\Client(['verify' => false]))->user();
        $user = User::where('email', $googleUser->email)->first();
        if(!$user)
        {
            $user = User::create(['name' => $googleUser->name, 'email' => $googleUser->email, 'password' => \Hash::make(rand(100000,999999)),'provider' => 'google', 'provider_id' => $googleUser->id]);
            Customer::create(['user_id'=> $user->id]);
        }

        Auth::login($user);

        return redirect()->route('home');
    }
}