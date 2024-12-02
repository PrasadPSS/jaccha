@if(isset($package_slip_responses[$orderproducts->orders_product_details_id]))
<div class="col-md-12 mt-4 printinvoice_{{ $orderproducts->product_id }} thermel-print">
  <table class="" style="width:100%;border:none !important;border-collapse:collapse;">
    <tr>
      <td colspan="3" style="border:1px solid #000;padding:10px 0px;"><img style="padding:15px 0px;" src="{{ html_entity_decode($package_slip_responses[$orderproducts->orders_product_details_id]['packages'][0]['delhivery_logo']) }}" alt=""></td>
      <td colspan="3"  style="border:1px solid #000"><img style="padding:15px 0px;" src="{{ html_entity_decode($package_slip_responses[$orderproducts->orders_product_details_id]['packages'][0]['delhivery_logo']) }}" alt=""></td>
    </tr>
    <tr>
      <td style="text-align:center;padding:5px 3px 0px;border:1px solid #000;border-bottom:hidden" colspan="6"  >
        <img style="padding:5px 3px 0px;" src="{{ html_entity_decode($package_slip_responses[$orderproducts->orders_product_details_id]['packages'][0]['barcode']) }}" alt="">
      </td>
    </tr>
    <tr>
      <td colspan="3" style="width:50%;padding:4px 3px;border:1px solid #000;border-top:hidden;border-right:hidden">{{ html_entity_decode($package_slip_responses[$orderproducts->orders_product_details_id]['packages'][0]['rpin']) }}</td>
      <td colspan="3" style="width:50%;padding:4px 3px;border:1px solid #000;text-align:right;border-top:hidden;border-left:hidden">{{ html_entity_decode($package_slip_responses[$orderproducts->orders_product_details_id]['packages'][0]['sort_code']) }}</td>
    </tr>
    <tr>
      <td colspan="4" style="width:70%;border:1px solid #000;">
        <p style="padding:10px 3px;margin-bottom: 0px;">
        Shipping Address:<br>
        <span style="font-size:17px;font-weight:600;text-transform:uppercase">{{ html_entity_decode($package_slip_responses[$orderproducts->orders_product_details_id]['packages'][0]['name']) }}</span><br>
        {{ html_entity_decode($package_slip_responses[$orderproducts->orders_product_details_id]['packages'][0]['address']) }}<br>
        <span style="font-weight:600;text-transform:uppercase">PIN:{{ html_entity_decode($package_slip_responses[$orderproducts->orders_product_details_id]['packages'][0]['pin']) }}</span>
      </p>
      </td>
      <td colspan="2" style="border:1px solid #000;text-align:center">
        <span style="font-size:17px;font-weight:600;">COD<br></span>
        <span style="font-size:17px;font-weight:600;">{{ html_entity_decode($package_slip_responses[$orderproducts->orders_product_details_id]['packages'][0]['cod']) }}</span>
      </td>
    </tr>
    <tr>
      <td colspan="3" style="padding:4px 3px;border:1px solid #000;">
        Seller <br>Address:
      </td>
      <td colspan="3" style="padding:4px 3px;border:1px solid #000;"></td>
    </tr>
    <tr>
      <td colspan="3" style="padding:4px 3px;border:1px solid #000;">Product</td>
      <td colspan="2" style="padding:4px 3px;border:1px solid #000;text-align:center">Price</td>
      <td colspan="2" style="padding:4px 3px;border:1px solid #000;text-align:center">Total</td>
    </tr>
    <tr>
      <td colspan="3" style="padding:4px 3px;border:1px solid #000;">{{ html_entity_decode($package_slip_responses[$orderproducts->orders_product_details_id]['packages'][0]['prd']) }}</td>
      <td colspan="2" style="padding:30px 3px;border:1px solid #000;text-align:center">{{ html_entity_decode($package_slip_responses[$orderproducts->orders_product_details_id]['packages'][0]['rs']) }}</td>
      <td colspan="2" style="padding:4px 3px;border:1px solid #000;text-align:center">{{ html_entity_decode($package_slip_responses[$orderproducts->orders_product_details_id]['packages'][0]['rs']) }}</td>
    </tr>
    <tr>
      <td colspan="3" style="padding:4px 3px;border:1px solid #000;">Total</td>
      <td colspan="2" style="padding:4px 3px;border:1px solid #000;text-align:center">{{ html_entity_decode($package_slip_responses[$orderproducts->orders_product_details_id]['packages'][0]['rs']) }}</td>
      <td colspan="2" style="padding:4px 3px;border:1px solid #000;text-align:center">{{ html_entity_decode($package_slip_responses[$orderproducts->orders_product_details_id]['packages'][0]['rs']) }}</td>

    </tr>
    <tr>
      <td colspan="6" style="padding:6px 3px;border:1px solid #000;text-align:center">
        <img src="{{ html_entity_decode($package_slip_responses[$orderproducts->orders_product_details_id]['packages'][0]['oid_barcode']) }}" alt="">
      </td>
    </tr>
    <tr>
      <td colspan="6" style="padding:4px 3px;border:1px solid #000;">
        Return Address:
      </td>
    </tr>
  </table>


</div>

@endif
