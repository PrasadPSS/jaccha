@extends('backend.layouts.app')
@section('title', 'Order Details')
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
                  <li class="breadcrumb-item active">Order Details
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
                    <h4 class="card-title">Order Details
                    </h4>
                </div>
                <div class="card-content">
                  <div class="card-body card-dashboard">
                    @if(isset($orders))
                      @php
                        $progress = order_status($orders);
                        $status_color = order_status_color($orders);
                      @endphp<p class="text-right"><span class="{{$status_color}}">{{$progress}}</span></p>
                      <div class="container" id="targetshow">
                        <div class="row delivery-details-row">
                          <div class="col-md-12 col-sm-12 col-12 ">
                            
                          </div>
                          <div class="col-lg-7 col-md-12 col-sm-12 col-12">
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
                                          <p><span class="delivery-pro-name">{{ $orderproducts->product_sub_title }}</span></p>
                                          <p><span class="delivery-pro-type">{{ $orderproducts->product_title }}</span></p>
                                          <p>
                                            @if($orderproducts->product_discounted_price!=null && $orderproducts->product_discount!=0)
                                              <span class="delivery-pro-price">₹{{ isset($orderproducts->product_discount)?$orderproducts->product_discounted_price:$orderproducts->product_price }}</span>
                                              <span class="delivery-pro-original"><strike>₹{{ $orderproducts->product_price }}</strike></span>
                                            @elseif($orderproducts->product_discounted_price!=null && $orderproducts->product_discount==0)
                                              <span class="delivery-pro-price">₹ {{$orderproducts->product_discounted_price}}</span>
                                            @else
                                              <span class="delivery-pro-original">₹ {{$orderproducts->product_price}}</span>
                                            @endif
                                            @if($orderproducts->product_discount_type!=null && $orderproducts->product_discount_type=='percent' && $orderproducts->product_discount!=0)
                                              <span class="delivery-pro-discount">({{ $orderproducts->product_discount }}% OFF)</span>
                                            @elseif($orderproducts->product_discount_type!=null && $orderproducts->product_discount_type=='flat' && $orderproducts->product_discount!=0)
                                              <span class="delivery-pro-discount">(₹ {{ $orderproducts->product_discount }} OFF)</span>
                                            @endif

                                          </p>
                                          @if(isset($orderproducts->product_discount) && $orderproducts->product_discount!=0)
                                            <p>
                                              <span class="delivery-pro-description">
                                                You are saving  ₹{{ $orderproducts->product_price-$orderproducts->product_discounted_price }} on this Order
                                              </span>
                                            </p>
                                          @endif
                                          <p>
                                            <span class="delivery-pro-color"><b>Colour:</b> {{ $orderproducts->product_color }}</span>
                                            &nbsp;<span class="delivery-pro-size"><b>Size:</b> {{ $orderproducts->product_size }}</span>
                                            &nbsp;<span class="delivery-pro-quantity"><b>Quantity:</b> {{ $orderproducts->qty }}</span>
                                          </p>
                                        </div>
                                      </div>
                                    </div>
                                    @php
                                      $total_productprice = $total_productprice + ($orderproducts->product_price*$orderproducts->qty);
                                    @endphp
                                  @endforeach
                                @endif
                              </div>
                            </div>

                          </div>
                          <div class="col-lg-5 col-md-12 col-sm-12 col-12">
                            <div class="order-details-box">
                              <div class="row">
                                <div class="col-md-12 col-sm-12 col-12 ">
                                  <div class="price-details">
                                    <h4>SHIPPING DETAILS</h4>
                                  </div>
                                </div>
                              </div>
                              @if(isset($orders))
                                <div class="row">
                                  <div class="col-md-12">
                                    <div class="ord-address">
                                      <p class="ord-name"><span class="ord-name-space">{{$orders->shipping_full_name}} </span><span class="home-link">{{$orders->shipping_address_type}}</span></p>
                                      <p class="ord-add">{{$orders->shipping_landmark}}<br>{{$orders->shipping_address_line1}}<br>{{$orders->shipping_address_line2}} - {{$orders->shipping_pincode}}</p>
                                      <p class="ord-contact">Contact Number: {{$orders->shipping_mobile_no}}
                                        @if($orders->shipping_alt_mobile_no)
                                        /{{$orders->shipping_alt_mobile_no}}
                                        @endif
                                      </p>
                                    </div>
                                  </div>
                                </div>
                              @endif
                            </div>
                            <div class="order-details-box">
                              <div class="row">
                                <div class="col-md-12 col-sm-12 col-12 ">
                                  <div class="price-details">
                                    <h4>PRICE DETAILS</h4>
                                  </div>
                                </div>
                              </div>
                              @php

                              @endphp
                              <div class="row">
                                <div class="col-md-12 col-sm-12 col-12 ">
                                  <table class="price-details-table">
                                    <tbody>
                                      <tr class="price-total">
                                        <td>TOTAL M.R.P. (Inclusive of all taxes)</td><td class="text-right">₹{{ ($orders->total_mrp!='')?$orders->total_mrp:0 }}</td>
                                      </tr>
                                      <tr>
                                        <td>DISCOUNT ON M.R.P.</td><td class="text-right price-color">- ₹{{($orders->total_mrp_dicount!='')?$orders->total_mrp_dicount:0}}</td>
                                      </tr>
                                      @if($orders->coupon_discount)
                                      <tr>
                                        <td>COUPON DISCOUNT</td><td class="text-right price-color">- ₹{{ ($orders->coupon_discount!='')?$orders->coupon_discount:0 }}</td>
                                      </tr>
                                      @endif
                                      <tr>
                                        @if($orders->shipping_amount!=0 && $orders->shipping_method_code!='free')
                                          <td>SHIPPING CHARGES</td><td class="text-right price-color">₹{{ ($orders->shipping_amount>0)?$orders->shipping_amount:'FREE' }}</td>
                                        @else
                                          <td>SHIPPING CHARGES</td><td class="text-right price-color">FREE</td>
                                        @endif
                                      </tr>
                                      @if($orders->payment_mode=='cod')
                                      <tr>
                                        <td>COD COLLECTION CHARGE</td><td class="text-right price-color"> ₹{{ ($orders->cod_collection_charge_amount!='')?$orders->cod_collection_charge_amount:0 }}</td>
                                      </tr>
                                      @endif
                                      <tr class=" total-amount">
                                        <td>TOTAL PAYABLE AMOUNT</td><td class="text-right">₹{{$orders->total}}</td>
                                      </tr>
                                      <tr class=" total-amount">
                                        <td>PAYMENT MODE</td><td class="text-right">@if($orders->payment_mode=='payumoney')Online @elseif($orders->payment_mode=='cod')COD @else- @endif</td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </div>
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
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4 class="card-title">Update Order Progress</h4>
                  </div>
                  <div class="card-content">
                    <div class="card-body">
                      @include('backend.includes.errors')
                      {!! Form::model($orders, [
                          'method' => 'POST',
                          'url' => ['admin/orders/updateprogress'],
                          'class' => 'form'
                      ]) !!}
                        <div class="form-body">
                          <div class="row">
                            <div class="col-md-12 col-12 mt-2 menu_permissions">
                              <!-- {{ Form::label('submenu_permissions', 'Order Progess') }} -->
                              {{ Form::hidden('order_id', $orders->order_id) }}
                              <ul class="list-unstyled mb-0">
                                <li class="d-inline-block mr-2 mb-1">
                                  <fieldset>
                                    <div class="checkbox checkbox-primary">
                                      {{ Form::checkbox('confirmed_stage', 1, $orders->confirmed_stage, ['id'=>'confirmed_stage','disabled'=>$shipped_disable]) }}
                                      {{ Form::label('confirmed_stage', 'Confirmed') }}
                                      @if($shipped_disable)
                                        {{ Form::hidden('confirmed_stage', $orders->confirmed_stage) }}
                                      @endif
                                    </div>
                                  </fieldset>
                                </li>
                                <li class="d-inline-block mr-2 mb-1">
                                  <fieldset>
                                    <div class="checkbox checkbox-primary">
                                      {{ Form::checkbox('preparing_order_stage', 1, $orders->preparing_order_stage, ['id'=>'preparing_order_stage','disabled'=>$preparing_order_stage]) }}
                                      {{ Form::label('preparing_order_stage', 'Preparing your Order') }}
                                      @if($shipped_disable)
                                        {{ Form::hidden('preparing_order_stage', $orders->preparing_order_stage) }}
                                      @endif
                                    </div>
                                  </fieldset>
                                </li>
                                <li class="d-inline-block mr-2 mb-1">
                                  <fieldset>
                                    <div class="checkbox checkbox-primary">
                                      {{ Form::checkbox('shipped_stage', 1, $orders->shipped_stage, ['id'=>'shipped_stage','disabled'=>$shipped_stage]) }}
                                      {{ Form::label('shipped_stage', 'Shipped') }}
                                      @if($shipped_disable)
                                        {{ Form::hidden('shipped_stage', $orders->shipped_stage) }}
                                      @endif
                                    </div>
                                  </fieldset>
                                </li>
                                <li class="d-inline-block mr-2 mb-1">
                                  <fieldset>
                                    <div class="checkbox checkbox-primary">
                                      {{ Form::checkbox('out_for_delivery_stage', 1, $orders->out_for_delivery_stage, ['id'=>'out_for_delivery_stage','disabled'=>$out_for_delivery_stage]) }}
                                      {{ Form::label('out_for_delivery_stage', 'Out for Delivery') }}
                                    </div>
                                  </fieldset>
                                </li>
                                <li class="d-inline-block mr-2 mb-1">
                                  <fieldset>
                                    <div class="checkbox checkbox-primary">
                                      {{ Form::checkbox('delivered_stage', 1, $orders->delivered_stage, ['id'=>'delivered_stage','disabled'=>$delivered_stage]) }}
                                      {{ Form::label('delivered_stage', 'Delivered') }}
                                    </div>
                                  </fieldset>
                                </li>
                              </ul>
                            </div>
                            <div class="col-12 d-flex justify-content-start">
                              <!-- <button type="submit" class="btn btn-primary mr-1 mb-1">Update</button> -->
                              {{ Form::submit('Update', array('class' => 'btn btn-primary mr-1 mb-1')) }}
                            </div>
                          </div>
                        </div>
                      {{ Form::close() }}
                    </div>
                  </div>
                </div>
              </div>
              @if(isset($payment_details) && isset($orders) && $orders->payment_mode=='cod' && $orders->delivered_stage==1)
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4 class="card-title">Update COD Payment Collection Status</h4>
                  </div>
                  <div class="card-content">
                    <div class="card-body">
                      @include('backend.includes.errors')
                      {!! Form::model($payment_details, [
                          'method' => 'POST',
                          'url' => ['admin/orders/updatecodstatus'],
                          'class' => 'form'
                      ]) !!}
                        <div class="form-body">
                          <div class="row">

                            <div class="col-md-4 col-12">
                              <fieldset class="form-group">
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    {{ Form::hidden('payment_id', $payment_details->payment_id) }}
                                    {{ Form::label('status', 'Payment Status ',['class'=>'']) }}
                                  </div>
                                  {{ Form::select('status', ['processing'=>'Processing','complete'=>'Complete'], null,['class'=>'select2 form-control ', 'placeholder' => 'Please Select Payment Status',]) }}
                                </div>
                              </fieldset>
                            </div>

                            <div class="col-12 d-flex justify-content-start">
                              <!-- <button type="submit" class="btn btn-primary mr-1 mb-1">Update</button> -->
                              {{ Form::submit('Update', array('class' => 'btn btn-primary mr-1 mb-1')) }}
                            </div>
                          </div>
                        </div>
                      {{ Form::close() }}
                    </div>
                  </div>
                </div>
              </div>
              @endif
              @if(isset($orders) && $orders->order_return_flag=='1')
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4 class="card-title">Order is Returning</h4>
                  </div>
                  <div class="card-content">
                    <div class="card-body">
                      
                        <div class="form-body">
                          <div class="row">
                            <div class="col-md-6 col-12">
                              <p><b>Reason:</b> {{$orders->order_return_reason_desc}}</p>
                            </div>
                            <div class="col-md-6 col-12">
                              <p><b>Date:</b> {{$orders->order_return_date}}</p>
                            </div>
                            <div class="col-md-6">
                              <h4>Return Address</h4>
                              <div class="ord-address">
                                  <p class="ord-name"><span class="ord-name-space">{{$orders->return_shipping_full_name}} </span><span class="home-link">{{$orders->return_shipping_address_type}}</span></p>
                                  <p class="ord-add">{{$orders->return_shipping_landmark}}<br>{{$orders->return_shipping_address_line1}}<br>{{$orders->return_shipping_address_line2}} - {{$orders->return_shipping_pincode}}</p>
                                  <p class="ord-contact">Contact Number: {{$orders->return_shipping_mobile_no}}
                                      @if($orders->return_shipping_alt_mobile_no)
                                        /{{$orders->return_shipping_alt_mobile_no}}
                                      @endif
                                  </p>
                              </div>
                            </div>
                            @if(isset($orders->payment_mode) && $orders->payment_mode=='cod')
                            <div class="col-md-6">
                              <h4>Bank Details</h4>
                              <div class="ord-address">
                                  <p class="ord-name"><span class="ord-name-space">{{$orders->account_holder_name}} </span><span class="home-link">({{$orders->account_type}})</span></p>
                                  <p class="ord-contact">Account Number: {{$orders->account_number}}</p>
                                  <p class="ord-contact">Bank: {{$orders->bank_name}}</p>
                                  <p class="ord-contact">Branch: {{$orders->branch_name}}</p>
                                  <p class="ord-contact">IFSC: {{$orders->bank_ifsc_code}}</p>
                              </div>
                            </div>
                            @endif
                          </div>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4 class="card-title">Update Return Status</h4>
                  </div>
                  <div class="card-content">
                    <div class="card-body">
                      @include('backend.includes.errors')
                      {!! Form::model($orders, [
                          'method' => 'POST',
                          'url' => ['admin/orders/updatereturnstatus'],
                          'class' => 'form'
                      ]) !!}
                        <div class="form-body">
                          <div class="row">
                            @php  
                              $order_return_status = ($orders->order_return_flag=='1' && $orders->order_return_status=='1')?1:0;
                            @endphp
                            <div class="col-md-4 col-12">
                              <fieldset class="form-group">
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    {{ Form::hidden('order_id', $orders->order_id) }}
                                    {{ Form::label('order_return_status', 'Return Status ',['class'=>'']) }}
                                  </div>
                                  {{ Form::select('order_return_status', ['0'=>'Returning','1'=>'Returned'], $order_return_status,['class'=>'select2 form-control ', 'placeholder' => 'Please Select Return Status',]) }}
                                </div>
                              </fieldset>
                            </div>

                            <div class="col-12 d-flex justify-content-start">
                              <!-- <button type="submit" class="btn btn-primary mr-1 mb-1">Update</button> -->
                              {{ Form::submit('Update', array('class' => 'btn btn-primary mr-1 mb-1')) }}
                            </div>
                          </div>
                        </div>
                      {{ Form::close() }}
                    </div>
                  </div>
                </div>
              </div>
              @endif
              @if(isset($orders) && $orders->cancel_order_flag=='1')
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4 class="card-title">Order is Cancelled</h4>
                  </div>
                  <div class="card-content">
                    <div class="card-body">
                      
                        <div class="form-body">
                          <div class="row">
                            <div class="col-md-6 col-12">
                              <p><b>Reason:</b> {{$orders->cancel_reason}}</p>
                            </div>
                            <div class="col-md-6 col-12">
                              <p><b>Date:</b> {{$orders->cancel_order_date}}</p>
                            </div>
                          </div>
                        </div>
                    </div>
                  </div>
                </div>
              </div>
              @endif

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
@endsection
