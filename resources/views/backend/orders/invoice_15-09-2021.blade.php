<section id="cart" style="padding-top: 10%; padding-bottom: 5%;">
    <div class="container" >
        <div class="row tablerow">
            <div class="col-sm-12">
                <div class="kt-content kt-grid__item kt-grid__item--fluid" id="kt_content">
                    <div class="row">
                        <div class="col-sm-12">
                            <p class="text-center">
                                <a style="padding: .5rem 1.55rem;border-radius: 0px; border: 2px solid #000; background-color: #fff; color: #FFFFFF;box-shadow: none;" href="javascript:void(0);" class="btn btn-primary" onclick="PrintElem('.printinvoice');">Print</a>
                                <a style="padding: .5rem 1.55rem;border-radius: 0px; border: 2px solid #000; background-color: #fff; color: #FFFFFF;box-shadow: none;" href="{{url('admin/orders/invoice/'.$orders->order_id)}}" class="btn btn-primary ml-1" >Download Invoice</a>
                            </p>
                        </div>
                        <div class="col-lg-12 printinvoice" style="padding:10px 10px;box-shadow: 0 1px 3px rgba(0,0,0,0.12), 0 1px 2px rgba(0,0,0,0.24); ">
                            <table style="width: 100%;">
                                <tbody>
                                <tr>
                                    <td colspan="10" style="vertical-align: baseline;">
                                        <a href="#">
                                            <h1 style="color:#d68d51; font-size: 22px;">INVOICE</h1>
                                            <img  src="{{ asset('frontend-assets/images/logoparwani.png') }}" style="">
                                        </a>
                                    </td>
                                    <td colspan="10" style="text-align: end;">
                                        <h1 style="font-size: 18px;">Tax Invoice/Bill of Supply/Cash Memo</h1>
                                        <p style="font-size: 14px;">(Original for Recipient)</p>
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="10" style="padding-top: 20px;">
                                        <p style="font-size: 16px;margin-bottom: 0rem;font-weight: 500;">Sold By:</p>
                                        <span class="kt-invoice__desc">
                  <span style="font-size: 14px;">G. R. PARWANI TRADING CO. 403,</span><br>
                  <span style="font-size: 14px;">HARNAM APARTMENT 4TH FLOOR</span><br>
                  <span style="font-size: 14px;">SECTION 30, NEAR GURUDWARA,</span><br>
                  <span style="font-size: 14px;">ULHASNAGAR-421004</span><br>
                  <span style="font-size: 14px;">DISTRICT: THANE, MAHARASHTRA, INDIA</span><br>
                  <span style="font-size: 14px;">Mobile : 7498042995</span><br>
                  <span style="font-size: 14px;">Email : dadreeios@gmail.com</span><br>
                  <span style="font-size: 14px;">GSTIN : 2222222222</span><br>
            </span>
                                    </td>
                                    <td colspan="10"style="vertical-align: baseline;padding-top: 20px;text-align: end;" >
                                        <p style="font-size: 18px;margin-bottom: 0rem; font-weight: 600;">Billing Address :</p>
                                        <span style="font-size:14px;">{{ $orders->shipping_full_name }},<br>
          {{ $orders->shipping_address_line1 }},<br>
          {{ $orders->shipping_address_line2 }},<br>
          {{ $orders->shipping_city}}, {{ $orders->shipping_state}}<br>
          Pincode - {{ $orders->shipping_pincode}}<br>
          Mobile - {{ $orders->shipping_mobile_no}}<br>
          <!-- Email - {{ $orders->email}}<br> -->
        </span>
                                        {{--                                            <p style="font-size: 16px;margin-bottom: 0rem; font-weight: 500;">State/UT Code: {{ $orders->shipping_state}} </p>--}}
                                        {{--                                            <p style="font-size: 16px;margin-bottom: 0rem; font-weight: 500;">Place of supply:{{ $orders->shipping_landmark .', '.$orders->shipping_address_line1 .', '. $orders->shipping_district}}</p>--}}
                                        {{--                                            <p style="font-size: 16px;margin-bottom: 0rem; font-weight: 500;">Place of delivery:{{ $orders->shipping_landmark .', '.$orders->shipping_address_line1 .', '. $orders->shipping_district}}</p>--}}
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="10" style="vertical-align: baseline;">
                                        <p style="font-size: 16px;margin-bottom: 0rem; font-weight: 500;">Order Number:{{$orders->orders_counter_id}}</p>
                                        <p style="font-size: 16px;margin-bottom: 0rem; font-weight: 500;">Order Date:{{ \Carbon\Carbon::parse($orders->created_at)->format('d M Y')}} </p>
                                        <p style="font-size: 16px;margin-bottom: 0rem; font-weight: 500;">Invoice Number :# {{$orders->orders_counter_id}}</p>
                                        {{--                                            <p style="font-size: 16px;margin-bottom: 0rem; font-weight: 500;">Invoice Details :</p>--}}
                                        <p style="font-size: 16px;margin-bottom: 0rem; font-weight: 500;">Invoice Date :{{ \Carbon\Carbon::parse($orders->created_at)->format('d M Y')}}</p>
                                    </td>
                                    <td colspan="10"style="vertical-align: baseline;padding: 10px 0px;text-align: end;" >
                                        <p style="font-size: 18px;margin-bottom: 0rem; font-weight: 600;">Shipping Address :</p>
                                        <span style="font-size: 14px;"class="kt-invoice__text">{{ $orders->shipping_full_name }},<br>
                                          {{ $orders->shipping_address_line1 }},<br>
                                          {{ $orders->shipping_address_line2 }},<br>
                                          {{ $orders->shipping_city}}, {{ $orders->shipping_state}}<br>
                                          Pincode - {{ $orders->shipping_pincode}}<br>
                                          Mobile - {{ $orders->shipping_mobile_no}}<br>
                                          <!-- Email - {{ $orders->email}}<br> -->
                                        </span>


                                    </td>
                                </tr>

                                </tbody>
                            </table>


                            <table border="1" style="width: 100%;border-collapse: collapse;">
                                <tbody>
                                <tr style="background-color: #eaeaea;  ">
                                    <th style="padding:5px 7px; " colspan="1">#</th>
                                    <th style="padding:5px 7px; " colspan="8">Description</th>
                                    <th style="padding:5px 7px; " colspan="2">Unit Price</th>
                                    <th style="padding:5px 7px; " colspan="1">Qty</th>
                                    <th style="padding:5px 7px; " colspan="2">Net Amount</th>
                                    @if(false)
                                    <th style="padding:5px 7px; " colspan="1">Tax Rate</th>
                                    <th style="padding:5px 7px; " colspan="1">Tax Type</th>
                                    <th style="padding:5px 7px;" colspan="2">Tax Amount</th>
                                    @endif
                                    <th style="padding:5px 7px; " colspan="2">Total Amount</th>
                                </tr>
                                @php
                                    $final_total = 0;
                                    $product_info = "";
                                    $x=1;
                                @endphp
                                @foreach($orders->orderproducts as $item)
                                    <tr>

                                        <td style="padding:5px 7px; " colspan="1">@if($item->schemes_id =='' or $item->schemes_id == NULL){{ $x }}@endif</td>
                                        <td style="padding:5px 7px; " colspan="8">@if($item->schemes_id !='')( {{ $item->scheme_title }} ) @endif{{ $item->product_title }}</td>
                                        <td style="padding:5px 7px; " colspan="2">{{ $item->product_price }}</td>
                                        <td style="padding:5px 7px; " colspan="1">{{ $item->qty }}</td>
                                        <td style="padding:5px 7px; " colspan="2">{{ $item->qty*$item->product_price }}</td>
                                        @if(false)
                                        <td style="padding:5px 7px; " colspan="1">9%</td>
                                        <td style="padding:5px 7px; " colspan="1">IGST</td>
                                        <td style="padding:5px 7px; " colspan="2">18</td>
                                        @endif
                                        <td style="padding:5px 7px; " colspan="2">{{ $item->qty*$item->product_price }}</td>
                                    </tr>
                                    @php
                                        $final_total = $final_total + ($item->product_price*$item->qty) ;
                                        $x++;
                                    @endphp
                                @endforeach
                                <tr>
                                    @if($orders->shipping_amount)
                                        <td style="text-align:end;border:1px solid #000; padding:5px 7px;" colspan="@if(false)18 @else 14 @endif"><p style="font-size: 16px;margin-bottom: 0rem; font-weight: 500;">SHIPPING CHARGES</p></td>
                                        <td style="border:1px solid #000; padding:5px 7px;" colspan="2">{{$orders->shipping_amount}}</td>
                                    @else
                                        <td style="text-align:end;border:1px solid #000; padding:5px 7px;" colspan="@if(false)18 @else 14 @endif"><p style="font-size: 16px;margin-bottom: 0rem; font-weight: 500;">SHIPPING CHARGES</p></td>
                                        <td style="border:1px solid #000; padding:5px 7px;" colspan="2">FREE</td>
                                    @endif

                                </tr>

                                <tr>
                                @if($item->product_discounted_price)
                                    <tr>
                                        <td style="text-align:end;border:1px solid #000; padding:5px 7px;" colspan="@if(false)18 @else 14 @endif"><p style="font-size: 16px;margin-bottom: 0rem; font-weight: 500;">DISCOUNT</p></td>
                                        <td style="border:1px solid #000; padding:5px 7px;" colspan="2">- ₹{{($orders->total_mrp_dicount!='')?$orders->total_mrp_dicount:0}}</td>
                                    </tr>
                                @endif
                                @if($orders->coupon_discount)
                                    <tr>
                                        <td style="text-align:end;border:1px solid #000; padding:5px 7px;" colspan="@if(false)18 @else 14 @endif"><p style="font-size: 16px;margin-bottom: 0rem; font-weight: 500;">COUPON DISCOUNT</p></td>
                                        <td style="border:1px solid #000; padding:5px 7px;" colspan="2">- ₹{{($orders->coupon_discount!='')?$orders->coupon_discount:0}}</td>

                                        <!-- <td>COUPON DISCOUNT</td><td class="text-right price-color">- </td> -->
                                    </tr>
                                @endif

                                <tr>

                                    <td style="text-align:end;border:1px solid #000; padding:5px 7px;" colspan="@if(false)18 @else 14 @endif"><p style="font-size: 16px;margin-bottom: 0rem; font-weight: 500;">TOTAL</p></td>
                                    <!-- <td style="border:1px solid #000; padding:5px 7px;" colspan="2"></td> -->
                                    <td style="border:1px solid #000; padding:5px 7px;" colspan="2">{{ $orders->total}}</td>
                                </tr>
                                @php
                                    //$digit = new NumberFormatter( 'en', \NumberFormatter::SPELLOUT );
                                   //$words= $digit->format($orders->total + $orders->shipping_amount);
                                   $words = '';
                                @endphp
                                <tr>
                                    <td style="padding: 5px 0px;" colspan="10"><p style="font-size: 16px;margin-bottom: 0rem; font-weight: 500;padding:0px 7px;">Amount in Words: </p></td>

                                    <td style="padding: 5px 0px;" colspan="10"><p style="font-size: 16px;margin-bottom: 0rem; font-weight: 500;padding:0px 7px;">{{$words}} only </p></td>
                                </tr>

                                <tr style="text-align:end;padding: 10px 5px; border-bottom: 1px solid #000;">
                                    <td colspan="20" style="text-align:end;padding: 10px 5px;">
                                        <p style="font-size: 16px;margin-bottom: 0rem; font-weight: 500;">Dadreeios : G. R. PARWANI TRADING</p>
                                        <img width="200" height="70" src="{{ asset('frontend-assets/images/Signature.jpg') }}" alt="Signature">
                                        <p style="font-size: 16px;margin-top: 1rem; font-weight: 500;">Authorized Signatory</p>
                                    </td>
                                </tr>

                                <tr>
                                    <td colspan="20" style="padding: 2px 7px; ">
                                        <p style="margin-bottom: 0rem;">*This is computer generated invoice.</p>
                                    </td>
                                </tr>


                                @php
                                    $discount_value = $final_total * $item->discount_percent/100;
                                    $final_discounted_value = $final_total - $discount_value;
                                    $gst_value = $final_discounted_value * $item->gst_percent/100;
                                    $grand_total = $final_discounted_value + $gst_value;
                                    $product_info .= $item->name.",";
                                @endphp
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>











