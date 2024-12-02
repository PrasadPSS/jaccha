<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\frontend\Newsletters;
use Illuminate\Http\Request;
use Session;

class NewsletterController extends Controller
{

    public function store(Request $request)
    {

        $checknewsletter=Newsletters::where('email',$request->email)->first();
        if(!$checknewsletter) 
        {
            $token = substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 30);
            $newsletter = new Newsletters();
            $newsletter->fill($request->all());
            $newsletter->token = $token;
            // dd($token);
            $newsletter->save();
            Session::flash('success', 'Thank you for subscribe!!!');
            return redirect()->route('home');
        }
        else
        {
            if($checknewsletter->opt_out == 'Yes')
            {
                $token = substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 30);//substr(str_shuffle("0123456789abcdefghijklmnopqrstvwxyz"), 0, 20);
                $checknewsletter->opt_out = 'No';
                $checknewsletter->token = $token;
                // dd($token);
                if($checknewsletter->Update())
                {
                    Session::flash('success', 'Thank you for subscribe!!!');
                    return redirect()->route('home');
                }
            }
            else
            {
                if($checknewsletter->token == '')
                {
                    $token = substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 30);
                    $checknewsletter->token = $token;
                    $checknewsletter->Update();
                }
                Session::flash('error', 'Already Subscribed!!!');
                return redirect()->route('home');
            }
            

        }
    }

    public function unsubscribe($token=null)
    {
        if($token != null || $token != '')
        {
            $checknewsletter=Newsletters::where('token',$token)->first();
            if($checknewsletter) 
            {
                $checknewsletter->opt_out = 'Yes';
                
                if($checknewsletter->update())
                {
                    Session::flash('success', 'You have unsubscribed Newsletter!!!');
                    return redirect()->route('home');
                }
                else
                {
                    Session::flash('error', 'Something Went Wrong!!!');
                    return redirect()->route('home');
                }
            }
            else
            {
                Session::flash('error', 'Something Went Wrong!!!');
                return redirect()->route('home');

            }
        }
        else
        {
            Session::flash('error', 'Something Went Wrong!!!');
            return redirect()->route('home');

        }
    }


}
