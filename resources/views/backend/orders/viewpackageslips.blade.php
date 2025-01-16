@extends('backend.layouts.app')
@section('title', 'Package Slips')
@section('content')

    <!--order details section start-->
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
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.orders')}}">Orders</a></li>
                        <li class="breadcrumb-item active">Package Slips
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
                              <a href="{{ route('admin.orders') }}" class="btn btn-outline-secondary float-right"><i class="bx bx-arrow-back"></i><span class="align-middle ml-25">Back</span></a>
                                <h4 class="card-title">Package Slips
                                </h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body card-dashboard">
    @if(isset($orders))
        <div class="container" id="targetshow">
            <div class="row delivery-details-row">
                <div class="col-lg-8 col-md-12 col-sm-12 col-12">
                    <div class="order-details-box">
                        <div class="">
                            <div class="row ">
                                <div class="col-md-12 col-sm-12 col-12 ">
                                    <div class="order-info">
                                        <p>
                                            <span class="mr-4">Order Number: {{ $orders->orders_counter_id }}</span>
                                            <span class="">Order Confirmation Date: {{ date('jS F, Y',strtotime($orders->created_at)) }}     </span>
                                        </p>
                                    </div>
                                    <!-- <div class="delivery-period">
                                        <p>Estimated Delivery Period for Shipment 1 of 1:- By 21st January, 2021</p>
                                    </div> -->
                                </div>
                            </div>
                            @php
                                $total_productprice= 0;
                            @endphp
                            @if(isset($orders->orderproducts))
                                @foreach($orders->orderproducts as $orderproducts)

                                    <div class="row mb-3 tracker-details-row">
                                        <div class="col-md-3 col-sm-3 col-4 ">
                                            <div class="">
                                                <img src="{{ asset('backend-assets/uploads/product_images/') }}/{{ isset($orderproducts->productthumb)?$orderproducts->productthumb->image_name:'' }}" class="img-fluid" alt="">
                                            </div>
                                        </div>
                                        <div class="col-md-9 col-sm-9 col-8 ">
                                            <div class="delivery-product-info">
                                                <p><span class="delivery-pro-name">{{ $orderproducts->product_title }}</span></p>
                                                <p><span class="delivery-pro-type">{{ $orderproducts->product_sub_title }}</span></p>
                                                <p>
                                                    <span class="delivery-pro-original">₹{{ $orderproducts->product_discounted_price }}</span>
                                                    <span class="delivery-pro-price"><strike>₹{{ $orderproducts->product_price }}</strike></span>
                                                    @if(isset($item->products->product_discount) && $orderproducts->product_discount_type=='percent')
                                                    <span class="delivery-pro-discount">({{ $orderproducts->product_discount }}% OFF)</span>
                                                    @elseif(isset($item->products->product_discount) && ($orderproducts->product_discount_type=='flat'))
                                                    <span class="delivery-pro-discount">(₹{{ $orderproducts->product_discount }} OFF)</span>
                                                    @endif
                                                </p>
                                                @if(isset($item->products->product_discount))
                                                <p>
                                                    <span class="delivery-pro-description">You are saving  ₹{{ $item->products->product_price-$item->products->product_discounted_price }} on this Order</span>
                                                </p>
                                                @endif
                                                <p>
                                                    <span class="delivery-pro-color">Colour: {{ $orderproducts->product_color }}</span>
                                                    <span class="delivery-pro-size">Size: {{ $orderproducts->product_size }}</span>
                                                    <span class="delivery-pro-quantity">Quantity: {{ $orderproducts->qty }}</span>
                                                </p>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    @php
                                        $total_productprice = $total_productprice + ($orderproducts->product_price*$orderproducts->qty);
                                    @endphp
                                @endforeach
                                <div class="row">
                                    <div class="card">
                                        <div class="card-header">
                                        
                                        </div>
                                        <div class="card-content print-card">
                                        <div class="card-body card-dashboard">
                                            @include('backend.orders.package_slip')
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            @endif


                        </div>
                    </div>

                </div>

            </div>
        </div>
        @endif
        </div>
      </div>
    </div>
  </div>



