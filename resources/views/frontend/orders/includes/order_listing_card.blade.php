<div class="col-md-12">
  <div class="delivery-details-box delivery-details-border">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-12 ">
        <div class="order-info">
          <p>
            <span class="mr-4">Order Number: {{ $order->orders_counter_id }}</span>
            <span class="">Order Confirmation Date: {{ date('jS F, Y h:i:s A',strtotime($order->created_at)) }}     </span>
            <div class="ord-confirm-view-btn1">
            @if(1)
              @php
                $progress = order_status($order);
              @endphp
              <p class="ord-confirmed" type="button" name="button">{{$progress}}</p>
            @endif
          </div>
          </p>

        </div>
        <!-- <div class="delivery-period">
          <p>Estimated Delivery Period for Shipment 1 of 1:- By 21st January, 2021</p>
        </div> -->
      </div>
    </div>
    @if(isset($order->orderproducts))
    @foreach($order->orderproducts as $orderproducts)
    @php
      //dd($orderproducts);
      $join_table = 'products';
      $product_thumb_location = 'product_thumbs';
      $product_image = '';
      if($orderproducts->product_type=="configurable")
      {
        $join_table = 'product_variant';
        $product_thumb_location = 'product_variant_thumbs';
      }
      if(isset($orderproducts->{$join_table}->product_thumb) && $orderproducts->{$join_table}->product_thumb != '' && $orderproducts->{$join_table}->product_thumb != null)
      {
        $product_image = $orderproducts->{$join_table}->product_thumb;
      }
      else
      {
        $product_thumb_location = 'product_thumbs';
        $product_image = isset($orderproducts->products)?$orderproducts->products->product_thumb:'';
      }
    @endphp
      <div class="row mb-3 tracker-details-row">
        <div class="col-md-3 col-sm-3 col-4 ">
            <img src="{{ asset('backend-assets/uploads/'.$product_thumb_location.'/') }}/{{ $product_image }}" class="img-fluid" alt="">
        </div>
        <div class="col-md-6 col-sm-6 col-8 ">
          <div class="delivery-product-info">
            <p><span class="delivery-pro-name">{{ $orderproducts->product_sub_title }}</span></p>
            <p><span class="delivery-pro-type">{{ $orderproducts->product_title }}</span></p>
            <p>
              @if($orderproducts->product_discounted_price!=null && $orderproducts->product_discount!=0)
                <span class="delivery-pro-price">₹ {{ isset($orderproducts->product_discount)?$orderproducts->product_discounted_price:$orderproducts->product_price }}</span>
                <span class="delivery-pro-original">₹ {{ $orderproducts->product_price }}</span>
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
                You are saving  ₹ {{ $orderproducts->product_price-$orderproducts->product_discounted_price }} on this Order
              </span>
            </p>
            @endif
            <p>
              <span class="delivery-pro-color"><b>Colour:</b> {{ $orderproducts->product_color }}</span>
              <span class="delivery-pro-size"><b>Size:</b> {{ $orderproducts->product_size }}</span>
              <span class="delivery-pro-quantity"><b>Quantity:</b> {{ $orderproducts->qty }}</span>
            </p>
          </div>
        </div>
        <div class="col-md-3 col-sm-3 col-12 ">
          @if($loop->iteration == $loop->count)
          <div class="ord-confirm-view-btn">

            @if($card_type=='main')
              <!-- <button class="ord-view viewdetails-content" type="button" name="button" >VIEW DETAILS</button> -->
              <a class="btn viewdetails-content ord-view btn-sm" href="{{ url('/myaccount/vieworders',$order->order_id) }}">VIEW DETAILS</a>
              @if ($order->cancel_order_flag == 0)
                <a class="btn viewdetails-content ord-view btn-sm mt-2" href="{{ url('/myaccount/viewinvoice',$order->order_id) }}">VIEW INVOICE</a>
              @endif
            @elseif($card_type=='track')
              @if ($order->cancel_order_flag == 0 && $order->confirmed_stage == 1 && $order->package_waybill != "")
                <a class="btn viewdetails-content ord-view btn-sm mt-2" target="_blank" href="https://www.delhivery.com/track/package/{{$order->package_waybill }}">TRACK</a>
              @endif
            @elseif($card_type=='cancel')
              @if ($order->cancel_order_flag == 0 && $order->shipped_stage == 0)
                @php
                  $cancel_status = order_cancel_days_status($order);
                @endphp
                @if($cancel_status)
                  <div class="cancel-order">
                    <button type="button" name="button" class="w-100">
                      <a class="" href="{{ url('/myaccount/orders/cancel',$order->order_id) }}">CANCEL</a>
                    </button>
                  </div>
                @endif
              @endif
            @elseif($card_type=='return')
              @if ($order->cancel_order_flag == 0 && $order->delivered_stage == 1 && $order->order_return_flag == 0)
              @php
                $return_status = order_return_days_status($order);
                //dd($return_status);
              @endphp
              @if($return_status)
              <div class="cancel-order">
                <button type="button" name="button" class="w-100">
                <a class="" href="{{ url('/myaccount/orders/return',$order->order_id) }}">RETURN</a>
              </button>
            </div>
              @endif
              @endif
            @endif
          </div>
          @endif
        </div>
      </div>
    @endforeach
    @endif


  </div>
</div>
