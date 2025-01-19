<?php

namespace App\Http\Controllers\backend;

use App\Models\backend\Prices;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Route;

class PricesController extends Controller
{

    public function __construct()
    {
      $this->middleware('auth:admin');
    }

  public function index()
    {
        $data['prices'] = Prices::all();
        return view('backend.prices.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('backend.prices.create');
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
          'price_name' => ['required',],
          'min' => ['required',],
          'max' => ['required',],
        ]);
        // echo "string";exit;
        // dd($request->all());
        $price = new Prices();
        $price->fill($request->all());

        if ($price->save())
        {
          return redirect()->route('admin.prices')->with('success', 'New Price Added!');
        }
        else
        {
          return redirect()->route('admin.prices')->with('error', 'Something went wrong!');
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
        $data['price'] = Prices::findOrFail($id);
        // dd($has_permissions);
        return view('backend.prices.edit', $data);
        // return view('backend.sizes.edit')->with('role', $role);
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
        $price_id = $request->input('id');
        $this->validate( $request, [
          'price_name' => ['required',],
          'min' => ['required',],
          'max' => ['required',],
        ]);
        // echo "string".$size_id;exit;
        // dd($request->all());
        // $size = new Sizes();
        $price = Prices::findOrFail($price_id);
        $price->fill($request->all());

        if ($price->update())
        {
          return redirect()->route('admin.prices')->with('success', 'Price Updated!');
        }
        else
        {
          return redirect()->route('admin.prices')->with('error', 'Something went wrong!');
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
        $size = Prices::findOrFail($id);
        $size->delete();
        return redirect()->route('admin.prices')->with('success', 'Price Deleted!');
    }

}
