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
            <th style="padding:5px 7px; " colspan="1">Tax Rate</th>
            <th style="padding:5px 7px; " colspan="1">Tax Type</th>
            <th style="padding:5px 7px;" colspan="2">Tax Amount</th>
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
                <td style="padding:5px 7px; " colspan="1">9%</td>
                <td style="padding:5px 7px; " colspan="1">IGST</td>
                <td style="padding:5px 7px; " colspan="2">18</td>
                <td style="padding:5px 7px; " colspan="2">{{ $item->qty*$item->product_price }}</td>
            </tr>
            @php
                $final_total = $final_total + ($item->product_price*$item->qty) ;
                $x++;
            @endphp
        @endforeach
        <tr>
            @if($orders->shipping_amount)
                <td style="text-align:end;border:1px solid #000; padding:5px 7px;" colspan="18"><p style="font-size: 16px;margin-bottom: 0rem; font-weight: 500;">SHIPPING CHARGES</p></td>
                <td style="border:1px solid #000; padding:5px 7px;" colspan="2">{{$orders->shipping_amount}}</td>
            @else
                <td style="text-align:end;border:1px solid #000; padding:5px 7px;" colspan="18"><p style="font-size: 16px;margin-bottom: 0rem; font-weight: 500;">SHIPPING CHARGES</p></td>
                <td style="border:1px solid #000; padding:5px 7px;" colspan="2">FREE</td>
            @endif

        </tr>

        <tr>
        @if($item->product_discounted_price)
            <tr>
                <td style="text-align:end;border:1px solid #000; padding:5px 7px;" colspan="18"><p style="font-size: 16px;margin-bottom: 0rem; font-weight: 500;">DISCOUNT</p></td>
                <td style="border:1px solid #000; padding:5px 7px;" colspan="2">- ₹{{$final_total-$orders->total}}</td>
            </tr>
        @endif
        @if($orders->coupon_discount)
            <tr>
                <td style="text-align:end;border:1px solid #000; padding:5px 7px;" colspan="18"><p style="font-size: 16px;margin-bottom: 0rem; font-weight: 500;">COUPON DISCOUNT</p></td>
                <td style="border:1px solid #000; padding:5px 7px;" colspan="2">- ₹{{$orders->coupon_discount}}</td>

                <td>COUPON DISCOUNT</td><td class="text-right price-color">- </td>
            </tr>
        @endif

        <tr>

            <td style="text-align:end;border:1px solid #000; padding:5px 7px;" colspan="18"><p style="font-size: 16px;margin-bottom: 0rem; font-weight: 500;">TOTAL</p></td>
            <!-- <td style="border:1px solid #000; padding:5px 7px;" colspan="2"></td> -->
            <td style="border:1px solid #000; padding:5px 7px;" colspan="2">{{ $orders->total + $orders->shipping_amount }}</td>
        </tr>
        @php
            $digit = new NumberFormatter( 'en', \NumberFormatter::SPELLOUT );
           $words= $digit->format($orders->total + $orders->shipping_amount);
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
