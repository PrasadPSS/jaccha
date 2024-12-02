<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Dotenv\Validator;
use Illuminate\Http\Request;
use App\Models\backend\Cmspages;
use App\Models\backend\Faqs;
use App\Models\frontend\User;
use Illuminate\Support\Facades\Auth;
use App\Models\backend\FrontendImages;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;
use Laravel\Socialite\Facades\Socialite;
use App\Models\backend\LoginManagement;
use App\Models\frontend\Cart;

use Session;
use Redirect;
use PHPMailer\PHPMailer;
use DB;
use Hash;

class UsersController extends Controller
{

  public function login()
  {
    if(!session()->has('url.intended'))
    {
        session(['url.intended' => url()->previous()]);
    }
    if(session('url.intended') == 'guest/emptycart')
    {
        
    }
    // dd(session('url.intended'));
    $login_management = LoginManagement::first();
    if($login_management->login_management_login == 0)
    {
        return redirect()->to('/')->with('error','Logins are temporarily block!');
    }
    $login_image = FrontendImages::where('image_code','login')->first();
    return view('frontend.users.login', compact('login_image','login_management'));
  }

  public function signup()
  {
    $login_management = LoginManagement::first();
    if($login_management->login_management_signup == 0)
    {
        return redirect()->to('/')->with('error','Singups are temporarily block!');
    }
    $signup_image = FrontendImages::where('image_code','signup')->first();
    return view('frontend.users.signup', compact('signup_image','login_management'));
  }

    //store sign up
    public function store(Request $request)
    {
        $this->validate(request(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => [
                'required','confirmed','min:8',
                'regex:/[a-z]/',      // must contain at least one lowercase letter
                'regex:/[A-Z]/',      // must contain at least one uppercase letter
                'regex:/[0-9]/',      // must contain at least one digit
                'regex:/[@$!%*#?&]/', // must contain a special character
            ],
            'mobile_no' => 'required|unique:users|min:10',
            'gender' => 'required',
        ],
        [
            'password.regex'=>'Password must contain at least one lowercase letter, at least one uppercase letter, at least one digit, a special character',
        ]
        );
        // echo "string";exit;
        $user = new User();
        $current_year = date('y');
        $current_date = date('d');
        $current_month = date('m');
        if($user->fill($request->all())->save())
        {
            $current_user = User::find($user->id);
            auth()->login($current_user);
            try 
            {
                $email = $request->email;

                $mail = new PHPMailer\PHPMailer();
                $mail->IsSMTP();
                $mail->CharSet = "utf-8";// set charset to utf8
                // $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
                // $mail->SMTPAuth = true; // authentication enabled
                // $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for Gmail
                // $mail->Host = "smtp.gmail.com";
                // $mail->Port = 587; // or 465
                // $mail->Username = "testesatwat@gmail.com";
                // $mail->Password = 'Esatwat@0000';

                //for live start
                $mail->Host       = "localhost";
                $mail->SMTPSecure = "tls";
                $mail->SMTPDebug  = 0;
                $mail->SMTPAuth   = false;
                $mail->Mailer     ="smtp";
                $mail->Port       = 25;
                $mail->Username = "";
                $mail->Password = '';
                //for live end

                //for local start
                // $mail->SMTPAuth = true; // authentication enabled
                // $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for Gmail
                // $mail->Host = "smtp.gmail.com";
                // $mail->Port = 587; // or 465
                // $mail->Username = "testesatwat@gmail.com";
                // $mail->Password = 'Esatwat@0000';
                //for local end

                $mail->SMTPOptions = array(
                    'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                    )
                );
                $mail->isHTML(true);
                $mail->SetFrom('info@dadreeios.com', 'Dadreeios');
                $mail->AddBCC("maheshm@parasightsolutions.com");
                $mail->AddAddress($email);
                $mail->Subject = "Welcome to Dadreeios";
                $mail->Body = "
                    <html>
                    <head>

                    </head>
                    <body><div style='margin:auto;'><a href='http://dadreeios.com/'><img src='https://dadreeios.com/backend-assets/uploads/frontend_images/165337789455.png' width='120'></a></div>
                    <h2 style='color:#333;'>Dadreeios</h2><h4 style='color:#333;'>Namaste ".$current_user->name." Thank you for sign up at www.dadreeios.com portal. Enjoy a World-Class Online Shopping Journey at Dadreeios.com Regards Dadreeios Team G.R. Parwani Trading Co.</h4></body></html>
                ";
                $mail->Send();
            } catch (phpmailerException $e) {
                echo $e->errorMessage();
            } catch (Exception $e) {
                echo $e->getMessage();
            }

            if(isset($current_user->mobile_no) && $current_user->mobile_no != "" && strlen($current_user->mobile_no)==10)
            {
                $mobile_no = $current_user->mobile_no;
                $message = "Namaste ".$current_user->name."\nThank you for sign up at www.dadreeios.com portal.\nEnjoy a World-Class Online Shopping Journey at Dadreeios.com \nRegards \nDadreeios Team \nG.R. Parwani Trading Co.";
                // $message="Namaste ".$current_user->name.". Thank you for sign up at www.dadreeios.com portal. Enjoy a World-Class Online Shopping Journey at Dadreeios.com Regards, Dadreeios Team G.R. Parwani Trading Co.";
                $message_url = urlencode($message);
                $sms_api=send_sms($mobile_no, $message);
                $sms_api_response = json_decode($sms_api,true);
                // dd($sms_api_response);
                $current_user->user_signup_sms = (isset($sms_api_response['ErrorCode']) && $sms_api_response['ErrorCode'] == 0 && $sms_api_response['ErrorDescription'] == 'Success')?1:0;
                $current_user->update();

                $otp = mt_rand(1000, 9999);
                $otp_time_stamp = date('Y-m-d h:i:s');
                $otp_message = "Dear ".$current_user->name."\nYour Mobile Phone Number Verification Code for Sign up at www.dadreeios.com portal is ".$otp." Valid for 10 minutes. Please do not disclose it to anybody. \nRegards \nDadreeios Team \nG.R. Parwani Trading Co.";
                $otp_sms_api=send_sms($mobile_no, $otp_message);

                $current_user->otp=$otp;
                $current_user->otp_time_stamp = $otp_time_stamp;
                $current_user->save();
            }
            // Session::flash('success','Sign UP Successfully');
            // return redirect()->to('/myaccount')->with('success','Sign UP Successfully');->with('success','Sign UP Successfully')
            return redirect()->to('/signupotp');
        }
        else
        {
            return redirect()->to('/signup');
        }

    }
    
