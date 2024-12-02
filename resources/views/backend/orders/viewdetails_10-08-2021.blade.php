@extends('backend.layouts.app')
@section('title', 'Order Details')
@section('content')

    <!--order details section start-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
    <div class="container top-padding">
        <div class="row">
            <div class="col-lg-8 col-md-12 col-sm-12 col-12">
                <div class="row ">
                    <div class="col-md-12 col-sm-12 col-12">
                        <div class="order-details">
                            <h1>Order Details</h1>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-lg-2 col-md-12 col-sm-12 col-12">

            </div>
        </div>
    </div>
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
                                                    <span class="delivery-pro-price">₹{{ $orderproducts->product_price }}</span>
{{--                                                    <span class="delivery-pro-original">₹{{ $orderproducts->product_discounted_price }}</span>--}}
                                                    @if($orderproducts->product_discount_type=='percent')
                                                    <span class="delivery-pro-discount">({{ $orderproducts->product_discount }}% OFF)</span>
                                                        @elseif(($orderproducts->product_discount_type=='flat'))
                                                        <span class="delivery-pro-discount">(₹{{ $orderproducts->product_discount }} OFF)</span>
                                                        @endif
                                                </p>
                                                <p>
                                                    <span class="delivery-pro-description">You are saving  ₹{{ $orderproducts->product_discounted_price * $orderproducts->qty }} on this Order</span>
                                                </p>
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
                            @endif


                        </div>
                    </div>

                </div>
                <div class="col-lg-4 col-md-12 col-sm-12 col-12">
                    <div class="order-details-box">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-12 ">
                                <div class="price-details">
                                    <h2>SHIPPING DETAILS</h2>
                                </div>
                            </div>
                        </div>
                        @if(isset($shipping_address))
                        <div class="row">
                            <div class="col-md-12">
                                <div class="ord-address">
                                    <p class="ord-name"><span class="ord-name-space">{{$shipping_address->shipping_full_name}} </span><span class="home-link">{{$shipping_address->shipping_address_type}}</span></p>
                                    <p class="ord-add">{{$shipping_address->shipping_landmark}}<br>{{$shipping_address->shipping_address_line1}}<br>{{$shipping_address->shipping_address_line2}} - {{$shipping_address->shipping_pincode}}</p>
                                    <p class="ord-contact">Contact Number: {{$shipping_address->shipping_mobile_no}}
                                        @if($shipping_address->shipping_alt_mobile_no)
                                        /{{$shipping_address->shipping_alt_mobile_no}} </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                            @endif

                    </div>
                    <div class="order-details-box">
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-12 ">
                                <div class="price-details">
                                    <h2>PRICE DETAILS</h2>
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
                                        <td>TOTAL M.R.P. (Inclusive of all taxes)</td><td class="text-right">₹{{$total_productprice }}</td>
                                    </tr>
                                    <tr>
                                        @if($orders->shipping_amount)
                                            <td>SHIPPING CHARGES</td><td class="text-right price-color">₹{{$orders->shipping_amount}}</td>
                                        @else
                                        <td>SHIPPING CHARGES</td><td class="text-right price-color">FREE</td>
                                            @endif
                                    </tr>
                                    @if($orderproducts->product_discounted_price)
                                    <tr>
                                        <td>CART DISCOUNT </td><td class="text-right price-color">- ₹{{$total_productprice-$orders->total}}</td>
                                    </tr>
                                    @endif
                                    @if($orders->coupon_discount)
                                    <tr>
                                        <td>COUPON DISCOUNT</td><td class="text-right price-color">- ₹{{$orders->coupon_discount}}</td>
                                    </tr>
                                    @endif
                                    <tr class=" total-amount">
                                        <td>TOTAL PAYABLE AMOUNT</td><td class="text-right">₹{{$orders->total}}</td>
                                    </tr>
                                    <tr class=" total-amount">
                                        <td>TOTAL AMOUNT PAID</td><td class="text-right">₹{{$orders->total +$orders->shipping_amount }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>

        <div class="container pb-4">
            <div class="row delivery-details-row">
                <div class="confirm-product-btn">
                    <a href="{{route('admin.orders')}}" class="btn btn-primary" >GO BACK</a>
                </div>
            </div>
        </div>
        </div>
    </div>
        <!--order details section end-->
    @endif
    <!-- hide show content -->
    <script>
        $('.viewdetails-content').click(function() {
            $('#targetshow').toggle(0);
        });
    </script>
@endsection
