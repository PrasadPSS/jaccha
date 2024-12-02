@if(isset($orderproducts))
<div class="col-md-12 mt-4 printinvoice_{{ $orderproducts->product_id }} thermel-print">
  <table class="" style="width:100%;border:3px solid #7d7c7c !important;padding:10px 10px 10px 10px !important;border-collapse:collapse;">
    <tr>
      <td colspan="2" style="border:none;padding:10px 10px 10px 10px;"><strong>DADREEIOS</strong></td>
    </tr>
    <tr>
      <td style="border:none;padding:10px 10px 10px 10px;" colspan="2">
        <strong>{{ $orderproducts->product_sub_title }}</strong></br>
        {{ $orderproducts->product_title }}
      </td>
    </tr>
    <tr>
      <td colspan="2" style="border:none;padding:10px 10px 0px 10px;">PRODUCT ID: {{ ($orderproducts->product_id) }}</td>
    </tr>
    <tr>
      <td colspan="2" style="border:none;padding:0px 10px 0px 10px;">PRODUCT HSN CODE: {{ ($orderproducts->product_hsn) }}</td>
    </tr>
    <tr>
      <td colspan="2" style="border:none;padding:0px 10px 10px 10px;">COUNTRY OF ORIGIN: {{ isset($orderproducts->products->country->name)?$orderproducts->products->country->name:"" }}</td>
    </tr>
    <tr>
      <td colspan="2" style="border:none;padding:10px 10px 0px 10px;">M.R.P.: Rs. {{ ($orderproducts->product_discounted_price) }} (Inclusive of all taxes)</td>
    </tr>
    <tr>
      <td colspan="" style="border:none;padding:0px 0px 0px 10px;width:40%;">SIZE: {{ ($orderproducts->product_size) }}</td>
      <td colspan="" style="border:none;padding:0px 10px 10px 10px;width:60%;">COLOR: {{ ($orderproducts->product_color) }}</td>
    </tr>
    <tr>
      <td colspan="" style="border:none;padding:0px 0px 0px 10px;width:40%;">QTY.: {{ ($orderproducts->qty) }}No.</td>
      <td colspan="" style="border:none;padding:0px 10px 10px 10px;width:60%;">PKD.: {{ date("Y-m-d", strtotime($orders->preparing_order_date)) }}</td>
    </tr>
    <tr>
      @php //dd($orderproducts->products->country->name); @endphp
      <td colspan="2" style="border:none;padding:10px 10px 10px 10px;">
        MANUFACTURED By: {{ isset($orderproducts->products->manufacturer)?$orderproducts->products->manufacturer->manufacturer_name : "" }}<br>
        {{ isset($orderproducts->products->manufacturer)?$orderproducts->products->manufacturer->manufacturer_address:"" }}
      </td>
    </tr>
    <tr>
      <td colspan="2" style="border:none;padding:10px 10px 10px 10px;">
        IMPORTED By: {{ isset($orderproducts->products->importer)?$orderproducts->products->importer->importer_name : "" }}<br>
        {{ isset($orderproducts->products->importer)?$orderproducts->products->importer->importer_address:"" }}
      </td>
    </tr>
    <tr>
      <td colspan="2" style="border:none;padding:10px 10px 0px 10px;">
        PACKED & SOLD By: {{ isset($orderproducts->products->packer)?$orderproducts->products->packer->packer_name : "" }}<br>
        {{ isset($orderproducts->products->packer)?$orderproducts->products->packer->packer_address:"" }}
      </td>
    </tr>
    <tr>
      <td colspan="2" style="border:none;padding:0px 10px 10px 10px;">
        Customer Care No.: +91 7498042995<br>
        <u>customercare@dadreeios.com</u>
      </td>
    </tr>
    
    
    
    
    
    
    
  </table>


</div>

@endif