    public function profileotp(Request $request)
    {
        $mobile_no = auth()->user()->mobile_no;
        $user_id = auth()->user()->id;
        $current_user = User::find(auth()->user()->id);
        if(isset($current_user->mobile_no) && $current_user->mobile_no != "" && strlen($current_user->mobile_no)==10)
        {
            $otp = mt_rand(1000, 9999);
            $otp_time_stamp = date('Y-m-d h:i:s');
            $otp_message = "Dear ".$current_user->name."\nYour Mobile Phone Number Verification Code for Sign up at www.dadreeios.com portal is ".$otp." Valid for 10 minutes. Please do not disclose it to anybody. \nRegards \nDadreeios Team \nG.R. Parwani Trading Co.";
            $otp_sms_api=send_sms($mobile_no, $otp_message);

            $current_user->otp=$otp;
            $current_user->otp_time_stamp = $otp_time_stamp;
            $current_user->save();
            return ['status'=>'success','message'=>'OTP sent to your mobile number'];
        }
        else
        {
            return ['status'=>'error','message'=>'Invalid Mobile Number'];
        }
        
    }

    //login
    public function loginstore()
    {
        // $this->validate(request(), [
        //     'email' => 'required',
        //     'password' => 'required',
        // ]);

       if (auth()->attempt(request(['email', 'password'])) == false)
       {
         // return Redirect::to('loginpassword',['request'=>request()]);
         return redirect()->to('login')->withErrors([
             'message' => 'Please enter a valid email id and password'
         ]);
           // return back()->withErrors([
           //     'message' => 'The Email or password is incorrect, please try again'
           // ]);
       }
       if(auth()->user()->account_status == 0)
       {
         Session::flash('message', 'Your account has been deactivated, Please contact Dadreeios customer care team to reactivate your account.');
         auth()->logout();
         return redirect()->to('login')->withErrors([
             'message' => 'Your account has been deactivated, Please contact Dadreeios customer care team to reactivate your account.'
         ]);
         // return back()->withErrors([
         //     'message' => 'Account Deactive ! Please Contact Support Team To Activate Your Account.'
         // ]);
       }
       if(session()->has('cart'))
       {
            return redirect('/movetocart');
            // return redirect(session('link'));
            // return redirect()->to('/movecart')->with('success','Login Successfully');
       }
        //    return redirect()->to('/')->with('success','Login Successfully');
        $intended_url = (session()->has('url.intended'))?session('url.intended'):'/';
        session()->forget('url.intended');
       return redirect($intended_url)->with('success','Login Successfully');
       // return redirect()->to('/myaccount')->with('success','Login Successfully');
    }

