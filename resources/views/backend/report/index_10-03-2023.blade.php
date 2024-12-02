@extends('backend.layouts.app')
@section('title', 'Report')

@section('content')

    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-12 mb-2 mt-1">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h5 class="content-header-title float-left pr-1 mb-0">Report</h5>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb p-0 mb-0">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i
                                                class="bx bx-home-alt"></i></a>
                                    </li>
                                    <li class="breadcrumb-item active">Report
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <section id="multiple-column-form">
                <div class="row match-height">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">View Report</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">

                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <form action="{{ route('admin.reports.details') }}" method="GET"
                                                    enctype="multipart/form-data">

                                                    <div class="form-body">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <h5>Report Type</h5>
                                                                <select class="form-control" name="report_type"
                                                                    id="filetype" required>
                                                                    <option selected="selected" disabled="disabled"
                                                                        value="">Please Select</option>
                                                                    <option value="Orders"
                                                                        {{ isset($report_type) && $report_type == 'Orders' ? 'selected' : '' }}>
                                                                        Orders</option>
                                                                    <option value="Users"
                                                                        {{ isset($report_type) && $report_type == 'Users' ? 'selected' : '' }}>
                                                                        Users</option>
                                                                    <option value="Payments"
                                                                        {{ isset($report_type) && $report_type == 'Payments' ? 'selected' : '' }}>
                                                                        Payments</option>
                                                                    <option value="sales"
                                                                        {{ isset($report_type) && $report_type == 'sales' ? 'selected' : '' }}>
                                                                        Sales</option>
                                                                    <option value="stock"
                                                                        {{ isset($report_type) && $report_type == 'stock' ? 'selected' : '' }}>
                                                                        Stock</option>
                                                                    <option value="salescancelation"
                                                                        {{ isset($report_type) && $report_type == 'salescancelation' ? 'selected' : '' }}>
                                                                        Sales Canceled</option>
                                                                        <option value="returnorder"
                                                                        {{ isset($report_type) && $report_type == 'returnorder' ? 'selected' : '' }}>
                                                                        Return Order</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <h5>Start Date</h5>
                                                                <input type="date" name="start_date" class="form-control"
                                                                    id="start_date"
                                                                    value="{{ isset($start_date) ? $start_date : '' }}"
                                                                    required>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <h5>End Date</h5>
                                                                <input type="date" name="end_date" class="form-control"
                                                                    id="end_date"
                                                                    value="{{ isset($end_date) ? $end_date : '' }}"
                                                                    required>
                                                            </div>

                                                            <div class="col-md-3 mt-1">
                                                                <input type="submit" class="btn btn-primary px-1"
                                                                    value="Submit" id="button">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            {{--            Order Details --}}
            @if (isset($report_type) && $report_type == 'Orders')
                <section id="basic-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Orders
                                    </h4>
                                </div>
                                <div class="col-12  text-right">
                                    <a href="{{ url('admin/report/orders/excel/' . $start_date . '/' . $end_date) }} "
                                        class="btn btn-primary">Export</a>
                                </div>
                                <div class="card-content">
                                    <div class="card-body card-dashboard">
                                        <div class="table-responsive">
                                            <table class="table zero-configuration" id="tbl-datatable">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Invoice No.</th>
                                                        <th>Customer Name</th>
                                                        <th>Customer Email</th>
                                                        <th>Amount</th>
                                                        <th>Transaction Id</th>
                                                        <th>Order Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if (isset($orders) && count($orders) > 0)
                                                        @php $srno = 1; @endphp
                                                        @foreach ($orders as $order)
                                                            <tr>
                                                                <td>{{ $srno }}</td>
                                                                <td>{{ $order->orders_counter_id }}</td>
                                                                <td>{{ $order->name }}</td>
                                                                <td>{{ $order->email }}</td>
                                                                <td>{{ $order->total }}</td>
                                                                <td>{{ $order->transaction_id }}</td>
                                                                <td>{{ date('d-m-Y H:i', strtotime($order->created_at)) }}
                                                                </td>
                                                            </tr>
                                                            @php $srno++; @endphp
                                                        @endforeach
                                                    @endif
                                                </tbody>
                                            </table>
                                            <h4>Grand Total Amount:{{ $totorderamount }}</h4>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            @endif
            {{-- Users Details --}}
            @if (isset($report_type) && $report_type == 'Users')
                <section id="basic-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Users
                                    </h4>
                                </div>
                                <div class="col-12  text-right">
                                    <a href="{{ url('admin/report/users/excel/' . $start_date . '/' . $end_date) }} "
                                        class="btn btn-primary">Export</a>
                                </div>
                                <div class="card-content">
                                    <div class="card-body card-dashboard">
                                        <div class="table-responsive">
                                            <table class="table zero-configuration" id="tbl-datatable">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Name</th>
                                                        <th>Email</th>
                                                        <th>Mobile No</th>
                                                        <th>Mobile Verified</th>
                                                        <th>Registered Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    {{-- {{dd($users)}} --}}
                                                    @if (isset($users) && count($users) > 0)
                                                        @php $srno = 1; @endphp
                                                        @foreach ($users as $user)
                                                            <tr>
                                                                <td>{{ $srno }}</td>
                                                                <td>{{ $user->name }}</td>
                                                                <td>{{ $user->email }}</td>
                                                                <td>{{ $user->mobile_no }}</td>
                                                                <td> {{($user->verified_mobile_no == '1') ? 'Verified':'Not Verified'}}</td>
                                                                <td>{{ date('d-m-Y H:i', strtotime($user->created_at)) }}
                                                                </td>
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
            @endif

            {{-- Payments --}}
            @if (isset($report_type) && $report_type == 'Payments')
                <section id="basic-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Payments
                                    </h4>
                                </div>
                                <div class="col-12  text-right">
                                    <a href="{{ url('admin/report/payments/excel/' . $start_date . '/' . $end_date) }} "
                                        class="btn btn-primary">Export</a>
                                </div>
                                <div class="card-content">
                                    <div class="card-body card-dashboard">
                                        <div class="table-responsive">
                                            <table class="table zero-configuration" id="tbl-datatable">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Customer Name</th>
                                                        <th>Email</th>
                                                        <th>Transaction Id</th>
                                                        <th>Amount</th>
                                                        <th>Payment Tracking Code</th>
                                                        <th>Payment Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if (isset($payments) && count($payments) > 0)
                                                        @php $srno = 1; @endphp
                                                        @foreach ($payments as $payment)
                                                            <tr>
                                                                <td>{{ $srno }}</td>
                                                                <td>{{ $payment->customer_name }}</td>
                                                                <td>{{ $payment->email }}</td>
                                                                <td>{{ $payment->transaction_id }}</td>
                                                                <td>{{ $payment->amount }}</td>
                                                                <td>{{ $payment->payment_tracking_code }}</td>
                                                                <td>{{ date('d-m-Y H:i', strtotime($payment->payment_date)) }}
                                                                </td>
                                                            </tr>
                                                            @php $srno++; @endphp
                                                        @endforeach
                                                    @endif
                                                </tbody>
                                            </table>
                                            <h4>Grand Total Amount:{{ $totpaymentamount }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            @endif

            {{-- stock --}}
            @if (isset($report_type) && $report_type == 'stock')
                <section id="basic-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">stock
                                    </h4>
                                </div>

                                <div class="col-12  text-right d-none">
                                    <a href="{{ url('admin/report/stock/excel/' . $start_date . '/' . $end_date) }} "
                                        class="btn btn-primary">Export</a>
                                </div>
                                <div class="card-content">
                                    <div class="card-body card-dashboard">
                                        <div class="table-responsive">
                                            <table class="table zero-configuration" id="tbl-datatable">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Category</th>
                                                        <th>Sub-category</th>
                                                        <th>Child category</th>
                                                        <th>Manufacturer Name</th>
                                                        <th>Brand</th>
                                                        <th>Size</th>
                                                        <th>SKU</th>
                                                        <th>color</th>
                                                        <th>quantity</th>
                                                        <th>Product MRP</th>
                                                        <th>Net Price</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if (isset($stock) && count($stock) > 0)
                                                        @php $srno = 1; @endphp
                                                        @foreach ($stock as $stok)
                                                            {{-- {{ dd($stok) }} --}}
                                                            <tr>
                                                                <td>{{ $srno }}</td>
                                                                <td>{{ isset($stok->category) ? $stok->category->category_name : '' }}
                                                                </td>
                                                                <td>
                                                                    @if (isset($stok->subcategory->subcategory_name))
                                                                        {{ $stok->subcategory->subcategory_name }}
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if (isset($stok->subcategory->subcategory_name))
                                                                        {{ $stok->subsubcategory->sub_subcategory_name }}
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if (isset($stok->manufacturer->manufacturer_name))
                                                                        {{ $stok->manufacturer->manufacturer_name }}
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if (isset($stok->brands->brand_name))
                                                                        {{ $stok->brands->brand_name }}
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if (isset($stok->size->size_name))
                                                                        {{ $stok->size->size_name }}
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if (isset($stok->product_sku))
                                                                        {{ $stok->product_sku }}
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if (isset($stok->color->color_name))
                                                                        {{ $stok->color->color_name }}
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if (isset($stok->product_qty))
                                                                        {{ $stok->product_qty }}
                                                                    @endif

                                                                </td>
                                                                <td>
                                                                    @if (isset($stok->product_price))
                                                                        {{ $stok->product_price }}
                                                                    @endif

                                                                </td>
                                                                <td>
                                                                    @if (isset($stok->product_discounted_amount))
                                                                        {{ $stok->product_discounted_amount }}
                                                                    @endif

                                                                </td>
                                                                </td>
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
            @endif
            {{-- end stock --}}



            {{-- sales cancelletion --}}
            {{-- place of supply is remaing --}}
            @if (isset($report_type) && $report_type == 'salescancelation')
                <section id="basic-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">sales cancelation
                                    </h4>
                                </div>

                                <div class="col-12  text-right d-none">
                                    <a href="{{ url('admin/report/salescancelation/excel/' . $start_date . '/' . $end_date) }} "
                                        class="btn btn-primary">Export</a>
                                </div>
                                <div class="card-content">
                                    <div class="card-body card-dashboard">
                                        <div class="table-responsive">
                                            <table class="table zero-configuration" id="tbl-datatable">
                                                <thead>
                                                    <tr>
                                                        <th rowspan="2">Sr. No.</th>
                                                        <th rowspan="2">Order Canellation Date </th>
                                                        <th rowspan="2">Order Canellation Reseon </th>
                                                        <th rowspan="2">Buyer Name</th>
                                                        <th rowspan="2">Mobile No</th>
                                                        <th rowspan="2">Invoice Date</th>
                                                        <th rowspan="2">Invoice Number</th>
                                                        <th rowspan="2">Quentity</th>
                                                        <th rowspan="2">MRP</th>
                                                        <th rowspan="2">Discount Flat %.</th>
                                                        <th rowspan="2">Discount Amt.</th>
                                                        <th rowspan="2">Taxable Amount</th>
                                                        <th colspan="2" class="text-center">CGST</th>
                                                        <th colspan="2" class="text-center">SGST / UGST</th>
                                                        <th colspan="2" class="text-center">IGST</th>
                                                        <th rowspan="2">Net Amt.</th>
                                                    </tr>
                                                    <tr>
                                                        <th>Rate</th>
                                                        <th>Amt.</th>
                                                        <th>Rate</th>
                                                        <th>Amt.</th>
                                                        <th>Rate</th>
                                                        <th>Amt.</th>
                                                    </tr>
                                                </thead>
                                                {{-- {{dd($sales_cancelation->toarray())}} --}}
                                                {{-- {{dd($sales_cancelation->cancel_order_date)}} --}}

                                                <tbody>
                                                    @if (isset($sales_cancelation) && count($sales_cancelation) > 0)
                                                    @php $srno = 1; @endphp
                                                    @foreach ($sales_cancelation as $sales_cancel)
                                                {{-- {{dd($sales_cancel->cancel_order_date)}}  --}}
                                                        @if (isset($sales_cancel->orderproducts) && count($sales_cancel->orderproducts) > 0)
                                                            @foreach ($sales_cancel->orderproducts as $orderproduct)
                                                            {{-- {{dd($orderproduct->toarray())}} --}}

                                                            
                                                                <tr>
                                                                    <td>{{ $srno }}</td>
                                                                    
                                                                    <td> 
                                                                    @if (isset($sales_cancel->cancel_order_date))
                                                                        {{ $sales_cancel->cancel_order_date }}
                                                                    @endif
                                                                    </td>
                                                                    <td> 
                                                                    @if (isset($sales_cancel->cancel_reason))
                                                                        {{ $sales_cancel->cancel_reason }}
                                                                    @endif
                                                                    </td> 
                                                                    <td>
                                                                        {{ isset($sales_cancel->customer_name) ? $sales_cancel->customer_name : '' }}
                                                                    </td>
                                                                    <td>{{ isset($sales_cancel->mobile_no) ? $sales_cancel->mobile_no : '' }}
                                                                    </td>
                                                                    <td>{{ $sales_cancel->created_at }}
                                                                    </td>
                                                                    <td>{{ isset($sales_cancel->invoice_counter_id) ? $sales_cancel->invoice_counter_id : '' }}
                                                                    </td> 
                                                                    <td>  
                                                                        @if (isset($orderproduct->qty))
                                                                            {{ $orderproduct->qty }}
                                                                        @endif
                                                                    </td>
                                                                    <td>  
                                                                    @if (isset($orderproduct->product_price))
                                                                        {{ $orderproduct->product_price }}
                                                                    @endif
                                                                    </td>
                                                                    <td>{{ isset($sales_cancel->discount_percent) ? $sales_cancel->discount_percent : '' }}
                                                                    </td>
                                                                    <td>{{ isset($sales_cancel->order_product_discount_amount) ? $sales_cancel->order_product_discount_amount : '' }}
                                                                    </td>
                                                                    <td>
                                                                        {{ isset($sales_cancel->order_product_taxable_amount) ? $sales_cancel->order_product_taxable_amount : '' }}
                                                                    </td> 
                                                                   
                                                                    <td>{{ isset($orderproduct->gst_cgst_rate) ? $orderproduct->gst_cgst_rate : '' }}
                                                                    </td>
                                                                    <td>{{ isset($orderproduct->gst_cgst_amount) ? $orderproduct->gst_cgst_amount : '' }}
                                                                    </td>
                                                                    <td>{{ isset($orderproduct->gst_sgst_rate) ? $orderproduct->gst_sgst_rate : '' }}
                                                                    </td>
                                                                    <td>{{ isset($orderproduct->gst_sgst_amount) ? $orderproduct->gst_sgst_amount : '' }}
                                                                    </td>
                                                                    <td>{{ isset($orderproduct->gst_igst_rate) ? $orderproduct->gst_igst_rate : '' }}
                                                                    </td>
                                                                    <td>{{ isset($orderproduct->gst_igst_amount) ? $orderproduct->gst_igst_amount : '' }}
                                                                    </td>
                                                                    <td>{{ isset($orderproduct->net_amount) ? $orderproduct->net_amount : '' }}
                                                                    </td>
                                                                </tr>
                                                                @php $srno++; @endphp
                                                             
                                                            @endforeach
                                                        @endif
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
            @endif
            {{-- end sales cancelation--}}


{{-- order return --}} 
{{-- only place of supply is reamining --}}
@if (isset($report_type) && $report_type == 'returnorder')
<section id="basic-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Return Order
                    </h4>
                </div>

                <div class="col-12  text-right d-none">
                    <a href="{{ url('admin/report/orderreturn/excel/' . $start_date . '/' . $end_date) }} "
                        class="btn btn-primary">Export</a>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <div class="table-responsive">
                            <table class="table zero-configuration" id="tbl-datatable">
                                <thead>
                                    <tr>
                                        <th rowspan="2">Sr. No.</th>
                                        <th rowspan="2">Invoice Date </th>
                                        <th rowspan="2">Invoice Number </th>
                                        <th rowspan="2">Order Return Date</th>
                                        <th rowspan="2">Buyer Name</th>
                                        <th rowspan="2">Quentity</th>
                                        <th rowspan="2">MRP</th>
                                        <th rowspan="2">Discount Amt %</th>
                                        <th rowspan="2">Discount Amount</th>
                                        <th rowspan="2">Taxable Amount</th>
                                        <th colspan="2" class="text-center">CGST</th>
                                        <th colspan="2" class="text-center">SGST / UGST</th>
                                        <th colspan="2" class="text-center">IGST</th>
                                        <th rowspan="2">Net Amt.</th>
                                    </tr>
                                    <tr>
                                        <th>Rate</th>
                                        <th>Amt.</th>
                                        <th>Rate</th>
                                        <th>Amt.</th>
                                        <th>Rate</th>
                                        <th>Amt.</th>
                                    </tr>
                                </thead>
                                {{-- {{dd($return_order->orderproducts->toarray())}} --}}
                                <tbody>
                                    @if (isset($return_order) && count($return_order) > 0)
                                        @php $srno = 1; @endphp
                                        @foreach ($return_order as $return)
                                        @if (isset($return->orderproducts) && count($return->orderproducts) > 0)
                                            @foreach ($return->orderproducts as $orderproduct) 
                                        
                                                <tr>
                                                    <td>{{ $srno }}</td>
                                                   <td>{{ $return->created_at }}</td>
                                                    <td> 
                                                    @if (isset($return->invoice_counter_id))
                                                        {{ $return->invoice_counter_id }}
                                                    @endif
                                                    </td> 
                                                    <td>
                                                        {{ isset($return->order_return_date) ? $return->order_return_date : '' }}
                                                    </td>
                                                    <td>{{ isset($return->customer_name) ? $return->customer_name : '' }}
                                                    </td>
                                                   
                                                    <td>  
                                                    @if (isset($orderproduct->qty))
                                                        {{ $orderproduct->qty }}
                                                    @endif
                                                    </td>
                                                    <td>  
                                                    @if (isset($orderproduct->product_price))
                                                        {{ $orderproduct->product_price }}
                                                    @endif
                                                    </td>
                                                    <td>{{ isset($return->discount_percent) ? $return->discount_percent : '' }}
                                                    </td>
                                                    <td>
                                                        {{ isset($return->order_product_discount_amount) ? $return->order_product_discount_amount : '' }}
                                                    </td>
                                                    <td>
                                                        {{ isset($return->order_product_taxable_amount) ? $return->order_product_taxable_amount : '' }}
                                                    </td>
                                                    <td>{{ isset($orderproduct->gst_cgst_rate) ? $orderproduct->gst_cgst_rate : '' }}
                                                    </td>
                                                    <td>{{ isset($orderproduct->gst_cgst_amount) ? $orderproduct->gst_cgst_amount : '' }}
                                                    </td>
                                                    <td>{{ isset($orderproduct->gst_sgst_rate) ? $orderproduct->gst_sgst_rate : '' }}
                                                    </td>
                                                    <td>{{ isset($orderproduct->gst_sgst_amount) ? $orderproduct->gst_sgst_amount : '' }}
                                                    </td>
                                                    <td>{{ isset($orderproduct->gst_igst_rate) ? $orderproduct->gst_igst_rate : '' }}
                                                    </td>
                                                    <td>{{ isset($orderproduct->gst_igst_amount) ? $orderproduct->gst_igst_amount : '' }}
                                                    </td>
                                                    <td>{{ isset($orderproduct->net_amount) ? $orderproduct->net_amount : '' }}
                                                    </td>
                                                </tr>
                                                @php $srno++; @endphp
                                               
                                                @endforeach
                                                @endif
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
@endif
{{-- end order return --}}

            {{-- sales --}}
            @if (isset($report_type) && $report_type == 'sales')
                <section id="basic-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Sales Report
                                    </h4>
                                </div>
                                <div class="col-12  text-right">
                                    <a href="{{ url('admin/report/sales/excel/' . $start_date . '/' . $end_date) }} "
                                        class="btn btn-primary">Export</a>
                                </div>
                                <div class="card-content mt-3">
                                    <div class="card-body card-dashboard">
                                        <div class="table-responsive">
                                            <table class="table zero-configuration table-bordered" id="tbl-datatable">
                                                <thead>
                                                    <tr>
                                                        <th rowspan="2">Sr. No.</th>
                                                        <th rowspan="2">Invoice Date</th>
                                                        <th rowspan="2">Invoice Number</th>
                                                        <th rowspan="2">Buyer Name</th>
                                                        <th rowspan="2">SKU</th>
                                                        <th rowspan="2">HSN Code</th>
                                                        <th rowspan="2">Place of Supply</th>
                                                        <th rowspan="2">Quantity</th>
                                                        <th rowspan="2">MRP</th>
                                                        <th rowspan="2">Sell Price</th>
                                                        <th rowspan="2">Discount Flat/ %</th>
                                                        <th rowspan="2">Discount Amt.</th>
                                                        <th rowspan="2">Total Discount</th>
                                                        <th rowspan="2">Taxable Amount</th>
                                                        <th colspan="2" class="text-center">CGST</th>
                                                        <th colspan="2" class="text-center">SGST / UGST</th>
                                                        <th colspan="2" class="text-center">IGST</th>
                                                        <th rowspan="2">Net Amt.</th>
                                                    </tr>
                                                    <tr>
                                                        <th>Rate</th>
                                                        <th>Amt.</th>
                                                        <th>Rate</th>
                                                        <th>Amt.</th>
                                                        <th>Rate</th>
                                                        <th>Amt.</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    
                                                    @if (isset($report_results) && count($report_results) > 0)
                                                        @php $srno = 1; @endphp
                                                        @foreach ($report_results as $report_result)
                                                            @if (isset($report_result->orderproducts) && count($report_result->orderproducts) > 0)
                                                                @foreach ($report_result->orderproducts as $orderproduct)
                                                              
                                                                    <tr>
                                                                        <td>{{ $srno }}</td>
                                                                        <td>{{ date('d-m-Y', strtotime($report_result->created_at)) }}
                                                                        </td>
                                                                        <td>{{ $report_result->orders_counter_id }}</td>
                                                                        <td>{{ $report_result->customer_name }}</td>
                                                                        <td>{{ isset($orderproduct->product_sku) ? $orderproduct->product_sku : '' }}
                                                                        </td>
                                                                        <td>{{ isset($orderproduct->product_hsn) ? $orderproduct->product_hsn : '' }}
                                                                        </td>
                                                                        <td>{{ $report_result->shipping_state }}</td>
                                                                        <td>{{ isset($orderproduct->qty) ? $orderproduct->qty : '' }}
                                                                        </td>
                                                                        <td>{{ isset($orderproduct->product_price) ? $orderproduct->product_price : '' }}
                                                                        </td>
                                                                        <td>{{ isset($orderproduct->rev_sell_price) ? $orderproduct->rev_sell_price : '' }}
                                                                        </td>
                                                                        <td>
                                                                            {{ isset($orderproduct->product_discount) ? $orderproduct->product_discount : 0 }}
                                                                            ({{ isset($orderproduct->product_discount_type) ? $orderproduct->product_discount_type : '' }})
                                                                        </td>
                                                                        <td>{{ isset($orderproduct->product_discounted_amount) ? $orderproduct->product_discounted_amount : '' }}
                                                                        </td>
                                                                        <td>{{ isset($orderproduct->rev_discount) ? $orderproduct->rev_discount : '' }}
                                                                        </td>
                                                                        <td>{{ isset($orderproduct->rev_taxable_amount) ? $orderproduct->rev_taxable_amount : '' }}
                                                                        </td>
                                                                        <td>{{ isset($orderproduct->gst_cgst_rate) ? $orderproduct->gst_cgst_rate : '' }}
                                                                        </td>
                                                                        <td>{{ isset($orderproduct->gst_cgst_amount) ? $orderproduct->gst_cgst_amount : '' }}
                                                                        </td>
                                                                        <td>{{ isset($orderproduct->gst_sgst_rate) ? $orderproduct->gst_sgst_rate : '' }}
                                                                        </td>
                                                                        <td>{{ isset($orderproduct->gst_sgst_amount) ? $orderproduct->gst_sgst_amount : '' }}
                                                                        </td>
                                                                        <td>{{ isset($orderproduct->gst_igst_rate) ? $orderproduct->gst_igst_rate : '' }}
                                                                        </td>
                                                                        <td>{{ isset($orderproduct->gst_igst_amount) ? $orderproduct->gst_igst_amount : '' }}
                                                                        </td>
                                                                        <td>{{ isset($orderproduct->net_amount) ? $orderproduct->net_amount : '' }}
                                                                        </td>
                                                                    </tr>
                                                                    @php $srno++; @endphp
                                                                @endforeach
                                                            @endif
                                                            @if ($report_result->payment_mode == 'cod')
                                                                <tr>
                                                                    <td>{{ $srno }}</td>
                                                                    <td>{{ date('d-m-Y', strtotime($report_result->created_at)) }}
                                                                    </td>
                                                                    <td>{{ $report_result->orders_counter_id }}</td>
                                                                    <td>{{ $report_result->customer_name }}</td>
                                                                    <td>COD CHARGES</td>
                                                                    <td>COD</td>
                                                                    <td>{{ $report_result->shipping_state }}</td>
                                                                    <td>0</td>
                                                                    <td>{{ isset($report_result->cod_collection_charge) ? $report_result->cod_collection_charge : '0.00' }}
                                                                    </td>
                                                                    <td>{{ isset($report_result->cod_collection_charge) ? $report_result->cod_collection_charge : '0.00' }}
                                                                    </td>
                                                                    <td>0.00</td>
                                                                    <td>0.00</td>
                                                                    <td>0.00</td>
                                                                    <td>{{ isset($report_result->cod_collection_charge) ? $report_result->cod_collection_charge : '0.00' }}
                                                                    </td>
                                                                    <td>{{ isset($report_result->cod_cgst_percent) ? $report_result->cod_cgst_percent : '0.00' }}
                                                                    </td>
                                                                    <td>{{ isset($report_result->cod_cgst_amount) ? $report_result->cod_cgst_amount : '0.00' }}
                                                                    </td>
                                                                    <td>{{ isset($report_result->cod_sgst_percent) ? $report_result->cod_sgst_percent : '0.00' }}
                                                                    </td>
                                                                    <td>{{ isset($report_result->cod_sgst_amount) ? $report_result->cod_sgst_amount : '0.00' }}
                                                                    </td>
                                                                    <td>{{ isset($report_result->cod_igst_percent) ? $report_result->cod_igst_percent : '0.00' }}
                                                                    </td>
                                                                    <td>{{ isset($report_result->cod_igst_amount) ? $report_result->cod_igst_amount : '0.00' }}
                                                                    </td>
                                                                    <td>{{ isset($report_result->cod_collection_charge_amount) ? $report_result->cod_collection_charge_amount : '0.00' }}
                                                                    </td>
                                                                </tr>
                                                                @php $srno++; @endphp
                                                            @endif
                                                        @endforeach
                                                        <tr class="" style="font-weight: bold;">
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td>Total</td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td>{{ $report_results->sum('qty') > 0 ? $report_results->sum('qty') : 0 }}
                                                            </td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td>{{ $report_results->sum('order_product_discount_amount') > 0 ? round($report_results->sum('order_product_discount_amount'), 2) : 0 }}
                                                            </td>
                                                            <td>
                                                                {{ $report_results->sum('order_product_taxable_amount') > 0 ? ($report_results->sum('cod_collection_charge') > 0 ? round($report_results->sum('order_product_taxable_amount') + $report_results->sum('cod_collection_charge'), 2) : round($report_results->sum('order_product_taxable_amount'), 2)) : 0 }}
                                                            </td>
                                                            <td></td>
                                                            <td>
                                                                {{ $report_results->sum('order_product_gst_cgst_amt') > 0 ? ($report_results->sum('cod_cgst_amount') > 0 ? round($report_results->sum('order_product_gst_cgst_amt') + $report_results->sum('cod_cgst_amount'), 2) : round($report_results->sum('order_product_gst_cgst_amt'), 2)) : 0 }}
                                                            </td>
                                                            <td></td>
                                                            <td>
                                                                {{ $report_results->sum('order_product_gst_sgst_amt') > 0 ? ($report_results->sum('cod_sgst_amount') > 0 ? round($report_results->sum('order_product_gst_sgst_amt') + $report_results->sum('cod_sgst_amount'), 2) : round($report_results->sum('order_product_gst_cgst_amt'), 2)) : 0 }}
                                                            </td>
                                                            <td></td>
                                                            <td>
                                                                {{ $report_results->sum('order_product_gst_igst_amt') > 0 ? ($report_results->sum('cod_igst_amount') > 0 ? round($report_results->sum('order_product_gst_igst_amt') + $report_results->sum('cod_igst_amount'), 2) : round($report_results->sum('order_product_gst_cgst_amt'), 2)) : 0 }}
                                                            </td>
                                                            <td>{{ $report_results->sum('total') > 0 ? round($report_results->sum('total'), 2) : 0 }}
                                                            </td>
                                                        </tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                            <h4>Grand Total Amount:{{ $report_total }}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            @endif
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('backend-assets/vendors/js/tables/datatable/pdfmake.min.js') }}"></script>
    <script src="{{ asset('backend-assets/vendors/js/tables/datatable/vfs_fonts.js') }}"></script>
    <script src="{{ asset('backend-assets/vendors/js/tables/datatable/datatables.min.js') }}"></script>
    <script src="{{ asset('backend-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('backend-assets/vendors/js/tables/datatable/dataTables.buttons.min.js') }}"></script>
    <script src="https://cdn.datatables.net/buttons/1.4.0/js/buttons.flash.min.js"></script>
    <script src="{{ asset('backend-assets/vendors/js/tables/datatable/buttons.bootstrap.min.js') }}"></script>
    <script src="{{ asset('backend-assets/vendors/js/tables/datatable/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('backend-assets/vendors/js/tables/datatable/buttons.print.min.js') }}"></script>


    <script>
        $(document).ready(function() {
            $('#tbl-datatable').DataTable().destroy();
            // $.extend(true, $.fn.dataTable.defaults, {
            //     "pageLength": 20,
            //     "lengthMenu": [[20, 50, 100, 200, 400,-1], [20, 50, 100, 200,  400, "- All -"]],
            // });
            $('#tbl-datatable').DataTable({
                // dom: 'Bfrtip',//lBfrtip
                pageLength: 20,
                lengthMenu: [
                    [20, 50, 100, 200, 400, -1],
                    [20, 50, 100, 200, 400, "- All -"]
                ],
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'excel', 
                        footer: false,
                        exportOptions: {
                            columns: [0, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
                        }
                    },
                    {
                        extend: 'pdf', 
                        footer: false,
                        exportOptions: {
                            columns: [0, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
                        }
                    },
                    {
                        extend: 'csv',
                        footer: false,
                        exportOptions: {
                            columns: [0, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
                        }
                    },
                ]
            });
        });
    </script>
@endsection
