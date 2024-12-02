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
use App\Models\frontend\OrdersProductDetails;
use App\Models\frontend\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\backend\OrdersProductDetails as BackendOrdersProductDetails;
use App\Models\backend\Products;
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

    public function details(Request $request)
    {
        $stock=0;
        $sales_cancelation=0;
        $return_order = 0;
        $report_results = 0;

        $start_date=$request->start_date;
        $end_date=$request->end_date;
        $report_type=$request->report_type;
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
        $report_results = [];
        $report_total = 0;
        if($report_type == 'sales')
        {
            $report_results = Orders::whereBetween('orders.created_at',[$start_date,$end_date])->with(['orderproducts','users'])->orderBy('order_id','DESC')->get();
            // $report_results = OrdersProductDetails::whereBetween('orders.created_at',[$start_date,$end_date])->with(['order','users'])->orderBy('order_id','DESC')->get();
            $report_total = $report_results->sum('total');
            // dd($sales);
        }else if($report_type == 'stock'){


            $stock = Products::with('manufacturer','size','subcategory','brands','color','subsubcategory')->get();

        }elseif($report_type == 'salescancelation'){

            //   $sales_cancelation = OrdersProductDetails::with('orders')->where('cancel_order_flag' , 1)->get();

            $sales_cancelation = Orders::with('orderproducts')->where('cancel_order_flag' , 1)->get();

            //   dd($sales_cancelation->toArray());

        }elseif($report_type == 'returnorder'){

            $return_order = Orders::with('orderproducts')->where('order_return_flag' , 1)->get();
            // dd($return_order->toArray());
        }
        return view('backend.report.index',compact('start_date','end_date','report_type','orders','users','payments','totpaymentamount','totorderamount','report_results','report_total','stock','sales_cancelation','return_order'));
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
