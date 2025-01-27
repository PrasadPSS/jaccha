<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\backend\LoginManagement;
use App\Models\frontend\Customer;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Services\phpMailerService;
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
        $registerEnabled = LoginManagement::first()->login_management_signup;
        if(!$registerEnabled)
        {
            return redirect()->back()->with('error', 'Registration is currently disabled please try again later');
        }
        $request->validate([
            'firstName' => 'required|alpha:ascii|max:255',
            'email' => 'required|email|string|lowercase|email|max:255|unique:' . User::class,
            'password' => [
                'required',
                'confirmed',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&#])[A-Za-z\d@$!%*?&#]{8,}$/'
            ],
            'mobile_no' => 'required|numeric|unique:' . User::class,
            'lastName' => 'required|alpha:ascii|string|max:255',
        ], [
            'password.regex' => '',
            'password.confirmed' => 'Password Field does not match Confirm Password field'
        ]);
  
        $user = User::create([
            'name' => $request->firstName,
            'last_name' => $request->lastName,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'mobile_no'=> $request->phoneNo,
        ]);

        $phpMailer = new phpMailerService();
        $phpMailer->sendMail($request->email, 'Registration Success', 'Your account has been created successfully', 'Your account has been created successfully');

        event(new Registered($user));

        Auth::login($user);

        return to_route('home')->with('success', 'You have registered successfully');
    }
}
