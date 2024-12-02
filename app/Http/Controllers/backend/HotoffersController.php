<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Models\backend\Hotoffers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class HotoffersController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth:admin');
  }

  public function index()
  {
    $hotoffers = Hotoffers::orderBy('short_order','ASC')->get();
    return view('backend.hotoffers.index', compact('hotoffers'));
  }

  public function create()
  {
    return view('backend.hotoffers.create');
  }

  public function store(Request $request)
  {
    $hotoffer = new Hotoffers();
    $hotoffer->fill($request->all());

    //for first image
    if($request->hasfile('first_image'))
    {
      $image = $request->file('first_image');
      $image_name1 = time().rand(1,100).'.'.$image->getClientOriginalExtension();
      $hotoffer->first_image = $image_name1;
      $path = public_path('backend-assets/uploads/hotoffers/');
      if(!file_exists($path))
      {
        mkdir($path,0777);
      }
      $request->first_image->move($path, $image_name1);
    }

    //for second image
    if($request->hasfile('second_image'))
    {
      $image = $request->file('second_image');
      $image_name2 = time().rand(1,100).'.'.$image->getClientOriginalExtension();
      $hotoffer->second_image = $image_name2;
      $path = public_path('backend-assets/uploads/hotoffers/');
      if(!file_exists($path))
      {
        mkdir($path,0777);
      }
      $request->second_image->move($path, $image_name2);
    }

    //for third image
    if($request->hasfile('third_image'))
    {
      $image = $request->file('third_image');
      $image_name3 = time().rand(1,100).'.'.$image->getClientOriginalExtension();
      $hotoffer->third_image = $image_name3;
      $path = public_path('backend-assets/uploads/hotoffers/');
      if(!file_exists($path))
      {
        mkdir($path,0777);
      }
      $request->third_image->move($path, $image_name3);
    }

    //for fourth image
    if($request->hasfile('fourth_image'))
    {
      $image = $request->file('fourth_image');
      $image_name4 = time().rand(1,100).'.'.$image->getClientOriginalExtension();
      $hotoffer->fourth_image = $image_name4;
      $path = public_path('backend-assets/uploads/hotoffers/');
      if(!file_exists($path))
      {
        mkdir($path,0777);
      }
      $request->fourth_image->move($path, $image_name4);
    }

    if($hotoffer->save())
    {
      return redirect()->route('admin.hotoffers')->with('success', 'New Hot Offer Added!');
    }
    else
    {
      return redirect()->route('admin.hotoffers')->with('error', 'Something went wrong!');
    }
  }

  public function edit($id)
  {
    $hotoffers = Hotoffers::findOrFail($id);
    return view('backend.hotoffers.edit',compact('hotoffers'));
  }

  public function update(Request $request)
  {
    $hotoffer_id = $request->hotoffers_id;
    $col_type = $request->col_type;

    $hotoffer = Hotoffers::findOrFail($hotoffer_id);
    $hotoffer->fill($request->all());

    $hotoffer->first_image = NULL;
    $hotoffer->second_image = NULL;
    $hotoffer->third_image = NULL;
    $hotoffer->fourth_image = NULL;

    if($col_type == 1 || $col_type == 2 || $col_type == 4)
    {
      if($request->hasfile('first_image'))
      {
        $image = $request->file('first_image');
        $image_name1 = time().rand(1,100).'.'.$image->getClientOriginalExtension();
        $hotoffer->first_image = $image_name1;
        $path = public_path('backend-assets/uploads/hotoffers/');
        if(!file_exists($path))
        {
          mkdir($path,0777);
        }
        $request->first_image->move($path, $image_name1);
      }
      else
      {
        $hotoffer->first_image = $request->first_image_old;
      }
    }

    if($col_type == 2 || $col_type == 4)
    {
      if($request->hasfile('second_image'))
      {
        $image = $request->file('second_image');
        $image_name2 = time().rand(1,100).'.'.$image->getClientOriginalExtension();
        $hotoffer->second_image = $image_name2;
        $path = public_path('backend-assets/uploads/hotoffers/');
        if(!file_exists($path))
        {
          mkdir($path,0777);
        }
        $request->second_image->move($path, $image_name2);
      }
      else
      {
        $hotoffer->second_image = $request->second_image_old;
      }
    }

    if($col_type == 4)
    {
      if($request->hasfile('third_image'))
      {
        $image = $request->file('third_image');
        $image_name3 = time().rand(1,100).'.'.$image->getClientOriginalExtension();
        $hotoffer->third_image = $image_name3;
        $path = public_path('backend-assets/uploads/hotoffers/');
        if(!file_exists($path))
        {
          mkdir($path,0777);
        }
        $request->third_image->move($path, $image_name3);
      }
      else
      {
        $hotoffer->third_image = $request->third_image_old;
      }

      if($request->hasfile('fourth_image'))
      {
        $image = $request->file('fourth_image');
        $image_name4 = time().rand(1,100).'.'.$image->getClientOriginalExtension();
        $hotoffer->fourth_image = $image_name4;
        $path = public_path('backend-assets/uploads/hotoffers/');
        if(!file_exists($path))
        {
          mkdir($path,0777);
        }
        $request->fourth_image->move($path, $image_name4);
      }
      else
      {
        $hotoffer->fourth_image = $request->fourth_image_old;
      }
    }

    if($hotoffer->save())
    {
      return redirect()->route('admin.hotoffers')->with('success', 'Hot Offer Updated!');
    }
    else
    {
      return redirect()->route('admin.hotoffers')->with('error', 'Something went wrong!');
    }
  }

  public function destroy($id)
  {
      $hotoffers = Hotoffers::findOrFail($id);
      $hotoffers->delete();
      return redirect()->route('admin.hotoffers')->with('success', 'Hot Offers Deleted!');
  }

}
