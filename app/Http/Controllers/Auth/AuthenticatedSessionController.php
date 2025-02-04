<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\backend\LoginManagement;
use App\Models\frontend\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Login', [
            'canResetPassword' => Route::has('password.request'),
            'status' => session('status'),
        ]);
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $loginEnabled = LoginManagement::first()->login_management_login;
        if(!$loginEnabled)
        {
            return redirect()->back()->with('error', 'Login is currently disabled please try again later');
        }
        $exists = User::where('email', $request->email)->exists();
        if($exists)
        {$user = User::where('email', $request->email)->first()->account_status;
            if($user == 0)
            {
                return redirect()->back()->with('error', 'Your account is not active');
            }
        }
        
        $request->authenticate();
        
        
        

        $request->session()->regenerate();

        return redirect()->intended(route('home'))->with('success', 'Logged in successfully');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
