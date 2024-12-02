@extends('frontend.layouts.myaccount')
@section('title','View Invoice')
@section('content')
<section id="cart"  class="invoice-wrpper" style="padding-top: 10%; padding-bottom: 5%;">
  <div class="container container-invoice" >
      <div class="row tablerow">
        <div class="col-sm-12">
          <div class="kt-content kt-grid__item kt-grid__item--fluid" id="kt_content">
  <div class="row">
    <div class="col-sm-12">
      <p class="text-center">
        <a style="padding: .5rem 1.55rem;border-radius: 0px; border: 2px solid #000; background-color: #fff; color: #000;box-shadow: none;" href="javascript:void(0);" class="btn btn-primary" onclick="PrintElem('.printinvoice');">Print</a>
        <!-- <a style="padding: .5rem 1.55rem;border-radius: 0px; border: 2px solid #000; background-color: #fff; color: #000;box-shadow: none;" href="{{url('admin/orders/invoice/'.$orders->order_id)}}" class="btn btn-primary" >Download</a> -->
      </p>
    </div>
    @include('frontend.orders.invoice_card')
  </div>
  </div>
</div>

  </div>
  </div>
</section>

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
		    mywindow.document.write('<style>body{font-family:Arial !important;color:#000;}.printbonafide .data_table tr td{text-align:left;border:1px solid #111;padding:5px}.printbonafide .data_table{border-collapse:collapse;}.sign{float:right;}.printbonafide .data td{width:165px;margin-top:70px;}.kt-invoice-2 .kt-invoice__wrapper .kt-invoice__footer{margin-top: 0rem;padding: 0rem 0 0rem 0;background-color: #f7f8fa;}.kt-invoice-2 .kt-invoice__wrapper .kt-invoice__head .kt-invoice__container .kt-invoice__logo{display: flex;justify-content: space-between;padding-top: 0px;padding-bottom:0px;}.kt-invoice-2 .kt-invoice__wrapper .kt-invoice__head .kt-invoice__container .kt-invoice__logo a h1{font-weight: 700;font-size:1.5rem;line-height:20px;color:#6c7293;margin-bottom:0px;}.kt-invoice-2 .kt-invoice__wrapper .kt-invoice__head .kt-invoice__container .kt-invoice__desc{text-align:right;display:block;padding:20px 0 15px 0;font-weight:400;color:#6c7293;font-size:14px;}a{text-decoration:none;}.kt-invoice__items{display:flex;padding: 15px 0 20px 0;border-top: 1px solid #000;}.kt-invoice-2 .kt-invoice__wrapper .kt-invoice__head .kt-invoice__container .kt-invoice__desc > span{display: block;}.kt-invoice__logo img{width: 120px;margin-top:10px !important;}.kt-invoice-2 .kt-invoice__wrapper .kt-invoice__head .kt-invoice__container .kt-invoice__items .kt-invoice__item{flex: 1;-webkit-box-flex: 1;overflow: hidden;}.kt-invoice-2 .kt-invoice__wrapper .kt-invoice__head .kt-invoice__container .kt-invoice__items .kt-invoice__item .kt-invoice__subtitle{font-weight: 600;padding-bottom: 2px;font-size:14px;color:#6c7293;}.kt-invoice-2 .kt-invoice__wrapper .kt-invoice__head .kt-invoice__container .kt-invoice__items .kt-invoice__item .kt-invoice__text{color:#a7abc3;font-weight: 400;font-size:14px;}.kt-invoice-2 .kt-invoice__wrapper .kt-invoice__head .kt-invoice__container .kt-invoice__items .kt-invoice__item > span {display: block;}.kt-invoice-2 .kt-invoice__wrapper .kt-invoice__body table thead tr th {padding: 0 0 5px 0;border-top: none;color:#a7abc3;font-weight: 500;font-size:14px;}.table thead th {vertical-align: bottom;border-bottom: 1px solid #000;}.kt-invoice-2 .kt-invoice__wrapper .kt-invoice__body table thead tr th:not(:first-child) {text-align: right;}.kt-invoice-2 .kt-invoice__wrapper .kt-invoice__body table tbody tr:first-child td {padding-top: 5px;padding-bottom: 5px;}.kt-invoice-2 .kt-invoice__wrapper .kt-invoice__body table tbody tr td:not(:first-child) {text-align: right;}.kt-invoice-2 .kt-invoice__wrapper .kt-invoice__body table tbody tr td {padding: 5px 0 5px 0;vertical-align: middle;border-top: none;font-weight: 600;font-size: 14px;color:#6c7293;}.kt-invoice-2 .kt-invoice__wrapper .kt-invoice__footer {padding: 15px 0 15px 0;background-color:#f7f8fa;}.kt-invoice-2 .kt-invoice__wrapper .kt-invoice__footer .kt-invoice__table table thead tr th {padding: 5px 0 5px 0;border-top: none;color:#a7abc3;border-bottom: 1px solid #000;font-weight: 600;text-align:left;font-size:14px;}.kt-invoice-2 .kt-invoice__wrapper .kt-invoice__footer .kt-invoice__table table thead tr th:last-child {text-align: right;}.kt-invoice-2 .kt-invoice__wrapper .kt-invoice__footer .kt-invoice__table table tbody tr td {padding: 10px 0 0 0;vertical-align: middle;border-top: none;font-weight: 600;font-size: 14px;color:#6c7293;}.kt-invoice-2 .kt-invoice__wrapper .kt-invoice__footer .kt-invoice__table table tbody tr td:last-child {text-align: right;font-size: 14px;padding-top: 15px;}.pt-3{padding-top: 15px !important;}.table {width: 100%;max-width: 100%;background-color:transparent;}.first__td{border:1px solid #000 !important;}.printinvoice table th{border:1px solid #000 !important;font-size:10px !important;}.printinvoice table td{border:1px solid #000 !important;}</style>');
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

@endsection
