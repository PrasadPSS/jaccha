<?php

namespace App\Http\Controllers\backend;

use App\Http\Requests;
use App\Models\backend\Categories;
use App\Models\backend\Company;
use App\Models\backend\SubSubCategories;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CompanyController extends Controller
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
        $company = Company::first();
        return view('backend.company.index', compact('company'));
    }



    public function edit($id)
    {
        $company = Company::findOrFail($id);
        return view('backend.company.edit', compact('company'));
    }

    public function update(Request $request)
    {
        $company_id = $request->id;
        $company = Company::findOrFail($company_id);
        $company->fill($request->all());

        if ($company->update())
        {
            return redirect()->route('admin.company')->with('success', 'Company Updated!');
        }
        else
        {
            return redirect()->route('admin.company')->with('error', 'Something went wrong!');
        }
    }

}