<!-- <div class="container-fluid">
        <div class="row tablerow">

          <div class="col-sm-12">
            <div class="kt-content kt-grid__item kt-grid__item--fluid" id="kt_content">
		<div class="row">
      <div class="col-sm-12">
      <p class="text-center">
      <a href="javascript:void(0);" class="btn btn-primary" onclick="PrintElem('.printinvoice');">Print</a>
    </p>
  </div>
	<div class="col-lg-12 printinvoice">
		<div class="kt-portlet">
			<div class="kt-portlet__body kt-portlet__body--fit">
				<div class="kt-invoice-2">
					<div class="kt-invoice__wrapper ">
						<div class="kt-invoice__head">
							<div class="kt-invoice__container kt-invoice__container--centered">
								<div class="kt-invoice__logo">
									<a href="#">
										<h1>INVOICE</h1>
                    <img src="{{ asset('frontend-assets/images/logoparwani.png') }}" style="margin-top: 30px;">
									</a>
                  <span class="kt-invoice__desc">
  									<span>Dadreeios,<br> G. R. PARWANI TRADING CO. 403,</span>
                    <span>HARNAM APARTMENT 4TH FLOOR</span>
  									<span>SECTION 30, NEAR GURUDWARA,</span>
                    <span>ULHASNAGAR-421004</span>
                    <span>DISTRICT: THANE, MAHARASHTRA, INDIA</span>
                    <span>Mobile : 7498042995</span>
                    <span>Email : dadreeios@gmail.com</span>
                    <span>GSTIN : 2222222222</span>
                    <span>Bank Name : HDFC BANK</span>
                    <span>Ac No. : 50200037516040</span>
                    <span>IFSC CODE : HDFC0009159</span>
  								</span>
								</div>

								<div class="kt-invoice__items">
									<div class="kt-invoice__item">
										<span class="kt-invoice__subtitle">DATE</span>
										<span class="kt-invoice__text">{{ \Carbon\Carbon::parse($orders->created_at)->format('d M Y')}}</span>
									</div>
									<div class="kt-invoice__item">
										<span class="kt-invoice__subtitle">INVOICE NO.</span>
										<span class="kt-invoice__text"># {{$orders->orders_counter_id}}</span>
									</div>
									<div class="kt-invoice__item">
										<span class="kt-invoice__subtitle">INVOICE TO.</span>
										<span class="kt-invoice__text">{{ $users->name }},<br>
                      {{ $users->address }}<br>
                      {{ $users->city}}, {{ $users->state}}<br>
                      Pincode - {{ $users->pincode}}<br>
                      Mobile - {{ $users->mobile_no}}<br>
                      Email - {{ $users->email}}<br>
										</span>
									</div>
								</div>
							</div>
						</div>
						<div class="kt-invoice__body kt-invoice__body--centered">
							<div class="table-responsive">
								<table class="table">
									<thead>
									<tr>
                    <th>#</th>
										<th style='text-align:left'>PRODUCT NAME</th>
										<th>UNIT PRICE</th>
										<th>QTY</th>
										<th>TOTAL</th>
									</tr>
									</thead>
                  <tbody>
                      @php
    $final_total = 0;
    $product_info = "";
    $x=1;
