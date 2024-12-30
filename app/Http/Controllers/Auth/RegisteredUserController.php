<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\frontend\Customer;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'firstName' => 'required|string|max:255',
            'email' => 'required|email|string|lowercase|email|max:255|unique:' . User::class,
            'password' => [
                'required',
                'confirmed'
            ],
            'phoneNo' => 'required|numeric',
            'lastName' => 'required|string|max:255',
        ], [
            'password.regex' => 'The password must be at least 10 characters long, contain at least one uppercase letter, one lowercase letter, one number, and one special character (e.g., @$!%*?&).',
        ]);
       
        $user = User::create([
            'name' => $request->firstName,
            'last_name' => $request->lastName,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'mobile_no'=> $request->phoneNo,
        ]);
        Customer::create(['user_id'=> $user->id]);
        
        event(new Registered($user));

        Auth::login($user);

        return to_route('home')->with('success', 'You have registered successfully');
    }
}
