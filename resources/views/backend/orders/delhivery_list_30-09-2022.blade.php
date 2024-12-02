@extends('backend.layouts.app')
@section('title', 'Orders - Delhivery List')
@section('content')
<div class="app-content content">
  <div class="content-overlay"></div>
    <div class="content-wrapper">
      <div class="content-header row">
          <div class="content-header-left col-12 mb-2 mt-1">
            <div class="row breadcrumbs-top">
              <div class="col-12">
                <h5 class="content-header-title float-left pr-1 mb-0">Orders</h5>
                <div class="breadcrumb-wrapper col-12">
                  <ol class="breadcrumb p-0 mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active">Orders - Delhivery List
                    </li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
        </div>
<section id="basic-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Orders - Delhivery List
                    </h4>
                </div>
                <div class="card-content">
                  <div class="card-body">
                      <div class="form-body">
                          <div class="row">
                              <div class="col-md-12">
                                  <form action="{{route('admin.orders.delhiverylist')}}" method="GET" enctype="multipart/form-data">
                                      <div class="form-body">
                                          <div class="row">
                                              <div class="col-md-4">
                                                  <h5>Start Date</h5>
                                                  <input type="date" name="start_date" class="form-control" id="start_date" value="{{(isset($start_date))?$start_date:''}}" required>
                                              </div>
                                              <div class="col-md-4">
                                                  <h5>End Date</h5>
                                                  <input type="date" name="end_date" class="form-control" id="end_date" value="{{(isset($end_date))?$end_date:''}}" required>
                                              </div>
                                              <div class="col-md-3">
                                                  <input type="submit" class="btn btn-primary px-1 mt-2" value="Submit" id="button">
                                              </div>
                                          </div>
                                      </div>
                                  </form>
                              </div>
                          </div>
                      </div>
                  </div>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                    <a href="javascript:void(0);" class="btn btn-outline-secondary float-right ml-1" id="print_list"><span class="align-middle ml-25">Print</span></a>
                        <div class="table-responsive">
                            <table class="table zero-configuration table-responsive" id="tbl-datatable">
                                <thead id="delhivery_head">
                                    <tr>
                                      <th>#</th>
                                      <th>TAX INVOICE DATE</th>
                                      <th>TAX INVOICE NUMBER</th>
                                      <th>PLACE OF SUPPLY</th>
                                      <th>BUYER'S CITY</th>
                                      <th>TRACKING NUMBER</th>
                                      <th>BUYER'S NAME</th>
                                      <th>PAYMENT TYPE</th>
                                      <th>AMOUNT</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @if(isset($orders) && count($orders)>0)
                                    @php $srno = 1; @endphp
                                    @foreach($orders as $order)
                                    <tr>
                                        <td>{{ $srno }}</td>
                                        <td>{{date('d-m-Y H:i',strtotime($order->created_at ))}}</td>
                                        <td>{{ $order->invoice_counter_id }}</td>
                                        <td>{{ strtoupper($company->state) }}</td>
                                        <td>{{ $order->shipping_city }}</td>
                                        <td>
                                          {{ $order->package_waybill }}
                                        </td>
                                        <td>
                                          {{ $order->customer_name }}
                                        </td>
                                        <td>
                                          @if($order->payment_mode=='payumoney')
                                            PayuMoney
                                            @elseif($order->payment_mode=='cod')
                                            COD
                                            @else
                                            Online
                                          @endif
                                        </td>
                                        <td>{{ $order->total }}</td>
                                    </tr>
                                    @php $srno++; @endphp
                                    @endforeach
                                    @endif
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</div>
</div>

@endsection
@section('scripts')
<script src="{{ asset('backend-assets/vendors/js/tables/datatable/datatables.min.js') }}"></script>
<script src="{{ asset('backend-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('backend-assets/vendors/js/tables/datatable/dataTables.buttons.min.js') }}"></script>