    public function logout()
    {
      auth()->logout();
      // Session::flash('success','Logged out Successfully1');
      return redirect()->to('/')->with('success','Logged out Successfully');
    }

    public function loginpassword(Request $request)
    {
      $this->validate(request(), [
          'email' => 'required',
      ]);
      $email = $request->email;
      $current_user = User::where('email',$email)->first();
      if ($current_user)
      {
        if($current_user->account_status == 0)
        {
          return back()->withErrors([
              'message' => 'Your account has been deactivated, Please contact Dadreeios customer care team to reactivate your account.'
          ]);
        }
        return view('frontend.users.login_password',compact('email'));
      }
      else
      {
        return back()->withErrors([
            'message' => 'Please enter a valid email id to continue'
        ]);
      }
      // return redirect()->route('passwordform',['email'=>$email]);
      // view('frontend.users.login_password',compact('email'));
    }

    // public function passwordform($email)
    // {
    //   return view('frontend.users.login_password',compact('email'));
    // }

    public function forgotpassword()
    {

      return view('frontend.users.forgot_password');
    }


    public function sendotp(Request $request)
    {
        // dd($request->all());

        $this->validate(request(), [
            'mobile_no' => 'required',
        ]);
        $user=User::where('mobile_no',$request->mobile_no)->first();
        if($user==null){
            return redirect()->route('forgotpassword')->withErrors(['Inavlid mobile number !!!Please Try with Valid Mobile Number']);
        }
        // try 
        // {
        //     $email = $request->mobile_no;
        //     $otp = mt_rand(1000, 9999);
        //     //return $otp;
        //     $mail = new PHPMailer\PHPMailer();
        //     $mail->IsSMTP();

        //     $mail->CharSet = "utf-8";// set charset to utf8
        //     //   $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
        //     //for live start
        //     $mail->Host       = "localhost";
        //     $mail->SMTPSecure = "tls";
        //     $mail->SMTPDebug  = 0;
        //     $mail->SMTPAuth   = false;
        //     $mail->Mailer     ="smtp";
        //     $mail->Port       = 25;
        //     $mail->Username = "";
        //     $mail->Password = '';
        //     //for live end

        //     //for local start
        //     // $mail->SMTPAuth = true; // authentication enabled
        //     // $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for Gmail
        //     // $mail->Host = "smtp.gmail.com";
        //     // $mail->Port = 587; // or 465
        //     // $mail->Username = "testesatwat@gmail.com";
        //     // $mail->Password = 'Esatwat@0000';
        //     //for local end
        //     $mail->SMTPOptions = array(
        //         'ssl' => array(
        //             'verify_peer' => false,
        //             'verify_peer_name' => false,
        //             'allow_self_signed' => true
        //         )
        //     );

        //     $mail->isHTML(true);
        //     $mail->SetFrom('info@dadreeios.com','Dadreeios');
        //     $mail->AddAddress($email);
        //     $mail->Subject = "Passowrd Reset OTP";
        //     $mail->Body = 'Password reset OTP is' . ' ' . $otp;
        //     $mail->Send();

        //     Session::put('email',$email);
        //     Session::put('id',$user->id);

        //     if($user->otp!=null){
        //         $user=DB::table('users')
        //                 ->where('email',$email)
        //             ->update(array(
        //                 'otp'=>$otp
        //             ));
        //     }else{
        //         $user->otp=$otp;
        //         $user->save();
        //     }


        //     // return redirect()->route('passwordform',['email'=>$email]);
        //     // view('frontend.users.login_password',compact('email'));
        //     //return view('frontend.users.otp',compact('email'));
        //     return redirect()->route('sendOTP')->with('success', 'OTP sent to your Email account!!! Please check');
        // }
        // catch (phpmailerException $e) {
        //     echo $e->errorMessage();
        // } catch (Exception $e) {
        //     echo $e->getMessage();
        // }



        if(isset($request->mobile_no) && $request->mobile_no != "" && strlen($request->mobile_no) == 10)
        {
            $current_user = User::where('mobile_no',$request->mobile_no)->first();
            // dd($current_user);
            $mobile_no = $current_user->mobile_no;
            $otp = mt_rand(1000, 9999);
            $otp_time_stamp = date('Y-m-d h:i:s');
            $otp_message = "Dear".$current_user->name." Your Mobile Phone Number Verification Code for Sign up at www.dadreeios.com portal is ".$otp." Valid for 10 minutes. Please do not disclose it to anybody{#var#}Regards{#var#}Dadreeios Team{#var#}Parwani Trading Co.";
            $otp_sms_api=send_sms($mobile_no, $otp_message);

            $current_user->otp=$otp;
            $current_user->otp_time_stamp = $otp_time_stamp;
            $current_user->save();
            
            // return redirect()->route('sendOTP')->with('success', 'OTP sent to your Mobile Number!!! Please check','user');
            // dd($user->toArray());
            return redirect()->to('/sendotp/'.$mobile_no)->with('success','Mobile Number Verified Successfully');

            // return view('frontend.users.otp', compact('user'))->with('success', 'OTP sent to your Mobile Number!!! Please check');

            // return redirect('sendOTP',compact('user'))->with('success', 'OTP sent to your Mobile Number!!! Please check');

            // return redirect()->back()->withErrors(['success'=>'OTP sent to your Mobile Number! Please check']);
            // dd($current_user);

        }

    }




