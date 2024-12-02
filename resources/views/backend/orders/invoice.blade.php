<section id="basic-datatable" style="padding-top: 10%; padding-bottom: 5%;">
    <div class="container" >
        <div class="row tablerow">
            <div class="col-sm-12">
                <div class="kt-content kt-grid__item kt-grid__item--fluid" id="kt_content">
                    <div class="row">
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
                                          <span style="font-size: 14px;">{{ $company->address_line1 }}</span><br>
                                          <span style="font-size: 14px;">{{ $company->address_line2 }}</span><br>
                                          <span style="font-size: 14px;">{{ $company->landmark }},</span><br>
                                          <span style="font-size: 14px;">{{ $company->city }}-{{ $company->pincode }}</span><br>
                                          <span style="font-size: 14px;">DISTRICT: {{ $company->district }}, {{ $company->state }}, {{ $company->country }}</span><br>
                                          <span style="font-size: 14px;">Mobile : {{ $company->mobile_no }}</span><br>
                                          <span style="font-size: 14px;">Email : {{ $company->email }}</span><br>
                                          <span style="font-size: 14px;">GSTIN : {{ $company->gstno }}</span><br>
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
                                        <p style="font-size: 16px;margin-bottom: 0rem; font-weight: 500;">State/UT Code: {{ $orders->shipping_state}} </p>
                                        <p style="font-size: 16px;margin-bottom: 0rem; font-weight: 500;">Place of supply:{{$company->city .', '. $company->district}}</p>
                                        <p style="font-size: 16px;margin-bottom: 0rem; font-weight: 500;">Place of delivery:{{ $orders->shipping_landmark .', '.$orders->shipping_address_line1 .', '. $orders->shipping_district}}</p>
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
                                    $x=1;
                                @endphp
                                @foreach($orders->orderproducts as $item)
                                    <tr>

                                        <td style="padding:5px 7px; " colspan="1">@if($item->schemes_id =='' or $item->schemes_id == NULL){{ $x }}@endif</td>
                                        <td style="padding:5px 7px; " colspan="8">@if($item->schemes_id !='')( {{ $item->scheme_title }} ) @endif{{ $item->product_title }}</td>
                                        <td style="padding:5px 7px; " colspan="2">{{ $item->product_discounted_price }}</td>
                                        <td style="padding:5px 7px; " colspan="1">{{ $item->qty }}</td>
                                        <td style="padding:5px 7px; " colspan="2">{{ $item->qty*$item->product_discounted_price }}</td>
                                        @if(false)
                                        <td style="padding:5px 7px; " colspan="1">9%</td>
                                        <td style="padding:5px 7px; " colspan="1">IGST</td>
                                        <td style="padding:5px 7px; " colspan="2">18</td>
                                        @endif
                                        <td style="padding:5px 7px; " colspan="2">{{ $item->qty*$item->product_discounted_price }}</td>
                                    </tr>
                                    @php
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
                                @if($orders->total_mrp_dicount)
                                    <tr>
                                        <td style="text-align:end;border:1px solid #000; padding:5px 7px;" colspan="@if(false)18 @else 14 @endif"><p style="font-size: 16px;margin-bottom: 0rem; font-weight: 500;">DISCOUNT</p></td>
                                        <td style="border:1px solid #000; padding:5px 7px;" colspan="2">- ₹{{($orders->total_mrp_dicount!='')?$orders->total_mrp_dicount:0}}</td>
                                    </tr>
                                @endif
                                @if($orders->coupon_discount)
                                    <tr>
                                      <td style="text-align:end;border:1px solid #000; padding:5px 7px;" colspan="@if(false)18 @else 14 @endif"><p style="font-size: 16px;margin-bottom: 0rem; font-weight: 500;">COUPON DISCOUNT</p></td>
                                      <td style="border:1px solid #000; padding:5px 7px;" colspan="2">- ₹{{($orders->coupon_discount!='')?$orders->coupon_discount:0}}</td>
                                    </tr>
                                @endif
                                <tr>
                                  <td style="text-align:end;border:1px solid #000; padding:5px 7px;" colspan="@if(false)18 @else 14 @endif"><p style="font-size: 16px;margin-bottom: 0rem; font-weight: 500;">TOTAL PAYABLE AMOUNT</p></td>
                                  <td style="border:1px solid #000; padding:5px 7px;" colspan="2">₹{{$orders->total}}</td>
                                </tr>
                                <!-- <tr>
                                  <td style="text-align:end;border:1px solid #000; padding:5px 7px;" colspan="@if(false)18 @else 14 @endif">PAYMENT MODE</td>
                                  <td style="border:1px solid #000; padding:5px 7px;" colspan="2">@if($orders->payment_mode=='payumoney')Online @elseif($orders->payment_mode=='cod')COD @else- @endif</td>
                                </tr> -->
                                <tr>
                                  <td style="text-align:end;border:1px solid #000; padding:5px 7px;" colspan="@if(false)18 @else 14 @endif"><p style="font-size: 16px;margin-bottom: 0rem; font-weight: 500;">TOTAL</p></td>
                                  <td style="border:1px solid #000; padding:5px 7px;" colspan="2">{{ $orders->total}}</td>
                                </tr>
                                @php
                                  $digit = new NumberFormatter('en', \NumberFormatter::SPELLOUT);
                                  $words= ucwords($digit->format($orders->total));
                                  //$words = '';
                                @endphp
                                <tr>
                                    <td style="padding: 5px 0px;" colspan="10"><p style="font-size: 16px;margin-bottom: 0rem; font-weight: 500;padding:0px 7px;">Amount in Words: </p></td>
                                    <td style="padding: 5px 0px;" colspan="10"><p style="font-size: 16px;margin-bottom: 0rem; font-weight: 500;padding:0px 7px;">{{$words}} Only </p></td>
                                </tr>
                                <tr style="text-align:end;padding: 10px 5px; border-bottom: 1px solid #000;">
                                    <td colspan="20" style="text-align:end;padding: 10px 5px;">
                                        <p style="font-size: 16px;margin-bottom: 0rem; font-weight: 500;">Dadreeios : {{ $company->name }}</p>
                                        <img width="200" height="70" src="{{ asset('frontend-assets/images/Signature.jpg') }}" alt="Signature">
                                        <p style="font-size: 16px;margin-top: 1rem; font-weight: 500;">Authorized Signatory</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="20" style="padding: 2px 7px; ">
                                        <p style="margin-bottom: 0rem;">*This is computer generated invoice.</p>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
