<?php

namespace App\Http\Controllers\backend;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\backend\Footer;
use App\Models\frontend\Review;
use App\Models\backend\Products;
use App\Models\backend\FooterIds;
use App\Models\backend\Categories;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\backend\SpecialDeals;
use App\Models\backend\DealsProductId;
use App\Models\backend\HomePageSections;
use App\Models\backend\SubSubCategories;

class SpecialDealsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
      // $filter_id = $id;
      // $filter = Filters::findOrFail($filter_id);
      $categories = Categories::where('visibility',1)->get();
      // $filterassign = FilterValues::Where('filter_id',$filter_id)->get();
      // dd($has_permissions);
      return view('backend.specialdeals.deals_by_category',compact('categories'));
    }
    public function deals($category_id)
    {
        // $speacialDeal=SpecialDeals::first();
        $products = Products::where('category_id',$category_id)->where('visibility',1)->get();
        $deals_product_ids = DealsProductId::where('category_id', $category_id)->where('specialdealsid', 1)->pluck('product_id')->toArray();
        // dd($deals_product_ids);
        return view('backend.specialdeals.deals', compact('products','category_id','deals_product_ids'));
        // return view('backend.specialdeals.index',compact('speacialDeal'));
    }

    public function index2()
    {
      $speacialDeal=SpecialDeals::first();
       return view('backend.specialdeals.index',compact('speacialDeal'));
    }

    public function create(){
        
        $categories = Categories::all();
        $category_list = collect($categories)->mapWithKeys(function ($item, $key) {
            return [$item['category_id'] => $item['category_name']];

        });

        $product_list = [];

        return view('backend.specialdeals.create',compact('category_list','product_list'));
    }

    
   public function getProduct(Request $request)
    {
        $data = $request->all();

        $products = Products::whereIn('category_id', $data['category_id'])->get();

        foreach ($products as $key => $value) {
            $categories = Categories::where('category_id', $value['category_id'])->first();
            echo "<option value='" . $value['product_id'] . "'>" . $categories['category_name'] . "->" . $value['product_title'] . "</option>";
        }
        if (count($products) == 0) {
            echo "<option value=''>No Record Found</option>";
        }

    }

    public function store(Request $request){
       $speacialdeals=new SpecialDeals();
       $speacialdeals->start_date=Date('d-m-Y',strtotime($request->start_date));
       $speacialdeals->end_date=Date('d-m-Y',strtotime($request->end_date));
       $speacialdeals->save();

       foreach ($request->input('product_id') as $key => $value) {

        $dealsproductid = new DealsProductId();
        $dealsproductid->specialdealsid = $speacialdeals->id;
        //dd($footerid);
        $categories = Products::where('product_id', $value)->select('category_id')->first();
        $dealsproductid->category_id = $categories->category_id;
        $dealsproductid->product_id = $value;
        $dealsproductid->save();
    }

    return redirect('admin/specialdeals');

    }

    public function edit($id)
    {
        $specialdeal = SpecialDeals::findOrFail($id);
        $dealsproductid = DealsProductId::where('specialdealsid', $specialdeal->id)->get();
        $categoriesAll = Categories::all();
        $categoriesAll = collect($categoriesAll)->mapWithKeys(function ($item, $key) {
            return [$item['category_id'] => $item['category_name']];
        });
        $category_selected = collect($dealsproductid)->mapWithKeys(function ($item, $key) {
            return [$item['category_id'] => $item['category_id']];
        });
        $productsAll = Products::all();
        $productsAll = collect($productsAll)->mapWithKeys(function ($item, $key) {
            return [$item['product_id'] => $item['product_title']];
        });
        $product_selected = collect($dealsproductid)->mapWithKeys(function ($item, $key) {
            return [$item['product_id'] => $item['product_id']];
        });
        return view('backend.specialdeals.edit', compact('specialdeal', 'categoriesAll', 'category_selected', 'productsAll', 'product_selected'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $deals_id = $request->deals_id;
        $category_id = $request->category_id;
        //     $specialdeal = SpecialDeals::findOrFail($deals_id);
        //     $specialdeal->start_date=$request->start_date;
        //    $specialdeal->end_date=$request->end_date;
        //    $specialdeal->save();
        // dd($_POST);
        $dealsproductid = DealsProductId::where('category_id', $category_id)->where('specialdealsid', $deals_id)->get();
        if ($dealsproductid) 
        {
            $dealsproductid->each->delete();
        }
        if(isset($request->product_id) && count($request->input('product_id'))>0)
        {
            foreach ($request->input('product_id') as $key => $value) 
            {
                $dealsproductid = new DealsProductId();
                $dealsproductid->specialdealsid = $deals_id;
                //dd($footerid);
                $categories = Products::where('product_id', $value)->select('category_id')->first();
                $dealsproductid->category_id = $categories->category_id;
                $dealsproductid->product_id = $value;
                $dealsproductid->save();
            }
        }
        // $homepagesectiondeals=HomePageSections::where('home_page_section_code','deals')->first();
        // if($homepagesectiondeals)
        // {
        //     $homepagesectiondeals->home_page_section_start_date=$request->start_date;
        //     $homepagesectiondeals->home_page_section_end_date=$request->end_date;
        //     $homepagesectiondeals->save();
        // } 
        return redirect()->route('admin.specialdeals')->with('success', 'Specialdeals Update Successfully!!!');
        
    }

   

}