    public function resendotp(Request $request)
    {
        if(isset($request->email))
        {
            try {
                $email = Session::get('email');
                $otp = mt_rand(1000, 9999);
                //return $otp;
                $mail = new PHPMailer\PHPMailer();
                $mail->IsSMTP();

                $mail->CharSet = "utf-8";// set charset to utf8
                //$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
                //for live start
                $mail->Host       = "localhost";
                $mail->SMTPSecure = "tls";
                $mail->SMTPDebug  = 0;
                $mail->SMTPAuth   = false;
                $mail->Mailer     ="smtp";
                $mail->Port       = 25;
                $mail->Username = "";
                $mail->Password = '';
                //for live end

                //for local start
                // $mail->SMTPAuth = true; // authentication enabled
                // $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for Gmail
                // $mail->Host = "smtp.gmail.com";
                // $mail->Port = 587; // or 465
                // $mail->Username = "testesatwat@gmail.com";
                // $mail->Password = 'Esatwat@0000';
                //for local end
                $mail->SMTPOptions = array(
                    'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                    )
                );

                $mail->isHTML(true);
                $mail->SetFrom('info@dadreeios.com','Dadreeios');
                $mail->AddAddress($email);
                $mail->Subject = "Passowrd Reset OTP";
                $mail->Body = 'Password reset OTP is' . ' ' . $otp;
                $mail->Send();


                $user=User::where('email',$email)->first();


                if($user->otp!=null){
                    $user=DB::table('users')
                        ->where('email',$email)
                        ->update(array(
                            'otp'=>$otp
                        ));
                }else{
                    $user->otp=$otp;
                    $user->save();
                }

                // return redirect()->route('passwordform',['email'=>$email]);
                // view('frontend.users.login_password',compact('email'));
                return redirect()->route('sendOTP')->with('success', 'OTP sent to your Email account!!! Please check');
            }
            catch (phpmailerException $e) {
                echo $e->errorMessage();
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }
        // else if(isset($request->mobile_no) && $request->mobile_no != "" && strlen($request->mobile_no) == 10)
        // {
        //     $current_user = User::where('id',$request->user_id)->first();
        //     $mobile_no = $current_user->mobile_no;
        //     $otp = mt_rand(1000, 9999);
        //     $otp_time_stamp = date('Y-m-d h:i:s');
        //     $otp_message = "Dear".$current_user->name." Your Mobile Phone Number Verification Code for Sign up at www.dadreeios.com portal is ".$otp." Valid for 10 minutes. Please do not disclose it to anybody{#var#}Regards{#var#}Dadreeios Team{#var#}Parwani Trading Co.";
        //     $otp_sms_api=send_sms($mobile_no, $otp_message);

        //     $current_user->otp=$otp;
        //     $current_user->otp_time_stamp = $otp_time_stamp;
        //     $current_user->save();
        //     return redirect()->back()->withErrors(['success'=>'OTP sent to your Mobile Number! Please check']);
        // }

    }
    public function resendmobileotp(Request $request)
    {
        if(isset($request->mobile_no) && $request->mobile_no != "" && strlen($request->mobile_no) == 10)
        {
            $current_user = User::where('mobile_no',$request->mobile_no)->first();
            $mobile_no = $current_user->mobile_no;
            $otp = mt_rand(1000, 9999);
            $otp_time_stamp = date('Y-m-d h:i:s');
            $otp_message = "Dear".$current_user->name."\nYour Mobile Phone Number Verification Code for Sign up at www.dadreeios.com portal is ".$otp." Valid for 10 minutes. Please do not disclose it to anybody. \nRegards \nDadreeios Team \nG.R. Parwani Trading Co.";
            $otp_sms_api=send_sms($mobile_no, $otp_message);

            $current_user->otp=$otp;
            $current_user->otp_time_stamp = $otp_time_stamp;
            $current_user->save();
            return redirect()->back()->with(['success'=>'OTP sent to your Mobile Number! Please check']);
        }

    }
    public function changeforgotpassword(Request $request)
    {
        //    dd($request);
      $this->validate(request(), [
          'otp' => 'required',
          'mobile_no' => 'required',

      ]);
      $otp = $request->otp;
      $mobile_no = $request->mobile_no;
      $user=User::where('otp',$otp)->where('mobile_no',$mobile_no)->first();
    //   $mobile = $request->mobile_no;
    //   $user=User::where('mobile_no',$mobile)->first();

    //   dd($user);



    if($user) 
    {
    //   dd($user);

        $otpDate = date('Y-m-d h:i:s');
        $otpDate = date('Y-m-d h:i:s', strtotime($otpDate));
        $otpDateBegin = date('Y-m-d h:i:s', strtotime($user->otp_time_stamp));
        $otpDateEnd = date('Y-m-d h:i:s', strtotime($otpDateBegin.' +10 minutes'));
        // echo "<pre>";print_r($otpDate);print_r($otpDateBegin);print_r($otpDateEnd);exit;
        if (($otpDate >= $otpDateBegin) && ($otpDate <= $otpDateEnd))
        {
            $user->verified_mobile_no = 1;
            $user->update();
          return view('frontend.users.change_password',compact('user'));
          

            // return redirect()->to('/myaccount')->with('success','Mobile Number Verified Successfully');
        }
        else
        {
            return redirect()->back()->withErrors(['OTP Expired!']);
        }
        // return view('frontend.users.change_password',compact('user'));
    }
    else
    {
        return redirect()->back()->withErrors(['Invalid OTP!!!Please try with Valid OTP']);
    }





      if($user) {
          return view('frontend.users.change_password',compact('user'));
      }else{
          return redirect()->back()->withErrors(['Invalid OTP!!!Please try with Valid OTP']);
      }

    }

    public function storeforgotpassword(Request $request)
    {

        $this->validate($request,[
        'new-password' => ['required','confirmed',
            Password::min(8)->letters()->numbers()],
        'new-password_confirmation' => ['required'],
    ]);

        $token = Str::random(64);
        $id=Session::get('id');
        $email=Session::get('email');


//        $userdata = DB::table('users')->where('otp',$otp)->first();
//        $userpassword = $userdata->password;
        $new_password = $request->input('new-password');

        $newpassword = Hash::make($new_password);
        DB::table('users')
            ->where('id', $id)
            ->where('email',$email)
            ->update(array(
                'password' => $newpassword,
                'password_reset_token' =>$token,

            ));

     return redirect()->to('/login')->with('success','Password changed Successfully');

    }

    public function socialLogin($social)
    {
        return Socialite::driver($social)->redirect();
    }

    public function callback($social)
    {
        $userSocial = Socialite::driver($social)->stateless()->user();
        $user = User::where(['email' => $userSocial->getEmail()])->first();
        $intended_url = (session()->has('url.intended'))?session('url.intended'):'/';
        if ($user) {
            Auth::login($user);
            $user_id = $user->id;
            $uid = ['user_id' => $user_id];
            if(session()->has('cart') && count(session('cart'))>0)
            {
                foreach (session('cart') as $name => $item) 
                {
                    $previous = Cart::where('user_id', $user_id)->where('product_id','=', $item['product_id'])->get();
                    $previous_data = $previous->toArray();
                    if(count($previous_data) == 0)
                    {
                        $qty = ['qty' => $item['quantity']];
                        $data = array_merge($uid,$item,$qty);
                        $cartobj = new Cart;
                        $cartobj -> fill($data);
                        $cartobj -> save();
                    }
                    else if( count($previous_data) > 0 )
                    {
                        foreach($previous_data as $key => $value){}
                        if(($value['product_id'] == $item['product_id']) && ($value['product_variant_id'] == $item['product_variant_id']) &&  ($value['product_type'] == $item['product_type']) )
                        {
                            $quantity =['qty' => $value['qty']+$item['quantity']] ;
                            $cart_id = ['id'=> $value['id']];
                            $data = array_merge($uid,$cart_id,$item,$quantity);
                            $cartobj = Cart::find($value['id']);
                            $cartobj -> fill($data);
                            $cartobj -> save();
                        }
                        else
                        {
                            $quantity =['qty' => $item['quantity']] ;
                            $data = array_merge($uid,$item,$quantity);
                            $cartobj = new Cart;
                            $cartobj -> fill($data);
                            $cartobj -> save();
                        }
                    }
                } //end of foreeach
                session()->forget('cart');
                session()->forget('url.intended');
            }
            return redirect()->to($intended_url)->with('success', 'Login Successfully');
            // return redirect()->to('/myaccount')->with('success', 'Login Successfully');
        } else {
            $user = User::create([
                'name'          => $userSocial->getName(),
                'email'         => $userSocial->getEmail(),
                'profile_pic'         => $userSocial->getAvatar(),
                'provider_id'   => $userSocial->getId(),
                'provider'      => $social,
            ]);
            $user_id = $user->id;
            $uid = ['user_id' => $user_id];
            if(session()->has('cart') && count(session('cart'))>0)
            {
                foreach (session('cart') as $name => $item) 
                {
                    $previous = Cart::where('user_id', $user_id)->where('product_id','=', $item['product_id'])->get();
                    $previous_data = $previous->toArray();
                    if(count($previous_data) == 0)
                    {
                        $qty = ['qty' => $item['quantity']];
                        $data = array_merge($uid,$item,$qty);
                        $cartobj = new Cart;
                        $cartobj -> fill($data);
                        $cartobj -> save();
                    }
                    else if( count($previous_data) > 0 )
                    {
                        foreach($previous_data as $key => $value){}
                        if(($value['product_id'] == $item['product_id']) && ($value['product_variant_id'] == $item['product_variant_id']) &&  ($value['product_type'] == $item['product_type']) )
                        {
                            $quantity =['qty' => $value['qty']+$item['quantity']] ;
                            $cart_id = ['id'=> $value['id']];
                            $data = array_merge($uid,$cart_id,$item,$quantity);
                            $cartobj = Cart::find($value['id']);
                            $cartobj -> fill($data);
                            $cartobj -> save();
                        }
                        else
                        {
                            $quantity =['qty' => $item['quantity']] ;
                            $data = array_merge($uid,$item,$quantity);
                            $cartobj = new Cart;
                            $cartobj -> fill($data);
                            $cartobj -> save();
                        }
                    }
                } //end of foreeach
                session()->forget('cart');
                session()->forget('url.intended');
            }
            return redirect()->to($intended_url)->with('success', 'Login Successfully');
            // return redirect()->to('/myaccount');
        }
    }


    /**function for move cart function */
    public function movetocart()
    {
        if(!auth()->user())
        {
            //not logged in go back
            return redirect('/login');
        }
        if(session()->has('cart') && count(session('cart'))< 1)
        {
            return redirect('/');
        }
        //fetch userid
        $user_id = auth()->user()->id;
        $uid = ['user_id' => $user_id];
        // echo "user id is".$user_id;
            //   user cart
        $cart = Cart::where('user_id',$user_id)->with(['products','product_images','product_variant'])->get();
        $intended_url = (session()->has('url.intended'))?session('url.intended'):'/';
        
        //check cart already empty then directly move ithem to the cart
        if(count($cart) ==0 )
        {
            $i=0;
            foreach(session('cart') as $name => $item)
            {
                $qty = ['qty' => $item['quantity']];
                $data = array_merge($uid,$item,$qty);
                $cartobj = new Cart;
                $cartobj->fill($data);
                $cartobj->save();
                $i++;
            }
            if($i== count(session('cart')))
            {
                session()->forget('cart');
                session()->forget('url.intended');
            }
            return redirect()->to($intended_url)->with('success','Login Successfully');
        } //user cart already empty move data directly in the cart function end

        //foreach loop to insert data in cart
        foreach (session('cart') as $name => $item) 
        {
            // print_r($name);
            // echo $item['product_id'];
            $previous = Cart::where('user_id', $user_id)->where('product_id','=', $item['product_id'])->get();
            $previous_data = $previous->toArray();
            if(count($previous_data) == 0)
            {
                $qty = ['qty' => $item['quantity']];
                $data = array_merge($uid,$item,$qty);
                $cartobj = new Cart;
                $cartobj -> fill($data);
                $cartobj -> save();
            }
            else if( count($previous_data) > 0 )
            {
                foreach($previous_data as $key => $value){}
                if(($value['product_id'] == $item['product_id']) && ($value['product_variant_id'] == $item['product_variant_id']) &&  ($value['product_type'] == $item['product_type']) )
                {
                    $quantity =['qty' => $value['qty']+$item['quantity']] ;
                    $cart_id = ['id'=> $value['id']];
                    $data = array_merge($uid,$cart_id,$item,$quantity);
                    $cartobj = Cart::find($value['id']);
                    $cartobj -> fill($data);
                    $cartobj -> save();
                }
                else
                {
                    $quantity =['qty' => $item['quantity']] ;
                    $data = array_merge($uid,$item,$quantity);
                    $cartobj = new Cart;
                    $cartobj -> fill($data);
                    $cartobj -> save();
                }
            }
        } //end of foreeach
        session()->forget('cart');
        session()->forget('url.intended');
        return redirect()->to($intended_url)->with('success','Login Successfully');
    } //end of move to cart function

    public function signupotp()
    {
        $mobile_no = auth()->user()->mobile_no;
        $user_id = auth()->user()->id;
        $login_management = LoginManagement::first();
        if($login_management->login_management_signup == 0)
        {
            return redirect()->to('/')->with('error','Singups are temporarily block!');
        }
        $signup_image = FrontendImages::where('image_code','signup')->first();
        return view('frontend.users.signupotp', compact('signup_image','login_management','mobile_no','user_id'));
    }

    public function verifyotp(Request $request)
    {

        $this->validate(request(), [
            'otp' => 'required',
            'mobile_no' => 'required',
            'user_id' => 'required',
        ]);
        $otp = $request->otp;
        $mobile_no = $request->mobile_no;
        $user_id = $request->user_id;
        $user=User::where('otp',$otp)->where('id',$user_id)->where('mobile_no',$mobile_no)->first();
        // dd($user);

        if($user) 
        {
            $otpDate = date('Y-m-d h:i:s');
            $otpDate = date('Y-m-d h:i:s', strtotime($otpDate));
            $otpDateBegin = date('Y-m-d h:i:s', strtotime($user->otp_time_stamp));
            $otpDateEnd = date('Y-m-d h:i:s', strtotime($otpDateBegin.' +10 minutes'));
            // echo "<pre>";print_r($otpDate);print_r($otpDateBegin);print_r($otpDateEnd);exit;
            if (($otpDate >= $otpDateBegin) && ($otpDate <= $otpDateEnd))
            {
                $user->verified_mobile_no = 1;
                $user->update();
                return redirect()->to('/myaccount')->with('success','Mobile Number Verified Successfully');
            }
            else
            {
                return redirect()->back()->withErrors(['OTP Expired!']);
            }
            // return view('frontend.users.change_password',compact('user'));
        }
        else
        {
            return redirect()->back()->withErrors(['Invalid OTP!!!Please try with Valid OTP']);
        }

    }
    
    public function verifyprofileotp(Request $request)
    {

        $this->validate(request(), [
            'otp' => 'required',
            'mobile_no' => 'required',
            'user_id' => 'required',
        ]);
        $otp = $request->otp;
        $mobile_no = $request->mobile_no;
        $user_id = $request->user_id;
        $user=User::where('otp',$otp)->where('id',$user_id)->where('mobile_no',$mobile_no)->first();
        // dd($user);

        if($user) 
        {
            $otpDate = date('Y-m-d h:i:s');
            $otpDate = date('Y-m-d h:i:s', strtotime($otpDate));
            $otpDateBegin = date('Y-m-d h:i:s', strtotime($user->otp_time_stamp));
            $otpDateEnd = date('Y-m-d h:i:s', strtotime($otpDateBegin.' +10 minutes'));
            // echo "<pre>";print_r($otpDate);print_r($otpDateBegin);print_r($otpDateEnd);exit;
            if (($otpDate >= $otpDateBegin) && ($otpDate <= $otpDateEnd))
            {
                $user->verified_mobile_no = 1;
                $user->update();
                return ['status'=>'success','message'=>'Mobile Number Verified Successfully'];//redirect()->to('/myaccount')->with('success','Mobile Number Verified Successfully');
            }
            else
            {
                return ['status'=>'error','message'=>'OTP Expired!'];//redirect()->back()->withErrors(['OTP Expired!']);
            }
            // return view('frontend.users.change_password',compact('user'));
        }
        else
        {
            return ['status'=>'error','message'=>'Invalid OTP!!!Please try with Valid OTP'];//redirect()->back()->withErrors(['Invalid OTP!!!Please try with Valid OTP']);
        }

    }
    
    public function resendprofileotp(Request $request)
    {
        
        if(isset($request->mobile_no) && $request->mobile_no != "" && strlen($request->mobile_no) == 10)
        {
            $current_user = User::where('id',$request->user_id)->first();
            $mobile_no = $current_user->mobile_no;
            $otp = mt_rand(1000, 9999);
            $otp_time_stamp = date('Y-m-d h:i:s');
            $otp_message = "Dear".$current_user->name." Your Mobile Phone Number Verification Code for Sign up at www.dadreeios.com portal is ".$otp." Valid for 10 minutes. Please do not disclose it to anybody{#var#}Regards{#var#}Dadreeios Team{#var#}Parwani Trading Co.";
            $otp_sms_api=send_sms($mobile_no, $otp_message);

            $current_user->otp=$otp;
            $current_user->otp_time_stamp = $otp_time_stamp;
            $current_user->save();
            return ['status'=>'success','message'=>'OTP sent to your Mobile Number! Please check'];//redirect()->back()->withErrors(['success'=>'OTP sent to your Mobile Number! Please check']);
        }

    }
    public function signupsendotp($mobile_no)
    {


      return view('frontend.users.otp',compact('mobile_no'));
    }



    public function resendsignupotp(Request $request)
    {
        if(isset($request->mobile_no) && $request->mobile_no != "" && strlen($request->mobile_no) == 10)
        {
            $current_user = User::where('mobile_no',$request->mobile_no)->first();
            $mobile_no = $current_user->mobile_no;
            $otp = mt_rand(1000, 9999);
            $otp_time_stamp = date('Y-m-d h:i:s');
            $otp_message = "Dear".$current_user->name."\nYour Mobile Phone Number Verification Code for Sign up at www.dadreeios.com portal is ".$otp." Valid for 10 minutes. Please do not disclose it to anybody. \nRegards \nDadreeios Team \nG.R. Parwani Trading Co.";
            $otp_sms_api=send_sms($mobile_no, $otp_message);

            $current_user->otp=$otp;
            $current_user->otp_time_stamp = $otp_time_stamp;
            $current_user->save();
            return ['status'=>'success','message'=>'OTP sent to your Mobile Number! Please check'];
        }

    }
}