@endphp
@foreach($orders->orderproducts as $item)
    <tr>
        <td>@if($item->schemes_id =='' or $item->schemes_id == NULL){{ $x }}@endif</td>
                          <td style='text-align:left'>@if($item->schemes_id !='')( {{ $item->scheme_title }} ) @endif{{ $item->name }}</td>
                          <td>{{ $item->product_price }}</td>
                          <td>{{ $item->qty }}</td>
                          <td>{{ $item->qty*$item->product_price }}</td>
                      </tr>
                       @php
        $final_total = $final_total + ($item->product_price*$item->qty);
        $x++;
    @endphp
@endforeach
@php

    $discount_value = $final_total * $item->discount_percent/100;
    $final_discounted_value = $final_total - $discount_value;
    $gst_value = $final_discounted_value * $item->gst_percent/100;
    $grand_total = $final_discounted_value + $gst_value;
    $product_info .= $item->name.",";
@endphp
        <tr><td colspan="4" align="right"><b>Total</b></td><td>@php echo $final_total; @endphp</td></tr>
                      <tr><td colspan="4" align="right"><b>Discount</b></td><td>@php echo $discount_value; @endphp</td></tr>
                      <tr><td colspan="4" align="right"><b>Total After Discount</b></td><td>@php echo $final_discounted_value @endphp</td></tr>
                      <tr><td colspan="4" align="right"><b>GST ( {{ $item->gst_percent."%" }} )</b></td><td>@php echo $gst_value @endphp</td></tr>
                      <?php if ($item->shipping_method_code != ''){ ?>
        <tr>
          <td colspan="4" align="right"><b>Shipping Method(<?=$item->shipping_method_code;?>)</b></td>
                        <td><?=$item->shipping_method_cost;?></td>
                        @php
    $grand_total = $grand_total + $item->shipping_method_cost;
    $shipping_method_code = $item->shipping_method_code;
    $shipping_method_cost = $item->shipping_method_cost;
@endphp
        </tr>
<?php }?>
@if($orders->account_type == 'P')
    @php
        $wallet_payement = PaymentInfo::where('payment_tracking_code',$orders->payment_tracking_code)->where('payment_mode','wallet')->first();
        $wallet_payement_amount = isset($wallet_payement->amount)?$wallet_payement->amount:0;
        $grand_total = $grand_total - $wallet_payement_amount;
    @endphp
            <tr><td colspan="4" align="right"><b>Paid through Wallet</b></td><td>@php echo $wallet_payement_amount @endphp</td></tr>
                          <tr><td colspan="4" align="right"><b>Grand Total</b></td><td>@php echo $grand_total @endphp</td></tr>
                          <tr><td colspan="4" align="right"><b>Wallet Bonus Earned</b></td><td class="kt-font-danger">@php echo round($wallet_bonus_earn) @endphp</td></tr>
                        @elseif($orders->account_type == 'D')
    <tr><td colspan="4" align="right"><b>Grand Total</b></td><td>@php echo $grand_total @endphp</td></tr>
                        @endif
        </tbody>
                      </table>
                  </div>
              </div>
              <div class="kt-invoice__footer">
                  <div class="kt-invoice__table  kt-invoice__table--centered table-responsive">
                      <table class="table">
                          <thead>
                          <tr>
                              <th>PAYMENT MODE</th>
                              <th>TRANSACTION ID</th>
                              <th>TOTAL AMOUNT</th>
                          </tr>
                          </thead>
                          <tbody>
                          <tr>
                              <td>{{ $orders->payment_mode}}</td>
										<td>{{ $orders->transaction_id}}</td>
										<td class="kt-font-danger">@php echo round($grand_total) @endphp</td>
									</tr>
									</tbody>
								</table>
                <p class="pt-3">*This is computer generated invoice no signature required.</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
 	</div>
          </div>

    </div>
    </div> -->
</section>
