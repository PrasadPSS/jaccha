<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Models\backend\FeaturedProducts;
use App\Models\backend\Products;
use App\Models\backend\HomePageSections;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule; //import Rule class

class HomepagefeaturedproductsController extends Controller
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
        $homepagefeaturedproducts = FeaturedProducts::all();
        $homepagesections = HomePageSections::where('home_page_section_code','best_seller')->first();

        return view('backend.homepagefeaturedproducts.index',compact('homepagefeaturedproducts', 'homepagesections'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $products = Products::all();
      $products = collect($products)->mapWithKeys(function ($item, $key) {
        return [$item['product_id'] => $item['product_title']];
      });
      return view('backend.homepagefeaturedproducts.create',compact('products'));
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
          'home_page_featured_product_name' => ['required',],
        ]);
        // echo "string";exit;
        // dd($request->all());
        $home_page_featured_product = new FeaturedProducts();
        $home_page_featured_product->fill($request->all());
        $home_page_featured_product->product_id = isset($request->product_id)?implode(',',$request->product_id):'';
        if ($home_page_featured_product->save())
        {
          return redirect()->route('admin.homepagefeaturedproducts')->with('success', 'New Featured Products Added!');
        }
        else
        {
          return redirect()->route('admin.homepagefeaturedproducts')->with('error', 'Something went wrong!');
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
        $home_page_featured_product = FeaturedProducts::findOrFail($id);
        $products = Products::all();
        if ($home_page_featured_product->home_page_featured_product_code == 'new-arrivals')
        {
          $products = Products::where('new_arrival',1)->get();
        }
        $products = collect($products)->mapWithKeys(function ($item, $key) {
          return [$item['product_id'] => $item['product_title']];
        });
        // dd($has_permissions);
        return view('backend.homepagefeaturedproducts.edit',compact('home_page_featured_product','products'));
        // return view('backend.homepagefeaturedproducts.edit')->with('role', $role);
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
        $home_page_featured_product_id = $request->input('home_page_featured_product_id');
        $this->validate( $request, [
          'home_page_featured_product_name' => ['required',],

        ]);
        // echo "string".$home_page_featured_product_id;exit;
        // dd($request->all());
        // $home_page_featured_product = new FeaturedProducts();
        $home_page_featured_product = FeaturedProducts::findOrFail($home_page_featured_product_id);
        $home_page_featured_product->fill($request->all());
        $home_page_featured_product->product_id = isset($request->product_id)?implode(',',$request->product_id):'';
        if ($home_page_featured_product->update())
        {
          return redirect()->route('admin.homepagefeaturedproducts')->with('success', 'New Featured Products Updated!');
        }
        else
        {
          return redirect()->route('admin.homepagefeaturedproducts')->with('error', 'Something went wrong!');
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
        $home_page_featured_product = FeaturedProducts::findOrFail($id);
        $home_page_featured_product->delete();
        return redirect()->route('admin.homepagefeaturedproducts')->with('success', 'Featured Products Deleted!');
    }

    // public function home_page_featured_productvalues($home_page_featured_product_id)
    // {
    //   $home_page_featured_product = FeaturedProducts::findOrFail($home_page_featured_product_id);
    //   $home_page_featured_productvalues = Featured ProductsValues::Where('home_page_featured_product_id',$home_page_featured_product_id)->get();
    //   // dd($has_permissions);
    //   return view('backend.homepagefeaturedproducts.home_page_featured_productvalues',compact('home_page_featured_product_id','home_page_featured_product','home_page_featured_productvalues'));
    //   // return view('backend.homepagefeaturedproducts.edit')->with('role', $role);
    // }
}