<script>
  $(document).ready(function()
  {
    var table = $('#tbl-datatable').DataTable();
    checkallcheckbox();
    $('#ckbCheckAll').on('change',function()
    {
      if(($(this).prop('checked')))
      {
        $('.select_deals').prop('checked',true);
      }
      else
      {
        $('.select_deals').prop('checked',false);
      }
    });
    $('.select_deals').on('change',function()
    {
      checkallcheckbox();
    });
    function checkallcheckbox()
    {
      if ( $('.select_deals').length == $('.select_deals:checked').length)  
      {
        $('#ckbCheckAll').prop('checked',true);
      }
      else
      {
        $('#ckbCheckAll').prop('checked',false);
      }
    }
    $('.product_price,.product_discount_type,.product_discount').on('change',function()
    {
      var product_id = $(this).data('id');
      if($(this).val() != "")
      {
        var product_discount_type = $(".product_discount_type_"+product_id).val();
        var product_discount = $(".product_discount_"+product_id).val();
        var product_price = $(".product_price_"+product_id).val();
        if($(".product_discount_type_"+product_id).val() != "" && $(".product_discount_"+product_id).val() != "")
        {
          
          if (product_discount_type=='percent')
          {
            product_discounted_price = product_price - ((product_price*product_discount)/100);
          }
          else
          {
            product_discounted_price = product_price - product_discount;
          }
          console.log(product_discounted_price );
          $(".product_discounted_price_"+product_id).val(product_discounted_price);
        }
        else
        {
          $(".product_discounted_price_"+product_id).val(product_price);
        }
      }
      console.log($(this).val() );
    });
    $('.update_product').on('click',function()
    {
      var product_id = $(this).data('id');
      var product_discount_type = $(".product_discount_type_"+product_id).val();
      var product_discount = $(".product_discount_"+product_id).val();
      var product_price = $(".product_price_"+product_id).val();
      var product_discounted_price = $(".product_discounted_price_"+product_id).val();
      if(product_price !="" && product_discounted_price !="")
      {
        $.ajax({
          url: '{{url("admin/products/updateprice")}}',
          type: 'post',
          data:
          {
            product_id: product_id ,product_discount_type: product_discount_type ,
            product_discount: product_discount ,product_price: product_price ,
            product_discounted_price: product_discounted_price ,_token: "{{ csrf_token() }}",
          },
          success: function (data)
          {
            console.log(data);
            if(data)
            {
              $("#set_product_price_"+product_id).text(data.product_price);
              $("#set_product_discounted_price_"+product_id).text(data.product_discounted_price);
              alert('Product Price Updated');
            }
            // $('#filter_list').html(data);
          }
        });
      }
    });
    $('#tbl-datatable tbody').on('click', 'tr', function () {
        $(this).toggleClass('selected');
    });
    $('#print_list').click(function () {
      var  tr = ``;
      var ids = $.map(table.rows('.selected').data(), function (item) {
        // console.log(item)
            tr = "<tr>";
            trcnt = 1;
            $.each(item , function(key,val){
              if(key == trcnt)
              {
                trcnt++;
                tr = tr+"<td>"+val+"</td>";
              }
              else
              {
                tr = tr+"<td>"+val+"</td>";
              }
              
            });
            tr = tr+"</tr>";
            console.log(tr);
            return tr;
        });
        if(table.rows('.selected').data().length>0)
        {
          // console.log(ids);
          var print =  Popup(ids.join(''));
        }
        else
        {
          alert('Please select rows to print');
        }
        // console.log(ids)
        // alert(table.rows('.selected').data().length + ' row(s) selected');
    });
  });