</div>
</section>
</div>
</div>
        <!--order details section end-->
    <!-- hide show content -->
    <script>
        $('.viewdetails-content').click(function() {
            $('#targetshow').toggle(0);
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
            mywindow.document.write('<style>table{width:100%;border:1px solid #000;border-collapse:collapse;} table tr td,table tr th{border:1px solid #000;text-align:left;}body{width:280px;font-family:Arial !important;color:#000;}.printbonafide .data_table tr td{text-align:left;border:1px solid #111;padding:5px}.printbonafide .data_table{border-collapse:collapse;}.sign{float:right;}.printbonafide .data td{width:165px;margin-top:70px;}.kt-invoice-2 .kt-invoice__wrapper .kt-invoice__footer{margin-top: 0rem;padding: 0rem 0 0rem 0;background-color: #f7f8fa;}.kt-invoice-2 .kt-invoice__wrapper .kt-invoice__head .kt-invoice__container .kt-invoice__logo{display: flex;justify-content: space-between;padding-top: 0px;padding-bottom:0px;}.kt-invoice-2 .kt-invoice__wrapper .kt-invoice__head .kt-invoice__container .kt-invoice__logo a h1{font-weight: 700;font-size:1.5rem;line-height:20px;color:#6c7293;margin-bottom:0px;}.kt-invoice-2 .kt-invoice__wrapper .kt-invoice__head .kt-invoice__container .kt-invoice__desc{text-align:right;display:block;padding:20px 0 15px 0;font-weight:400;color:#6c7293;font-size:14px;}a{text-decoration:none;}.kt-invoice__items{display:flex;padding: 15px 0 20px 0;border-top: 1px solid #000;}.kt-invoice-2 .kt-invoice__wrapper .kt-invoice__head .kt-invoice__container .kt-invoice__desc > span{display: block;}.kt-invoice__logo img{width: 120px;margin-top:10px !important;}.kt-invoice-2 .kt-invoice__wrapper .kt-invoice__head .kt-invoice__container .kt-invoice__items .kt-invoice__item{flex: 1;-webkit-box-flex: 1;overflow: hidden;}.kt-invoice-2 .kt-invoice__wrapper .kt-invoice__head .kt-invoice__container .kt-invoice__items .kt-invoice__item .kt-invoice__subtitle{font-weight: 600;padding-bottom: 2px;font-size:14px;color:#6c7293;}.kt-invoice-2 .kt-invoice__wrapper .kt-invoice__head .kt-invoice__container .kt-invoice__items .kt-invoice__item .kt-invoice__text{color:#a7abc3;font-weight: 400;font-size:14px;}.kt-invoice-2 .kt-invoice__wrapper .kt-invoice__head .kt-invoice__container .kt-invoice__items .kt-invoice__item > span {display: block;}.kt-invoice-2 .kt-invoice__wrapper .kt-invoice__body table thead tr th {padding: 0 0 5px 0;border-top: none;color:#a7abc3;font-weight: 500;font-size:14px;}.table thead th {vertical-align: bottom;border-bottom: 1px solid #000;}.kt-invoice-2 .kt-invoice__wrapper .kt-invoice__body table thead tr th:not(:first-child) {text-align: right;}.kt-invoice-2 .kt-invoice__wrapper .kt-invoice__body table tbody tr:first-child td {padding-top: 5px;padding-bottom: 5px;}.kt-invoice-2 .kt-invoice__wrapper .kt-invoice__body table tbody tr td:not(:first-child) {text-align: right;}.kt-invoice-2 .kt-invoice__wrapper .kt-invoice__body table tbody tr td {padding: 5px 0 5px 0;vertical-align: middle;border-top: none;font-weight: 600;font-size: 14px;color:#6c7293;}.kt-invoice-2 .kt-invoice__wrapper .kt-invoice__footer {padding: 15px 0 15px 0;background-color:#f7f8fa;}.kt-invoice-2 .kt-invoice__wrapper .kt-invoice__footer .kt-invoice__table table thead tr th {padding: 5px 0 5px 0;border-top: none;color:#a7abc3;border-bottom: 1px solid #000;font-weight: 600;text-align:left;font-size:14px;}.kt-invoice-2 .kt-invoice__wrapper .kt-invoice__footer .kt-invoice__table table thead tr th:last-child {text-align: right;}.kt-invoice-2 .kt-invoice__wrapper .kt-invoice__footer .kt-invoice__table table tbody tr td {padding: 10px 0 0 0;vertical-align: middle;border-top: none;font-weight: 600;font-size: 14px;color:#6c7293;}.kt-invoice-2 .kt-invoice__wrapper .kt-invoice__footer .kt-invoice__table table tbody tr td:last-child {text-align: right;font-size: 14px;padding-top: 15px;}.pt-3{padding-top: 15px !important;}.table {width: 100%;max-width: 100%;background-color:transparent;}.thermel-print{width:60% !important;text-align:left !important}</style>');
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
