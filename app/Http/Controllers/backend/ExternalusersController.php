<?php

namespace App\Http\Controllers\backend;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\frontend\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Session;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class ExternalusersController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth:admin');
  }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $externalusers = User::orderBy('id','DESC')->get();

        return view('backend.externalusers.index', compact('externalusers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

      $roles = Role::pluck('name','id')->all();
      return view('backend.externalusers.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
      $this->validate($request, [
        'first_name' => ['required'],
        'last_name' => ['required'],
        'email' => ['required', 'email', 'unique:admin_users,email'],
        'password' => ['required','min:6','confirmed'],
      ]);
      $externaluser = new User();

        if($externaluser->fill($request->all())->save())
        {
          // $cat = User::Where('category_id',$category->category_id)->first();
          // $cat->category_slug = str_slug($category->category_name );
          // $cat->save();
        }

        Session::flash('message', 'External User added!');
        Session::flash('status', 'success');

        return redirect('admin/externalusers');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function show($id)
    {
        $externaluser = User::findOrFail($id);

        return view('backend.externalusers.show', compact('externaluser'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $externaluser = User::findOrFail($id);
        $roles = Role::pluck('name','id')->all();
        return view('backend.externalusers.edit', compact('externaluser','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function update(Request $request)
    {
      // echo "<pre>";print_r($request->all());exit;
      $id = $request->input('admin_user_id');
      $this->validate($request, [
        'first_name' => ['required'],
        'last_name' => ['required'],
        'email' => ['required', 'email', Rule::unique(User::class,'email')->ignore($id, 'admin_user_id')],
        // 'password' => ['required', 'min:6'],
        'last_name' => ['required'],
      ]);
      $externaluser = User::findOrFail($id);
      if($externaluser->update($request->all()))
      {
        $externaluser->assignRole($request->input('role'));
        // $cat = User::Where('category_id',$externaluser->category_id)->first();
        // $cat->category_slug = str_slug($externaluser->category_name );
        // $cat->save();
      }
      Session::flash('message', 'External User updated!');
      Session::flash('status', 'success');

      return redirect('admin/externalusers');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $externaluser = User::findOrFail($id);

        $externaluser->delete();

        Session::flash('message', 'External User deleted!');
        Session::flash('status', 'success');

        return redirect('admin/externalusers');
    }

    public function editstatus($id)
    {
        $externaluser = User::findOrFail($id);
        return view('backend.externalusers.updatestatus', compact('externaluser'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     *
     * @return Response
     */
    public function updatestatus(Request $request)
    {
      // echo "<pre>";print_r($request->all());exit;
      $id = $request->input('id');
      $this->validate($request, [
        'id' => ['required'],
        'account_status' => ['required'],
      ]);
      $externaluser = User::findOrFail($id);
      if($externaluser->update($request->all()))
      {
        return redirect('admin/externalusers')->with('success', 'External User updated!');
      }
      else
      {
        return back()->with('error','Something Went Wrong!');
      }

    }

}
