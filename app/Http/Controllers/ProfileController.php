<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\backend\District;
use App\Models\frontend\ShippingAddresses;
use App\Models\frontend\User;
use App\Services\phpMailerService;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): Response
    {
        return Inertia::render('Profile/Edit', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
           
        ]);
    }

    public function viewBasic(Request $request): Response
    {
        $data['shipping_address'] = ShippingAddresses::where('user_id',auth()->user()->id)->where('default_address_flag', 1)->first();
        return Inertia::render('Frontend/Profile/ViewBasic', $data);
    }

    public function changePassword()
    {
        return Inertia::render('Frontend/Profile/ChangePassword');
    }

    public function viewProfile(Request $request)
    {
        $data['shipping_addresses'] = ShippingAddresses::where('user_id', auth()->user()->id)->get();
        if(session('url.intended') == null)
        {
            session(['url.intended' => $request->route()->getName()]);
        }
        
        return Inertia::render('Frontend/Profile/ViewProfile', [
            'shipping_addresses'=> $data['shipping_addresses'],
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
            'districts'=> District::all(),
       
            
        ], );
    }

    public function customerUpdate(Request $request)
    {
        // Validate customer data
        $customerValidated = $request->validate([
            'flat_no' => 'nullable|string|max:255',
            'building_name' => 'nullable|string|max:255',
            'address1' => 'nullable|string|max:255',
            'address2' => 'nullable|string|max:255',
            'pin_code' => 'nullable|max:10', // Or use `numeric` depending on your needs
            'shipping_address' => 'nullable|string',
            'billing_address' => 'nullable|string',
        ]);

        // Check if the user has a customer
       

        // Redirect back to the profile edit page
        return Redirect::route('profile.view');
    }


    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();


        return Redirect::route('profile.view')->with('success', 'Your profile has been updated.');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function sendOtp()
    {
        // Ensure the user is authenticated
        try {
            $user = Auth::user();
            if (!$user) {
                return response()->json(['success' => false, 'message' => 'User not authenticated'], 401);
            }

            // Generate a 6-digit OTP
            $otp = random_int(100000, 999999);


            // Save the OTP to the user's otp column
            $user->otp = $otp;
            $user->save();
            $email= $user->email;
            $subject = 'reset passoword';
            $body = 'Otp to reset password for jaccha is' . $otp;
            $phpMailerService = new phpMailerService();
            $phpMailerService->sendMail($email,$subject, $body, $body);
            // Optionally, send the OTP to the user via email or SMS
            // Example: Using Laravel Notification or Mail
            // Ensure SendOtpNotification exists

            return response()->json(['success' => true, 'message' => 'OTP sent successfully']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function checkOtp(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'otp' => 'required|numeric|digits:6',
            'password' => 'required|string|min:8|confirmed|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{10,}$/',
        ]);

        $user = Auth::user(); // Get the currently authenticated user
        
        // Check if the OTP matches the user's OTP column
        if ($user->otp != $request->otp) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid OTP.',
            ], 422);
        }

        // Update the user's password and clear the OTP column
        $user->update([
            'password' => Hash::make($request->password),
            'otp' => null, // Clear the OTP after successful verification
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Password updated successfully.',
        ]);
    }

    public function forgotPassword()
    {
        return Inertia::render('Frontend/Profile/ForgotPassword');
    }

    public function sendResetLink(Request $request)
    {
        
        if($request->email == "")
        {
            info($request->email);
            return back()->with('error', 'Email Field is required.');
        }
        $exists = User::where('email', $request->email)->exists();
        if(!$exists)
        {
            return back()->with('error', 'Account does not exist for given email.');
        }
        
        $resetToken = str()->random(10);
        $userEmail = $request->email;
        $url = 'Click on this link to reset your password for Jaccha: ' . url('/') . route('profile.resetpassword', [], false) 
    . '?' . http_build_query([
        'token' => $resetToken,
        'email' => $userEmail
    ]);
        User::where('email', $userEmail)->update(['password_reset_token' => $resetToken]);
        $phpMailerService = new phpMailerService();
        $phpMailerService->sendMail($userEmail, 'Reset Password', $url, $url);
        return back()->with('success', 'Reset password link sent to ' . $request->email . " check email for furthur instructions");
        
    }

    public function resetPassword()
    {
        return Inertia::render('Frontend/Profile/ResetPassword');
    }

    public function updatePassword(Request $request)
    {
        
        $userToken = User::where('email', $request->email)->first()->password_reset_token;
        if($request->token == $userToken)
        {   
            $exists = User::where('email', $request->email)->exists();
            $user = User::where('email', $request->email)->first();
            if($exists)
            {
                if (Hash::check($request->password, $user->password)) {
                    return back()->with('error', 'The new password must be different from your current password.');
                }
            }
            
         
            if($request->password != $request->confirm_password)
            {
                return back()->with('error', 'Password and Confirm Password does not match');
            }

            User::where('email', $request->email)->update(['password'=>Hash::make($request->password)]);
            User::where('email', $request->email)->update(['password_reset_token'=>null]);
            return back()->with('success', 'Your Password Has Been Reset Successfully');
        }
        return back()->with('error', 'Invalid Url Please Try Again');
    }
}
