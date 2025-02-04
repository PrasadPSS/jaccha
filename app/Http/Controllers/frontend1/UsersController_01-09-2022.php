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

use Session;
use Redirect;
use PHPMailer\PHPMailer;
use DB;
use Hash;

class UsersController extends Controller
{

  public function login()
  {
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
          // 'referral_id' => 'required',
          // 'terms_condition_confirm' => 'required',
          // 'adhaar_no' => 'required|alpha_num',
          // 'address' => 'required',
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

        try {
            $email = $request->email;


            $mail = new PHPMailer\PHPMailer();
            $mail->IsSMTP();

            $mail->CharSet = "utf-8";// set charset to utf8
//          $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
            $mail->SMTPAuth = true; // authentication enabled
            $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for Gmail
            $mail->Host = "smtp.gmail.com";
            $mail->Port = 587; // or 465
            $mail->Username = "testesatwat@gmail.com";
            $mail->Password = 'Esatwat@0000';
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );

            $mail->isHTML(true);
            $mail->SetFrom(' info@dadreeios.com', 'Dadreeios');
            $mail->AddAddress($email);
            $mail->Subject = "Welcome to Dadreeios";
            $mail->Body = "
    <html>
    <head>

    </head>
    <body><div style='margin:auto;'><a href='http://dadreeios.com/'><img src='http://dadreeios.com/images/dadreeios.png' width='120'></a></div>
    <h2 style='color:#333;'>Dadreeios</h2><h4 style='color:#333;'>Welcome to Dadreeios... Thank You for Register!!! </h4></body></html>";

     $mail->Send();

        } catch (phpmailerException $e) {
            echo $e->errorMessage();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        // $this->send_email($request->email,$request->name,$current_user->distributor_id);
        Session::flash('success','Sign UP Successfully');
        return redirect()->to('/myaccount')->with('success','Sign UP Successfully');
      }
      else
      {
        // exit;
        return redirect()->to('/signup');
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
       return redirect()->to('/')->with('success','Login Successfully');
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
      $this->validate(request(), [
          'email' => 'required',
      ]);
    $user=User::where('email',$request->email)->first();

    if($user==null){
        return redirect()->route('forgotpassword')->withErrors(['Inavlid Email!!!Please Try with Valid Email']);
    }
            try {
          $email = $request->email;
          $otp = mt_rand(1000, 9999);
          //return $otp;
          $mail = new PHPMailer\PHPMailer();
          $mail->IsSMTP();

          $mail->CharSet = "utf-8";// set charset to utf8
//          $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
          $mail->SMTPAuth = true; // authentication enabled
          $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for Gmail
          $mail->Host = "smtp.gmail.com";
          $mail->Port = 587; // or 465
          $mail->Username = "testesatwat@gmail.com";
          $mail->Password = 'Esatwat@0000';
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

                Session::put('email',$email);
                Session::put('id',$user->id);

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
                //return view('frontend.users.otp',compact('email'));
          return redirect()->route('sendOTP')->with('success', 'OTP sent to your Email account!!! Please check');
      }
    catch (phpmailerException $e) {
          echo $e->errorMessage();
      } catch (Exception $e) {
          echo $e->getMessage();
      }

    }

    public function resendotp(Request $request)
    {

        try {
            $email = Session::get('email');
            $otp = mt_rand(1000, 9999);
            //return $otp;
            $mail = new PHPMailer\PHPMailer();
            $mail->IsSMTP();

            $mail->CharSet = "utf-8";// set charset to utf8
//          $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
            $mail->SMTPAuth = true; // authentication enabled
            $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for Gmail
            $mail->Host = "smtp.gmail.com";
            $mail->Port = 587; // or 465
            $mail->Username = "testesatwat@gmail.com";
            $mail->Password = 'Esatwat@0000';
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
    public function changeforgotpassword(Request $request)
    {

      $this->validate(request(), [
          'otp' => 'required',
      ]);
      $otp = $request->otp;
      $user=User::where('otp',$otp)->first();
      // dd($user);

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
        if ($user) {
            Auth::login($user);

            return redirect()->to('/')->with('success', 'Login Successfully');
            // return redirect()->to('/myaccount')->with('success', 'Login Successfully');
        } else {
            $user = User::create([
                'name'          => $userSocial->getName(),
                'email'         => $userSocial->getEmail(),
                'profile_pic'         => $userSocial->getAvatar(),
                'provider_id'   => $userSocial->getId(),
                'provider'      => $social,
            ]);
            return redirect()->to('/')->with('success', 'Login Successfully');
            // return redirect()->to('/myaccount');
        }
    }

}