</script>
<script type="text/javascript">
  // function PrintElem(elem)
  // { //alert(elem);
  //     var print=  Popup($(elem).html());
  //     //  alert(print);
  // }

  function Popup(data)
  {
      // alert(data);
      var mywindow = window.open('Delhivery List', 'Delhivery List', 'height=600,width=800');
      mywindow.document.write('<html><head><title>Delhivery List</title>');
      mywindow.document.write('<style>body{font-family:Arial !important;color:#000;} .data_table tr td{text-align:left;border:1px solid #111;padding:5px} .data_table tr th{text-align:left;border:1px solid #111;padding:5px} .data_table{border-collapse:collapse;} .data td{width:165px;margin-top:70px;}.kt-invoice-2 .kt-invoice__wrapper .kt-invoice__footer{margin-top: 0rem;padding: 0rem 0 0rem 0;background-color: #f7f8fa;}.kt-invoice-2 .kt-invoice__wrapper .kt-invoice__head .kt-invoice__container .kt-invoice__logo{display: flex;justify-content: space-between;padding-top: 0px;padding-bottom:0px;}.kt-invoice-2 .kt-invoice__wrapper .kt-invoice__head .kt-invoice__container .kt-invoice__logo a h1{font-weight: 700;font-size:1.5rem;line-height:20px;color:#6c7293;margin-bottom:0px;}.kt-invoice-2 .kt-invoice__wrapper .kt-invoice__head .kt-invoice__container .kt-invoice__desc{text-align:right;display:block;padding:20px 0 15px 0;font-weight:400;color:#6c7293;font-size:14px;}a{text-decoration:none;}.kt-invoice__items{display:flex;padding: 15px 0 20px 0;border-top: 1px solid #000;}.kt-invoice-2 .kt-invoice__wrapper .kt-invoice__head .kt-invoice__container .kt-invoice__desc > span{display: block;}.kt-invoice__logo img{width: 120px;margin-top:10px !important;}.kt-invoice-2 .kt-invoice__wrapper .kt-invoice__head .kt-invoice__container .kt-invoice__items .kt-invoice__item{flex: 1;-webkit-box-flex: 1;overflow: hidden;}.kt-invoice-2 .kt-invoice__wrapper .kt-invoice__head .kt-invoice__container .kt-invoice__items .kt-invoice__item .kt-invoice__subtitle{font-weight: 600;padding-bottom: 2px;font-size:14px;color:#6c7293;}.kt-invoice-2 .kt-invoice__wrapper .kt-invoice__head .kt-invoice__container .kt-invoice__items .kt-invoice__item .kt-invoice__text{color:#a7abc3;font-weight: 400;font-size:14px;}.kt-invoice-2 .kt-invoice__wrapper .kt-invoice__head .kt-invoice__container .kt-invoice__items .kt-invoice__item > span {display: block;}.kt-invoice-2 .kt-invoice__wrapper .kt-invoice__body table thead tr th {padding: 0 0 5px 0;border-top: none;color:#a7abc3;font-weight: 500;font-size:14px;}.table thead th {vertical-align: bottom;border-bottom: 1px solid #000;}.kt-invoice-2 .kt-invoice__wrapper .kt-invoice__body table thead tr th:not(:first-child) {text-align: right;}.kt-invoice-2 .kt-invoice__wrapper .kt-invoice__body table tbody tr:first-child td {padding-top: 5px;padding-bottom: 5px;}.kt-invoice-2 .kt-invoice__wrapper .kt-invoice__body table tbody tr td:not(:first-child) {text-align: right;}.kt-invoice-2 .kt-invoice__wrapper .kt-invoice__body table tbody tr td {padding: 5px 0 5px 0;vertical-align: middle;border-top: none;font-weight: 600;font-size: 14px;color:#6c7293;}.kt-invoice-2 .kt-invoice__wrapper .kt-invoice__footer {padding: 15px 0 15px 0;background-color:#f7f8fa;}.kt-invoice-2 .kt-invoice__wrapper .kt-invoice__footer .kt-invoice__table table thead tr th {padding: 5px 0 5px 0;border-top: none;color:#a7abc3;border-bottom: 1px solid #000;font-weight: 600;text-align:left;font-size:14px;}.kt-invoice-2 .kt-invoice__wrapper .kt-invoice__footer .kt-invoice__table table thead tr th:last-child {text-align: right;}.kt-invoice-2 .kt-invoice__wrapper .kt-invoice__footer .kt-invoice__table table tbody tr td {padding: 10px 0 0 0;vertical-align: middle;border-top: none;font-weight: 600;font-size: 14px;color:#6c7293;}.kt-invoice-2 .kt-invoice__wrapper .kt-invoice__footer .kt-invoice__table table tbody tr td:last-child {text-align: right;font-size: 14px;padding-top: 15px;}.pt-3{padding-top: 15px !important;}.table {width: 100%;max-width: 100%;background-color:transparent;}@media print {footer {position: fixed;bottom: 0;}header {position: fixed;top: 0;overflow: avoid;margin-bottom: 25px;}html, body {width: 210mm;height: 297mm;}}.thead_title{text-align: center !important;border-top: none !important;border-left: none !important;border-right: none !important;}.tfoot_cont{text-align: right !important;border-bottom: none !important;border-left: none !important;border-right: none !important;border-top: none !important;}</style>');
      mywindow.document.write('</head><body>');
      mywindow.document.write('<table width="100%" class="data_table"><thead><tr><th colspan="9" class="thead_title"><h2>G.R. Parwani Trading Co.</h2><h3> Delhivery List</h3><h4 style="text-align:right;">Date: {{date("d/m/Y")}}</h4></th></tr><tr><th>#</th><th>PLACE OF SUPPLY</th><th>TRACKING NUMBER</th><th>TAX INVOICE NUMBER</th><th>TAX INVOICE DATE</th><th>BUYER\'S NAME</th><th>BUYER\'S CITY</th><th>AMOUNT</th><th>PAYMENT TYPE</th></tr></thead>');
      mywindow.document.write("<tbody>"+data+"</tbody><tfoot><tr><th class='tfoot_cont' colspan='9'>&nbsp;&nbsp;</th></tr><tr><th class='tfoot_cont' colspan='9'>&nbsp;&nbsp;</th></tr>");
      mywindow.document.write("<tr><th class='tfoot_cont' colspan='9'>__________________</th></tr><tr><th class='tfoot_cont' colspan='9'>Receiver's Signature</th></tr></tfoot></table>");
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
