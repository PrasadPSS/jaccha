<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Models\backend\Faqs;
use App\Models\backend\FaQuestions;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule; //import Rule class

class FaquestionsController extends Controller
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
    public function index($id)
    {
      $faq_id = $id;
      $faq = Faqs::findOrFail($faq_id);
      $faquestions = FaQuestions::Where('faq_id',$faq_id)->get();
      // dd($has_permissions);
      return view('backend.faquestions.index',compact('faq_id','faq','faquestions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
      $faq_id = $id;
      $faqs = Faqs::get();
      $faq_list = collect($faqs)->mapWithKeys(function ($item, $key) {
          return [$item['faq_id'] => $item['faq_name']];
        });
      return view('backend.faquestions.create',compact('faq_id','faqs'));
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
          'fa_question' => ['required',],
          'faq_id' => ['required',],
        ]);
        // echo "string";exit;
        // dd($request->all());
        $faquestion = new FaQuestions();
        $faquestion->fill($request->all());
        // dd($faquestion);

        if ($faquestion->save())
        {
          // return redirect()->route('admin.faquestions.index'.$faquestion->faq_id)->with('success', 'New Filter Value Added!');
          return redirect('admin/faquestions/index/'.$faquestion->faq_id);
        }
        else
        {
          // return redirect()->route('admin.faquestions.index'.$faquestion->faq_id)->with('error', 'Something went wrong!');
          return redirect('admin/faquestions/index/'.$faquestion->faq_id);
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
        $fa_question = FaQuestions::findOrFail($id);
        // dd($has_permissions);
        return view('backend.faquestions.edit',compact('fa_question'));
        // return view('backend.faquestions.edit')->with('role', $role);
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
        $fa_question_id = $request->input('fa_question_id');
        $this->validate( $request, [
          'fa_question' => ['required',],
          'faq_id' => ['required',],
        ]);
        // echo "string".$fa_question_id;exit;
        // dd($request->all());
        // $faquestion = new FaQuestions();
        $faquestion = FaQuestions::findOrFail($fa_question_id);
        $faquestion->fill($request->all());

        if ($faquestion->update())
        {
        return redirect('admin/faquestions/index/'.$faquestion->faq_id);
        }
        else
        {
          return redirect('admin/faquestions/index/'.$faquestion->faq_id);
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
        $faquestion = FaQuestions::findOrFail($id);
        $faquestion->delete();
        // return redirect()->route('admin.faquestions')->with('success', 'Filter Value Deleted!');
        return redirect('admin/faquestions/index/'.$faquestion->faq_id);
    }

    public function faquestionvalues($fa_question_id)
    {
      $faquestion = FaQuestions::findOrFail($fa_question_id);
      $faquestionvalues = FilterValueValues::Where('fa_question_id',$fa_question_id)->get();
      // dd($has_permissions);
      return view('backend.faquestions.faquestionvalues',compact('fa_question_id','faquestion','faquestionvalues'));
      // return view('backend.faquestions.edit')->with('role', $role);
    }
}
