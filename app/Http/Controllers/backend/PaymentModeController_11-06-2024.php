<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\frontend\PaymentMode;
use Illuminate\Validation\Rule; //import Rule class

class PaymentModeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paymentmodes = PaymentMode::all();
        return view('backend.paymentmode.index')->with('paymentmodes', $paymentmodes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.paymentmode.create');
        // exit;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $this->validate($request, [
            'payment_mode_name' => ['required',],
        ]);
        // echo "string";exit;
        // dd($request->all());
        $paymentmode = new PaymentMode();
        $paymentmode->fill($request->all());

        if ($paymentmode->save()) {
            return redirect()->route('admin.paymentmode')->with('success', 'New Payment Mode Added!');
        } else {
            return redirect()->route('admin.paymentmode')->with('error', 'Something went wrong!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $paymentmode = PaymentMode::findOrFail($id);
        // dd($paymentmode);
        // dd($has_permissions);
        return view('backend.paymentmode.edit', compact('paymentmode'));
        // return view('backend.paymentmode.edit')->with('role', $role);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // dd($request->all());
        $paymentmode_id = $request->input('payment_mode_id');
        $this->validate($request, [
            'payment_mode_name' => ['required',],
        ]);
        // echo "string".$seller_id;exit;
        // dd($request->all());
        // $seller = new paymentmode();
        $paymentmode = PaymentMode::findOrFail($paymentmode_id);
        $paymentmode->fill($request->all());

        if ($paymentmode->update()) {
            return redirect()->route('admin.paymentmode')->with('success', 'New Payment Mode Updated!');
        } else {
            return redirect()->route('admin.paymentmode')->with('error', 'Something went wrong!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $paymentmode = PaymentMode::findOrFail($id);
        $paymentmode->delete();
        return redirect()->route('admin.paymentmode')->with('success', 'Payment Mode Deleted!');
    }
}
