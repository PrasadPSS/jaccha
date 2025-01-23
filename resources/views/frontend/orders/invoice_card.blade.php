
<div class="col-lg-12 printinvoice pl-0 pr-0" >
  <table style="width: 100%;border-collapse:collapse;border:1px solid #000;">
    <tbody>
      <tr>
          <td colspan="2" style="font-family: 'Roboto', sans-serif !important;padding:12px;border-bottom: 0px !important;border-right:1px solid #000">
                  <h1 style="color:#000; font-size: 16px;text-align:center;margin-bottom:0px;">RETAIL / TAX INVOICE</h1>
              </a>
          </td>
        </tr>
        <tr>
            <td colspan="2" style="font-family: 'Roboto', sans-serif !important;padding:12px;border-top:0px !important;border-right:1px solid #000">
                    <img style="width:170px" src="{{ asset('frontend-assets/images/logoparwani.png') }}" style="">
            </td>
          </tr>
          <tr>
            <td colspan="2" class="first__td" style="font-family: 'Roboto', sans-serif !important;border-top:1px solid #000;padding:12px;border-right:1px solid #000; font-weight:500">
                  <p class="" style="font-size: 14px;color:#000;margin-bottom:0px;margin-top:0px;">AWB / TRACKING NUMBER: {{$orders->package_waybill}}</p>
            </td>
          </tr>
          <tr>
            <td  class="first__td" style="font-family: 'Roboto', sans-serif !important;vertical-align: baseline;padding:12px;border:1px solid #000;border-left: 0px;">
              <p style="font-family: 'Roboto', sans-serif !important;font-size: 14px;margin-bottom: 0rem !important; font-weight: bold;letter-spacing:.3px;margin-top:0px !important">TAX INVOICE NUMBER: {{$orders->invoice_counter_id}}</p>
              <p style="font-family: 'Roboto', sans-serif !important;font-size: 14px;margin-bottom: 0rem !important; font-weight: bold;margin-top:6px;letter-spacing:.3px">TAX INVOICE DATE: {{ \Carbon\Carbon::parse($orders->created_at)->format('d M Y')}}</p>
              <p style="font-family: 'Roboto', sans-serif !important;font-size: 14px;margin-bottom: 0rem !important; font-weight: bold;margin-top:6px;letter-spacing:.3px">ORDER NUMBER: {{$orders->orders_counter_id}}</p>
              <p style="font-family: 'Roboto', sans-serif !important;font-size: 14px;margin-bottom: 0rem !important; font-weight: bold;margin-top:6px;letter-spacing:.3px">ORDER DATE: {{ \Carbon\Carbon::parse($orders->created_at)->format('d M Y')}} </p>
            </td>
            <td  class="first__td" style="font-family: 'Roboto', sans-serif !important;vertical-align: baseline;padding:12px;border-top:1px solid #000">
              <p style="font-family: 'Roboto', sans-serif !important;font-size: 14px;margin-bottom: 0rem !important; font-weight: bold;letter-spacing:.3px;margin-top:0px !important">CARRIER NAME: DELIVERY</p>
              <p style="font-family: 'Roboto', sans-serif !important;font-size: 14px;margin-bottom: 0rem !important; font-weight: bold;margin-top:6px;letter-spacing:.3px">MODE OF PAYMENT: @if($orders->payment_mode=='Online')ONLINE @elseif($orders->payment_mode=='cod')COD @else- @endif</p>
              <p style="font-family: 'Roboto', sans-serif !important;font-size: 14px;margin-bottom: 0rem !important; font-weight: bold;margin-top:6px;letter-spacing:.3px">BILLING STATE: {{ strtoupper($orders->shipping_state)}} </p>
              <p style="font-family: 'Roboto', sans-serif !important;font-size: 14px;margin-bottom: 0rem !important; font-weight: bold;margin-top:6px;letter-spacing:.3px">PLACE OF SUPPLY: {{ strtoupper($company->state) }} </p>
            </td>
          </tr>
      <tr>
        <td  style="font-family: 'Roboto', sans-serif !important;vertical-align: top;padding:12px;border-left: 0px;border:1px solid #000;border-bottom:0px;" >
            <p style="font-family: 'Roboto', sans-serif !important;font-size: 15px;margin-bottom: 0px;font-weight: bold;margin-top:0px !important">SELLER'S NAME AND ADDRESS:</p>
            <span class="kt-invoice__desc" style="font-family: 'Roboto', sans-serif !important;line-height:20px;letter-spacing: .3px;">
              <span style="font-family: 'Roboto', sans-serif !important;font-size: 14px;">{{ $company->name }},</span><br>
              <span style="font-family: 'Roboto', sans-serif !important;font-size: 14px;">{{ $company->address_line1 }}</span><br>
              <span style="font-family: 'Roboto', sans-serif !important;font-size: 14px;">{{ $company->address_line2 }},</span><br>
              <span style="font-family: 'Roboto', sans-serif !important;font-size: 14px;">{{ $company->landmark }},</span><br>
              <span style="font-family: 'Roboto', sans-serif !important;font-size: 14px;">{{ $company->city }}</span><br>
              <span style="font-family: 'Roboto', sans-serif !important;font-size: 14px;">DISTRICT: {{ $company->district }},<br> {{ $company->state }}, {{ $company->country }}-{{ $company->pincode }}</span><br>
              <span style="font-family: 'Roboto', sans-serif !important;font-size: 14px;">GSTIN: {{ $company->gstno }}</span><br>
              <span style="font-family: 'Roboto', sans-serif !important;font-size: 14px;">Email: {{ $company->email }}</span><br>
            </span>
        </td>
        <td class="first__td" style="font-family: 'Roboto', sans-serif !important;padding:12px;border-top:1px solid #000;vertical-align:top;border-bottom:0px !important;" >
            <p style="font-family: 'Roboto', sans-serif !important;font-size: 15px;margin-bottom: 0px; font-weight: bold;margin-top:0px !important">BUYER'S NAME AND ADDRESS:</p>
            <span style="font-family: 'Roboto', sans-serif !important;font-size:14px;line-height:20px;letter-spacing: .3px;text-transform:uppercase">{{ $orders->shipping_full_name }},<br>
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


  <table border="1" style="width: 100% ;border-spacing:-1px;border-top-style:hidden;font-family: 'Roboto', sans-serif !important;" >
    <tbody>
      <tr style="background-color: #eaeaea !important;-webkit-print-color-adjust: exact; ">
        <th style="font-family: 'Roboto', sans-serif !important;padding:5px 4px;font-size: 12px;border:1px solid #000;background-color: #eaeaea !important; " border="1" rowspan="2">SKU DESCRIPTION</th>
        <th style="font-family: 'Roboto', sans-serif !important;padding:5px 4px;font-size: 12px;border:1px solid #000;background-color: #eaeaea !important; " rowspan="2">HSN #</th>
        <th style="font-family: 'Roboto', sans-serif !important;padding:5px 4px;font-size: 12px;border:1px solid #000;background-color: #eaeaea !important; " rowspan="2">MRP</th>
        <th style="font-family: 'Roboto', sans-serif !important;padding:5px 4px;font-size: 12px;border:1px solid #000;background-color: #eaeaea !important; " rowspan="2">SALE PRICE</th>
        <th style="font-family: 'Roboto', sans-serif !important;padding:5px 4px;font-size: 12px;border:1px solid #000;background-color: #eaeaea !important; " rowspan="2">QTY</th>
        <th style="font-family: 'Roboto', sans-serif !important;padding:5px 4px;font-size: 12px;border:1px solid #000;background-color: #eaeaea !important; " rowspan="2">DISC</th>
        <th style="font-family: 'Roboto', sans-serif !important;padding:5px 4px;font-size: 12px;border:1px solid #000;background-color: #eaeaea !important; " rowspan="2" >TAXABLE AMT</th>
        <th style="font-family: 'Roboto', sans-serif !important;padding:5px 4px;font-size: 12px;border:1px solid #000;background-color: #eaeaea !important; "  colspan="2">CGST</th>
        <th style="font-family: 'Roboto', sans-serif !important;padding:5px 4px;font-size: 12px;border:1px solid #000;background-color: #eaeaea !important; " colspan="2">SGST/UGST</th>
        <th style="font-family: 'Roboto', sans-serif !important;padding:5px 4px;font-size: 12px;border:1px solid #000;background-color: #eaeaea !important; " colspan="2">IGST</th>
        <th style="font-family: 'Roboto', sans-serif !important;padding:5px 4px;font-size: 12px;border:1px solid #000;background-color: #eaeaea !important; " rowspan="2">NET AMT</th>
      </tr>
      <tr>
        <th style="font-family: 'Roboto', sans-serif !important;padding:5px 4px;font-size: 12px;border:1px solid #000;background-color: #eaeaea !important;" >RATE</th>
        <th style="font-family: 'Roboto', sans-serif !important;padding:5px 4px;font-size: 12px;border:1px solid #000;background-color: #eaeaea !important;">Amt</th>
        <th style="font-family: 'Roboto', sans-serif !important;padding:5px 4px;font-size: 12px;border:1px solid #000;background-color: #eaeaea !important;">RATE</th>
        <th style="font-family: 'Roboto', sans-serif !important;padding:5px 4px;font-size: 12px;border:1px solid #000;background-color: #eaeaea !important;">Amt</th>
        <th style="font-family: 'Roboto', sans-serif !important;padding:5px 4px;font-size: 12px;border:1px solid #000;background-color: #eaeaea !important;">RATE</th>
        <th style="font-family: 'Roboto', sans-serif !important;padding:5px 4px;font-size: 12px;border:1px solid #000;background-color: #eaeaea !important;">Amt</th>
      </tr>
      @php
          $x=1;
      @endphp
      @foreach($orders->orderproducts as $item)
          <tr>
              <td style="font-family: 'Roboto', sans-serif !important;padding:5px 4px;font-size: 12px;border:1px solid #000" colspan="">{{ $item->product_sku.'('.$item->product_title.')' }}</td>
              <td style="font-family: 'Roboto', sans-serif !important;padding:5px 4px;font-size: 12px;border:1px solid #000" colspan="">{{ $item->products->hsncode->hsncode_name }}</td>
              <td style="font-family: 'Roboto', sans-serif !important;padding:5px 4px;font-size: 12px;border:1px solid #000" colspan="">{{ $item->product_price }}</td>
              <td style="font-family: 'Roboto', sans-serif !important;padding:5px 4px;font-size: 12px;border:1px solid #000" colspan="">{{ number_format($item->rev_sell_price,2) }}</td>
              <td style="font-family: 'Roboto', sans-serif !important;padding:5px 4px;font-size: 12px;border:1px solid #000" colspan="">{{ $item->qty }}</td>
              <td style="font-family: 'Roboto', sans-serif !important;padding:5px 4px;font-size: 12px;border:1px solid #000" colspan="">{{ $item->rev_discount }}</td>
              <td style="font-family: 'Roboto', sans-serif !important;padding:5px 4px;font-size: 12px;border:1px solid #000" colspan="">{{ $item->rev_taxable_amount }}</td>
              @if(1)
              <td style="font-family: 'Roboto', sans-serif !important;padding:5px 4px;font-size: 12px;border:1px solid #000" colspan="1">{{ $item->gst_cgst_rate }}</td>
              <td style="font-family: 'Roboto', sans-serif !important;padding:5px 4px;font-size: 12px;border:1px solid #000" colspan="1">{{ number_format($item->gst_cgst_amount,2) }}</td>
              <td style="font-family: 'Roboto', sans-serif !important;padding:5px 4px;font-size: 12px;border:1px solid #000" colspan="1">{{ $item->gst_sgst_rate }}</td>
              <td style="font-family: 'Roboto', sans-serif !important;padding:5px 4px;font-size: 12px;border:1px solid #000" colspan="1">{{ number_format($item->gst_sgst_amount,2) }}</td>
              <td style="font-family: 'Roboto', sans-serif !important;padding:5px 4px;font-size: 12px;border:1px solid #000" colspan="1">{{ $item->gst_igst_rate }}</td>
              <td style="font-family: 'Roboto', sans-serif !important;padding:5px 4px;font-size: 12px;border:1px solid #000" colspan="1">{{ number_format($item->gst_igst_amount, 2) }}</td>
              @endif
              <td style="font-family: 'Roboto', sans-serif !important;padding:5px 4px;font-size: 12px;" colspan="2">{{ number_format($item->product_discounted_price, 2) }}</td>
          </tr>
          @php
              $x++;
          @endphp
      @endforeach
      
      @if($orders->payment_mode == 'cod')
      <tr>
        <td style="text-align:left;border:1px solid #000; font-family: 'Roboto', sans-serif !important;padding:5px 4px;" colspan="0"><p style="font-size: 14px;margin-bottom: 0rem; font-weight: bold;margin-top:0px !important">COD CHARGES</p></td>
        <td style="font-family: 'Roboto', sans-serif !important;border:1px solid #000; padding:5px 4px;font-size: 12px;" colspan="">COD</td>
        <td style="font-family: 'Roboto', sans-serif !important;padding:5px 4px;font-size: 12px; ">{{ ($orders->cod_collection_charge)?$orders->cod_collection_charge:0.00 }}</td>
        <td style="font-family: 'Roboto', sans-serif !important;padding:5px 4px;font-size: 12px; ">{{ 0.00 }}</td>
        <td style="font-family: 'Roboto', sans-serif !important;padding:5px 4px;font-size: 12px; ">0.00</td>
        <td style="font-family: 'Roboto', sans-serif !important;padding:5px 4px;font-size: 12px; ">0.00</td>
        <td style="font-family: 'Roboto', sans-serif !important;padding:5px 4px;font-size: 12px; ">{{ ($orders->cod_collection_charge)?$orders->cod_collection_charge:0.00 }}</td>
        <td style="font-family: 'Roboto', sans-serif !important;padding:5px 4px;font-size: 12px; ">{{ ($orders->cod_cgst_percent)?$orders->cod_cgst_percent:0.00 }}</td>
        <td style="font-family: 'Roboto', sans-serif !important;padding:5px 4px;font-size: 12px; ">{{ ($orders->cod_cgst_amount)?$orders->cod_cgst_amount:0.00 }}</td>
        <td style="font-family: 'Roboto', sans-serif !important;padding:5px 4px;font-size: 12px; ">{{ ($orders->cod_sgst_percent)?$orders->cod_sgst_percent:0.00 }}</td>
        <td style="font-family: 'Roboto', sans-serif !important;padding:5px 4px;font-size: 12px; ">{{ ($orders->cod_sgst_amount)?$orders->cod_sgst_amount:0.00 }}</td>
        <td style="font-family: 'Roboto', sans-serif !important;padding:5px 4px;font-size: 12px; ">{{ ($orders->cod_igst_percent)?$orders->cod_igst_percent:0.00 }}</td>
        <td style="font-family: 'Roboto', sans-serif !important;padding:5px 4px;font-size: 12px; ">{{ ($orders->cod_igst_amount)?$orders->cod_igst_amount:0.00 }}</td>
        <td style="font-family: 'Roboto', sans-serif !important;border:1px solid #000; padding:5px 4px;font-size: 12px;" colspan=""> {{ ($orders->cod_collection_charge_amount)?$orders->cod_collection_charge_amount:0.00 }}</td>
      </tr>
    @endif

    <tr>
      <td style="font-family: 'Roboto', sans-serif !important;text-align:left;border:1px solid #000; padding:5px 4px;" colspan="0"><p style="font-family: 'Roboto', sans-serif !important;font-size: 14px;margin-bottom: 0rem; font-weight: bold;margin-top:0px !important">SHIPPING CHARGES</p></td>
      <td style="font-family: 'Roboto', sans-serif !important;border:1px solid #000; padding:5px 4px;font-size: 12px;" colspan="">@if($orders->shipping_amount!=0 && $orders->shipping_method_code!='free'){{$orders->shipping_amount}} @else FREE @endif</td>
      <td style="font-family: 'Roboto', sans-serif !important;padding:5px 4px;font-size: 12px; ">0.00</td>
      <td style="font-family: 'Roboto', sans-serif !important;padding:5px 4px;font-size: 12px; ">0.00</td>
      <td style="font-family: 'Roboto', sans-serif !important;padding:5px 4px;font-size: 12px; ">0</td>
      <td style="font-family: 'Roboto', sans-serif !important;padding:5px 4px;font-size: 12px; ">0.00</td>
      <td style="font-family: 'Roboto', sans-serif !important;padding:5px 4px;font-size: 12px; ">@if($orders->shipping_amount!=0 && $orders->shipping_method_code!='free'){{$orders->shipping_amount}} @else 0.00 @endif</td>
      <td style="font-family: 'Roboto', sans-serif !important;padding:5px 4px;font-size: 12px; ">0.00</td>
      <td style="font-family: 'Roboto', sans-serif !important;padding:5px 4px;font-size: 12px; ">0.00</td>
      <td style="font-family: 'Roboto', sans-serif !important;padding:5px 4px;font-size: 12px; ">0.00</td>
      <td style="font-family: 'Roboto', sans-serif !important;padding:5px 4px;font-size: 12px; ">0.00</td>
      <td style="font-family: 'Roboto', sans-serif !important;padding:5px 4px;font-size: 12px; ">0.00</td>
      <td style="font-family: 'Roboto', sans-serif !important;padding:5px 4px;font-size: 12px; ">0.00</td>
      <td style="font-family: 'Roboto', sans-serif !important;border:1px solid #000; padding:5px 4px;font-size: 12px;" colspan="">@if($orders->shipping_amount!=0 && $orders->shipping_method_code!='free'){{$orders->shipping_amount}} @else 0.00 @endif</td>
    </tr>
    @if($orders->coupon_discount)
          <tr>
            <td style="font-family: 'Roboto', sans-serif !important;text-align:left;border:1px solid #000; padding:5px 4px;" colspan="0"><p style="font-family: 'Roboto', sans-serif !important;font-size: 14px;margin-bottom: 0rem; font-weight: bold;margin-top:0px !important">COUPON DISCOUNT ({{$orders->coupon_code}})</p></td>
            <td style="font-family: 'Roboto', sans-serif !important;border:1px solid #000; padding:5px 4px;font-size: 12px;" colspan="">{{($orders->coupon_discount!='')?$orders->coupon_discount:0.00}}</td>
            <td style="font-family: 'Roboto', sans-serif !important;border:1px solid #000; padding:5px 4px;font-size: 12px;" colspan="">{{($orders->coupon_discount!='')?$orders->coupon_discount:0.00}}</td>
            <td style="font-family: 'Roboto', sans-serif !important;padding:5px 4px;font-size: 12px; ">0.00</td>
            <td style="font-family: 'Roboto', sans-serif !important;padding:5px 4px;font-size: 12px; ">0.00</td>
            <td style="font-family: 'Roboto', sans-serif !important;padding:5px 4px;font-size: 12px; ">0.00</td>
            <td style="font-family: 'Roboto', sans-serif !important;padding:5px 4px;font-size: 12px; ">{{($orders->coupon_discount!='')?$orders->coupon_discount:0.00}}</td>
            <td style="font-family: 'Roboto', sans-serif !important;padding:5px 4px;font-size: 12px; ">0.00</td>
            <td style="font-family: 'Roboto', sans-serif !important;padding:5px 4px;font-size: 12px; ">0.00</td>
            <td style="font-family: 'Roboto', sans-serif !important;padding:5px 4px;font-size: 12px; ">0.00</td>
            <td style="font-family: 'Roboto', sans-serif !important;padding:5px 4px;font-size: 12px; ">0.00</td>
            <td style="font-family: 'Roboto', sans-serif !important;padding:5px 4px;font-size: 12px; ">0.00</td>
            <td style="font-family: 'Roboto', sans-serif !important;padding:5px 4px;font-size: 12px; ">0.00</td>
            <td style="font-family: 'Roboto', sans-serif !important;border:1px solid #000; padding:5px 4px;font-size: 12px;" colspan="">{{($orders->coupon_discount!='')?number_format((float)$orders->coupon_discount, 2, '.', ''):0.00}}</td>
          </tr>
      @endif



      <tr>
        <td style="font-family: 'Roboto', sans-serif !important;text-align:right;border:1px solid #000; padding:5px 4px;font-size: 14px;" colspan="13"><p style="font-family: 'Roboto', sans-serif !important;font-size: 14px;margin-bottom: 0rem; font-weight: bold;margin-top:0px !important">TOTAL</p></td>
        <td style="font-family: 'Roboto', sans-serif !important;border:1px solid #000; padding:5px 4px;font-size: 12px;" colspan="2">{{ number_format($orders->total, 2)}}</td>
      </tr>
      @php
        $digit = new NumberFormatter('en', \NumberFormatter::SPELLOUT);
        $orderTotal = is_null($orders->total) ? 0 : $orders->total;
        $exp = explode('.', $orderTotal);
      if((count(collect($exp)))>=2){
        $words= ucwords($digit->format($exp[0])) . ' Rupees and ' . 
       ucwords($digit->format($exp[1])).' Paise';
      }else {
          $words= ucwords($digit->format($exp[0])).' Rupees';
        }
        //$words = '';
      @endphp
      <tr>
          <td style="font-family: 'Roboto', sans-serif !important;padding: 5px 0px;border:1px solid #000" colspan="14"><p style="font-size: 14px;margin-bottom: 0rem; font-weight: bold;padding:0px 7px;margin-top:0px !important">Amount in Words: {{$words}} Only</p></td>
      </tr>
      <tr>
          <td style="font-family: 'Roboto', sans-serif !important;padding: 5px 0px;border:1px solid #000;" colspan="14">
            <p style="font-family: 'Roboto', sans-serif !important;font-size: 14px;margin-bottom: 0rem; font-weight: bold;padding:0px 7px;margin-top:0px !important">1. The Products sold as part of this shipment are intended for personal consumption of the customer and not for re-sale or commercial purposes.</p>
            <p style="font-family: 'Roboto', sans-serif !important;font-size: 14px;margin-bottom: 0rem; font-weight: bold;padding:0px 7px;">2. This is a computer generated invoice.</p>
            <p style="font-family: 'Roboto', sans-serif !important;font-size: 14px;margin-bottom: 0rem; font-weight: bold;padding:0px 7px;">3. Subject to Ulhasnagar Jurisdiction</p>
        </td>
      </tr>
      <tr>
        <td colspan="7" style="font-family: 'Roboto', sans-serif !important;vertical-align: top;padding: 0px 5px;text-align:left;border:1px solid #000">
          <p style="font-family: 'Roboto', sans-serif !important;margin-bottom:5px;font-size:15px;margin-top:0px !important">www.jaccha.com</p>
          <p style="font-family: 'Roboto', sans-serif !important;margin-bottom:15px;font-size:14px">NOTE: PLEASE DO NOT ACCEPT IF THE PARCEL IS TAMPERED</p>
          <p style="font-family: 'Roboto', sans-serif !important;margin-bottom:0px;font-size:14px">E. & O. E</p>
        </td>
        <td colspan="7" style="font-family: 'Roboto', sans-serif !important;text-align:end;padding: 0px 5px;border:1px solid #000">
            <p style="font-family: 'Roboto', sans-serif !important;font-size: 14px; font-weight: bold;margin-top:0px !important"> For {{ $company->name }}</p>
            <!-- <img width="100"   src="{{ asset('frontend-assets/images/Signature.png') }}" alt="Signature"> -->
            <p style="font-family: 'Roboto', sans-serif !important;font-size: 14px;margin-top: 1rem; font-weight: bold;">Authorized Signatory</p>
        </td>
      </tr>
      </tbody>
  </table>
</div>
