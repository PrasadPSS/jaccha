<?php

namespace App\Http\Controllers\backend;

use App\Exports\OrderExport;
use App\Exports\PaymentExport;
use App\Exports\UserExport;
use App\Http\Requests;
use App\Models\backend\Categories;
use App\Models\backend\Footer;
use App\Models\backend\FooterIds;
use App\Models\backend\PaymentInfo;
use App\Models\backend\SubSubCategories;
use App\Models\frontend\Orders;
use App\Models\frontend\Review;
use App\Models\frontend\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Excel;

class ReportsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }


    public function index()
    {
        return view('backend.report.index');
    }

    public function details(Request $request){
        $start_date=$request->start_date;
        $end_date=$request->end_date;
        $fileupload=$request->fileuploadtype;
        $orders=DB::table('orders')
            ->join('users','users.id','=','orders.user_id')
            ->select('users.name','users.email','orders.orders_counter_id','orders.total',
                'orders.transaction_id','orders.created_at','orders.order_id')
            ->whereBetween('orders.created_at',[$start_date,$end_date])
            ->get();
        $users=User::whereBetween('created_at',[$start_date,$end_date])->get();
        $payments=PaymentInfo::whereBetween('created_at',[$start_date,$end_date])->get();
        $totpaymentamount=$payments->sum('amount');
        $totorderamount=$orders->sum('total');
        return view('backend.report.index',compact('start_date','end_date','fileupload','orders','users','payments','totpaymentamount','totorderamount'));
    }

    public function orderExcel($sdate,$edate){
        return Excel::download(new OrderExport($sdate,$edate),'orders.xlsx');
    }

    public function userExcel($sdate,$edate){
        return Excel::download(new UserExport($sdate,$edate),'users.xlsx');

    }

    public function paymentExcel($sdate,$edate){
        return Excel::download(new PaymentExport($sdate,$edate),'payments.xlsx');

    }
}
