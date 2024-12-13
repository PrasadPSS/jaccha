@extends('frontend.layouts.login')
@section('title','Invoice')
@section('content')
@php
    use App\Models\frontend\User;
    use App\Models\frontend\WalletTransactions;
    use App\Models\frontend\PaymentInfo;
@endphp
@php
    $users = User::where('id',$orders->user_id)->first();

@endphp
<!--order invoice section start-->
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
      <div class="content-header row">
          <div class="content-header-left col-12 mb-2 mt-1">
            <div class="row breadcrumbs-top">
              <div class="col-12">
                <h5 class="content-header-title float-left pr-1 mb-0">Orders Invoice</h5>
                <div class="breadcrumb-wrapper col-12">
                  <ol class="breadcrumb p-0 mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.orders')}}">Orders</a></li>
                    <li class="breadcrumb-item active">Order Invoice
                    </li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <a href="{{ route('admin.orders') }}" class="btn btn-outline-secondary float-right ml-1"><i class="bx bx-arrow-back"></i><span class="align-middle ml-25">Back</span></a>
                <a href="javascript:void(0);" class="btn btn-outline-secondary float-right ml-1" onclick="PrintElem('.printinvoice');"><span class="align-middle ml-25">Print</span></a>
                <a href="{{url('admin/orders/invoice/'. $orders->order_id)}}" class="btn btn-outline-secondary float-right ml-1"></i><span class="align-middle ml-25">Download Invoice</span></a>
                <h4 class="card-title">Order Invoice
                </h4>
              </div>
              <div class="card-content">
                <div class="card-body card-dashboard">
                  @include('frontend.orders.invoice_card')
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <script>
        $(document).ready(function(){
            //$(".print_button").click(function()
            //{
            //PrintElem('.printinvoice');
//	});
        });
    </script>
    <script type="text/javascript">

        function PrintElem(elem)
        { //alert(elem);
            var print=  Popup($(elem).html());
            //  alert(print);
        }

        function Popup(data)
        {
            //alert(data);
            var mywindow = window.open('', 'Print Invoice', 'height=600,width=800');
            mywindow.document.write('<html><head><title>Print Invoice</title>');
            mywindow.document.write('<style>body{font-family:Arial !important;color:#000;}.printbonafide .data_table tr td{text-align:left;border:1px solid #111;padding:5px}.printbonafide .data_table{border-collapse:collapse;}.sign{float:right;}.printbonafide .data td{width:165px;margin-top:70px;}.kt-invoice-2 .kt-invoice__wrapper .kt-invoice__footer{margin-top: 0rem;padding: 0rem 0 0rem 0;background-color: #f7f8fa;}.kt-invoice-2 .kt-invoice__wrapper .kt-invoice__head .kt-invoice__container .kt-invoice__logo{display: flex;justify-content: space-between;padding-top: 0px;padding-bottom:0px;}.kt-invoice-2 .kt-invoice__wrapper .kt-invoice__head .kt-invoice__container .kt-invoice__logo a h1{font-weight: 700;font-size:1.5rem;line-height:20px;color:#6c7293;margin-bottom:0px;}.kt-invoice-2 .kt-invoice__wrapper .kt-invoice__head .kt-invoice__container .kt-invoice__desc{text-align:right;display:block;padding:20px 0 15px 0;font-weight:400;color:#6c7293;font-size:14px;}a{text-decoration:none;}.kt-invoice__items{display:flex;padding: 15px 0 20px 0;border-top: 1px solid #000;}.kt-invoice-2 .kt-invoice__wrapper .kt-invoice__head .kt-invoice__container .kt-invoice__desc > span{display: block;}.kt-invoice__logo img{width: 120px;margin-top:10px !important;}.kt-invoice-2 .kt-invoice__wrapper .kt-invoice__head .kt-invoice__container .kt-invoice__items .kt-invoice__item{flex: 1;-webkit-box-flex: 1;overflow: hidden;}.kt-invoice-2 .kt-invoice__wrapper .kt-invoice__head .kt-invoice__container .kt-invoice__items .kt-invoice__item .kt-invoice__subtitle{font-weight: 600;padding-bottom: 2px;font-size:14px;color:#6c7293;}.kt-invoice-2 .kt-invoice__wrapper .kt-invoice__head .kt-invoice__container .kt-invoice__items .kt-invoice__item .kt-invoice__text{color:#a7abc3;font-weight: 400;font-size:14px;}.kt-invoice-2 .kt-invoice__wrapper .kt-invoice__head .kt-invoice__container .kt-invoice__items .kt-invoice__item > span {display: block;}.kt-invoice-2 .kt-invoice__wrapper .kt-invoice__body table thead tr th {padding: 0 0 5px 0;border-top: none;color:#a7abc3;font-weight: 500;font-size:14px;}.table thead th {vertical-align: bottom;border-bottom: 1px solid #000;}.kt-invoice-2 .kt-invoice__wrapper .kt-invoice__body table thead tr th:not(:first-child) {text-align: right;}.kt-invoice-2 .kt-invoice__wrapper .kt-invoice__body table tbody tr:first-child td {padding-top: 5px;padding-bottom: 5px;}.kt-invoice-2 .kt-invoice__wrapper .kt-invoice__body table tbody tr td:not(:first-child) {text-align: right;}.kt-invoice-2 .kt-invoice__wrapper .kt-invoice__body table tbody tr td {padding: 5px 0 5px 0;vertical-align: middle;border-top: none;font-weight: 600;font-size: 14px;color:#6c7293;}.kt-invoice-2 .kt-invoice__wrapper .kt-invoice__footer {padding: 15px 0 15px 0;background-color:#f7f8fa;}.kt-invoice-2 .kt-invoice__wrapper .kt-invoice__footer .kt-invoice__table table thead tr th {padding: 5px 0 5px 0;border-top: none;color:#a7abc3;border-bottom: 1px solid #000;font-weight: 600;text-align:left;font-size:14px;}.kt-invoice-2 .kt-invoice__wrapper .kt-invoice__footer .kt-invoice__table table thead tr th:last-child {text-align: right;}.kt-invoice-2 .kt-invoice__wrapper .kt-invoice__footer .kt-invoice__table table tbody tr td {padding: 10px 0 0 0;vertical-align: middle;border-top: none;font-weight: 600;font-size: 14px;color:#6c7293;}.kt-invoice-2 .kt-invoice__wrapper .kt-invoice__footer .kt-invoice__table table tbody tr td:last-child {text-align: right;font-size: 14px;padding-top: 15px;}.pt-3{padding-top: 15px !important;}.table {width: 100%;max-width: 100%;background-color:transparent;}</style>');
            mywindow.document.write('</head><body >');
            mywindow.document.write(data);
            mywindow.document.write('</body></html>');

            mywindow.document.close(); // necessary for IE >= 10
            mywindow.focus(); // necessary for IE >= 10

            mywindow.print();

            mywindow.close();
            //Popupsecond(data);
            return true;
        }

    </script>

        </div>
    </div>

@endsection