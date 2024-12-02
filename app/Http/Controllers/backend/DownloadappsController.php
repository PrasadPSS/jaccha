<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Models\backend\Downloadapp;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class DownloadappsController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth:admin');
  }

  public function index()
  {
    $downloadapp_image = Downloadapp::all();
    return view('backend.downloadapp.index', compact('downloadapp_image'));
  }

  public function create()
  {
    return view('backend.downloadapp.create');
  }

  public function store(Request $request)
  {
    $this->validate($request, [
      'image_url' => 'required',
      'url' => 'required',
    ]);

    $downloadapp_image = new Downloadapp();
    $downloadapp_image->fill($request->all());

    if($request->hasfile('image_url'))
    {
      $image = $request->file('image_url');
      $image_name = time().rand(1,100).'.'.$image->getClientOriginalExtension();
      $downloadapp_image->image_url = $image_name;
      $path = public_path('backend-assets/uploads/downloadapp_image/');
      if(!file_exists($path))
      {
        mkdir($path,0777);
      }
      $request->image_url->move($path, $image_name);
    }
    
    if ($downloadapp_image->save())
    {
      return redirect()->route('admin.downloadapp')->with('success', 'Download App Image Added!');
    }
    else
    {
      return redirect()->route('admin.downloadapp')->with('error', 'Something went wrong!');
    }
  }

  public function edit($id)
  {
    $downloadapp_image = Downloadapp::findOrFail($id);
    return view('backend.downloadapp.edit',compact('downloadapp_image'));
  }

  public function update(Request $request)
  {
    $frontend_image_id = $request->input('frontend_image_id');

    $frontend_image = Downloadapp::findOrFail($frontend_image_id);
    $frontend_image->fill($request->all());
    // dd($request->all());

    if($request->hasfile('image_url'))
    {
      $image = $request->file('image_url');
      $image_name = time().rand(1,100).'.'.$image->getClientOriginalExtension();
      $frontend_image->image_url = $image_name;
      $path = public_path('backend-assets/uploads/downloadapp_image/');
      if(!file_exists($path))
      {
        mkdir($path,0777);
      }
      $request->image_url->move($path, $image_name);
    }

    if($frontend_image->save())
    {
      return redirect()->route('admin.downloadapp')->with('success', 'Image Updated!');
    }
    else
    {
      return redirect()->route('admin.downloadapp')->with('error', 'Something went wrong!');
    }
  }

}
