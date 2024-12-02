<?php

namespace App\Http\Controllers\backend;

use App\Http\Requests;
use App\Models\backend\Categories;
use App\Models\backend\Footer;
use App\Models\backend\FooterIds;
use App\Models\backend\SubSubCategories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FooterController extends Controller
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
        $footer = Footer::all();
        return view('backend.footer.index', compact('footer'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $categories = Categories::all();
        $category_list = collect($categories)->mapWithKeys(function ($item, $key) {
            return [$item['category_id'] => $item['category_name']];

        });

        $sub_sub_category_list = [];
        return view('backend.footer.create', compact('category_list', 'sub_sub_category_list'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $footer = new Footer();
        $footer->footer_description = $request->input('footer_description');
        $footer->footer_category_description = $request->input('footer_category_description');
        if ($request->hasFile('footer_image1')) {
            $image = $request->file('footer_image1');
            $extension = $image->getClientOriginalExtension();
            $imagename = time() . '.' . $extension;
            $destination_path = public_path('/backend-assets/uploads/footer-assets/above_category_image');
            $image->move($destination_path, $imagename);
            $footer->footer_image1 = $imagename;
        } else {
            $footer->footer_image1 = '';
        }
        if ($request->hasFile('footer_image2')) {
            $image = $request->file('footer_image2');
            $extension = $image->getClientOriginalExtension();
            $imagename2 = time() . '.' . $extension;
            $destination_path = public_path('/backend-assets/uploads/footer-assets/left_image1');
            $image->move($destination_path, $imagename2);
            $footer->footer_image2 = $imagename2;
        } else {
            $footer->footer_image2 = '';
        }

        if ($request->hasFile('footer_image3')) {
            $image = $request->file('footer_image3');
            $extension = $image->getClientOriginalExtension();
            $imagename3 = time() . '.' . $extension;
            $destination_path = public_path('/backend-assets/uploads/footer-assets/left_image2');
            $image->move($destination_path, $imagename3);
            $footer->footer_image3 = $imagename3;
        } else {
            $footer->footer_image3 = '';

        }

        if ($request->hasFile('footer_image4')) {
            $image = $request->file('footer_image4');
            $extension = $image->getClientOriginalExtension();
            $imagename4 = time() . '.' . $extension;
            $destination_path = public_path('/backend-assets/uploads/footer-assets/right_image');
            $image->move($destination_path, $imagename4);
            $footer->footer_image4 = $imagename4;
        } else {
            $footer->footer_image4 = '';
        }
        $footer->save();

        foreach ($request->input('sub_subcategory_id') as $key => $value) {

            $footerid = new FooterIds();
            $footerid->footer_id = $footer->id;
            //dd($footerid);
            $categories = SubsubCategories::where('sub_subcategory_id', $value)->select('category_id')->first();
            $footerid->category_id = $categories->category_id;
            $footerid->sub_subcategory_id = $value;
            $footerid->save();
        }


        return redirect('admin/footer');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $footer = Footer::findOrFail($id);
        $footerid = FooterIds::where('footer_id', $footer->id)->get();
        $categoriesAll = Categories::all();
        $categoriesAll = collect($categoriesAll)->mapWithKeys(function ($item, $key) {
            return [$item['category_id'] => $item['category_name']];
        });
        $category_selected = collect($footerid)->mapWithKeys(function ($item, $key) {
            return [$item['category_id'] => $item['category_id']];
        });
        $sub_subcategoriesAll = SubsubCategories::all();
        $sub_subcategoriesAll = collect($sub_subcategoriesAll)->mapWithKeys(function ($item, $key) {
            return [$item['sub_subcategory_id'] => $item['sub_subcategory_name']];
        });
        $subcategory_selected = collect($footerid)->mapWithKeys(function ($item, $key) {
            return [$item['sub_subcategory_id'] => $item['sub_subcategory_id']];
        });
        return view('backend.footer.edit', compact('footer', 'categoriesAll', 'category_selected', 'sub_subcategoriesAll', 'subcategory_selected'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public
    function update(Request $request)
    {
        $footer_id = $request->footer_id;
        $footer = Footer::findOrFail($footer_id);
        $footer->footer_description = $request->input('footer_description');
        $footer->footer_category_description = $request->input('footer_category_description');

        if ($request->hasFile('footer_image1')) {
            $image = $request->file('footer_image1');
            $extension = $image->getClientOriginalExtension();
            $imagename = time() . '.' . $extension;
            $destination_path = public_path('/backend-assets/uploads/footer-assets/above_category_image');
            $image->move($destination_path, $imagename);
            $footer->footer_image1 = $imagename;
        }

        if ($request->hasFile('footer_image2')) {
            $image = $request->file('footer_image2');
            $extension = $image->getClientOriginalExtension();
            $imagename2 = time() . '.' . $extension;
            $destination_path = public_path('/backend-assets/uploads/footer-assets/left_image1');
            $image->move($destination_path, $imagename2);
            $footer->footer_image2 = $imagename2;
        }
        if ($request->hasFile('footer_image3')) {
            $image = $request->file('footer_image3');
            $extension = $image->getClientOriginalExtension();
            $imagename3 = time() . '.' . $extension;
            $destination_path = public_path('/backend-assets/uploads/footer-assets/left_image2');
            $image->move($destination_path, $imagename3);
            $footer->footer_image3 = $imagename3;
        }
        if ($request->hasFile('footer_image4')) {
            $image = $request->file('footer_image4');
            $extension = $image->getClientOriginalExtension();
            $imagename4 = time() . '.' . $extension;
            $destination_path = public_path('/backend-assets/uploads/footer-assets/right_image');
            $image->move($destination_path, $imagename4);
            $footer->footer_image4 = $imagename4;
        }
        $footer->save();
        $footerid = FooterIds::where('footer_id', $footer_id)->get();
        if ($footerid) {
            $footerid->each->delete();
        }
        foreach ($request->input('sub_subcategory_id') as $key => $value) {

            $footerid = new FooterIds();
            $footerid->footer_id = $footer->id;
            $categories = SubsubCategories::where('sub_subcategory_id', $value)->select('category_id')->first();
            $footerid->category_id = $categories->category_id;
            $footerid->sub_subcategory_id = $value;
            $footerid->save();
        }


        if ($footer->save()) {
            return redirect()->route('admin.footer')->with('success', 'Footer Update Successfully!!!');
        } else {
            return redirect()->route('admin.footer')->with('error', 'Something went wrong!!!');
        }

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public
    function destroy($id)
    {
        $footer = Footer::find($id);
        $footer->delete();
        return redirect('admin/footer');
    }


    public
    function getsubsubcategory(Request $request)
    {
        $data = $request->all();

        $subsubcategory = SubsubCategories::whereIn('category_id', $data['category_id'])->get();

        foreach ($subsubcategory as $key => $value) {
            $categories = Categories::where('category_id', $value['category_id'])->first();
            echo "<option value='" . $value['sub_subcategory_id'] . "'>" . $categories['category_name'] . "->" . $value['sub_subcategory_name'] . "</option>";
        }
        if (count($subsubcategory) == 0) {
            echo "<option value=''>No Record Found</option>";
        }

    }

}
