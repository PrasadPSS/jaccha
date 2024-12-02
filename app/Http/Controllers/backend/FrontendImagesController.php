<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Models\backend\FrontendImages;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class FrontendImagesController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth:admin');
  }

  public function index()
  {
    $frontendimages = FrontendImages::all();
    return view('backend.frontendimages.index', compact('frontendimages'));
  }

  public function edit($id)
  {
    $frontendimages = FrontendImages::findOrFail($id);
    return view('backend.frontendimages.edit',compact('frontendimages'));
  }

  public function update(Request $request)
  {
    $frontend_image_id = $request->input('frontend_image_id');

    $frontend_image = FrontendImages::findOrFail($frontend_image_id);
    $frontend_image->fill($request->all());
    // dd($request->all());

    if($request->hasfile('image_url'))
    {
      $image = $request->file('image_url');
      $image_name = time().rand(1,100).'.'.$image->getClientOriginalExtension();
      $frontend_image->image_url = $image_name;
      $path = public_path('backend-assets/uploads/frontend_images/');
      if(!file_exists($path))
      {
        mkdir($path,0777);
      }
      $request->image_url->move($path, $image_name);
    }

    if($frontend_image->save())
    {
      return redirect()->route('admin.frontendimages')->with('success', 'Image Updated!');
    }
    else
    {
      return redirect()->route('admin.frontendimages')->with('error', 'Something went wrong!');
    }
  }


  // public function update(Request $request)
  // {
  //   $frontend_image_id = $request->input('frontend_image_id');

  //   $frontend_image = FrontendImages::findOrFail($frontend_image_id);
  //   $frontend_image->fill($request->all());
  //   // dd($request->all());

  //   if($request->hasfile('image_url'))
  //   {
  //     $image = $request->file('image_url');
  //     $image_name = time().rand(1,100).'.'.$image->getClientOriginalExtension();
  //     // dd($image_name);

  //     $frontend_image->image_url = $image_name;

  //     if($frontend_image->save())
  //     {
  //       $path = public_path('backend-assets/uploads/frontend_images/');

  //       if(!file_exists($path))
  //       {
  //         mkdir($path,0777);
  //       }

  //       $request->image_url->move($path, $image_name);

  //       return redirect()->route('admin.frontendimages')->with('success', 'Image Updated!');
  //     }
  //     else
  //     {
  //       // dd("hello");
  //       return redirect()->route('admin.frontendimages')->with('error', 'Something went wrong!');
  //     }
  //   }
  //   else
  //   {
  //     return redirect()->route('admin.frontendimages.edit', $frontend_image_id);
  //   }
  // }

}
