<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Models\backend\Faqs;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule; //import Rule class

class FaqsController extends Controller
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
        $faqs = Faqs::all();
        return view('backend.faqs.index')->with('faqs', $faqs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('backend.faqs.create');
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
          'faq_name' => ['required',],
          'sub_title' => ['required',],
        ]);
        // echo "string";exit;
        // dd($request->all());
        $faq = new Faqs();
        $faq->fill($request->all());
        $faq->sub_title = $request->sub_title;
        if ($faq->save())
        {
          return redirect()->route('admin.faqs')->with('success', 'New FAQs Added!');
        }
        else
        {
          return redirect()->route('admin.faqs')->with('error', 'Something went wrong!');
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
        $faq = Faqs::findOrFail($id);
        // dd($has_permissions);
        return view('backend.faqs.edit',compact('faq'));
        // return view('backend.faqs.edit')->with('role', $role);
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
        $faq_id = $request->input('faq_id');
        $this->validate( $request, [
          'faq_name' => ['required',],
          'sub_title' => ['required',],
        ]);
        // echo "string".$faq_id;exit;
        // dd($request->all());
        // $faq = new Faqs();
        $faq = Faqs::findOrFail($faq_id);
        $faq->fill($request->all());
        $faq->sub_title = $request->sub_title;
        if ($faq->update())
        {
          return redirect()->route('admin.faqs')->with('success', 'New FAQs Updated!');
        }
        else
        {
          return redirect()->route('admin.faqs')->with('error', 'Something went wrong!');
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
        $faq = Faqs::findOrFail($id);
        $faq->delete();
        return redirect()->route('admin.faqs')->with('success', 'FAQs Deleted!');
    }

    // public function faqvalues($faq_id)
    // {
    //   $faq = Faqs::findOrFail($faq_id);
    //   $faqvalues = FAQsValues::Where('faq_id',$faq_id)->get();
    //   // dd($has_permissions);
    //   return view('backend.faqs.faqvalues',compact('faq_id','faq','faqvalues'));
    //   // return view('backend.faqs.edit')->with('role', $role);
    // }
}
