<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Models\backend\Sellers;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule; //import Rule class

class SellersController extends Controller
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
        $sellers = Sellers::all();
        return view('backend.sellers.index')->with('sellers', $sellers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('backend.sellers.create');
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
        $this->validate($request, [
          'seller_name' => ['required',],
        ]);
        // echo "string";exit;
        // dd($request->all());
        $seller = new Sellers();
        $seller->fill($request->all());

        if ($seller->save())
        {
          return redirect()->route('admin.sellers')->with('success', 'New Seller Added!');
        }
        else
        {
          return redirect()->route('admin.sellers')->with('error', 'Something went wrong!');
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
        $seller = Sellers::findOrFail($id);
        // dd($has_permissions);
        return view('backend.sellers.edit',compact('seller'));
        // return view('backend.sellers.edit')->with('role', $role);
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
        $seller_id = $request->input('seller_id');
        $this->validate( $request, [
          'seller_name' => ['required',],
        ]);
        // echo "string".$seller_id;exit;
        // dd($request->all());
        // $seller = new Sellers();
        $seller = Sellers::findOrFail($seller_id);
        $seller->fill($request->all());

        if ($seller->update())
        {
          return redirect()->route('admin.sellers')->with('success', 'New Seller Updated!');
        }
        else
        {
          return redirect()->route('admin.sellers')->with('error', 'Something went wrong!');
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
        $seller = Sellers::findOrFail($id);
        $seller->delete();
        return redirect()->route('admin.sellers')->with('success', 'Seller Deleted!');
    }
}
