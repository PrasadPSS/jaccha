<a href="{{ url('dp/') }}/{{ $product_card->category_slug }}/{{ $product_card->sub_category_slug }}/{{ $product_card->sub_sub_category_slug }}/{{ $product_card->product_slug }}">
    <div class="item">
<div class=" card ">
 <div class="container1">
     @if(array_key_exists($product_card->product_id,$list_images))

   <img class="img-fluid img-border-bottom" src="{{ asset('backend-assets/uploads/product_images/'.$list_images[$product_card->product_id]) }}" alt="Img">
     @endif
   <div class="pro-details">
          <p class="pro-name mb-0">@if(isset($product_card->brand_name)) {{$product_card->brand_name}} @else &nbsp; @endif</p>
          <p class="pro-style mb-0 ">{{$product_card->product_title}}</p>
          <p class="pro-price-details mb-0">
              @if($product_card->product_discounted_price!=null && $product_card->product_discount!=0)
                <span class="price mr-2">₹ {{$product_card->product_discounted_price}}</span>
                <span class="mrp-cut mr-2">₹ {{$product_card->product_price}}</span>
              @elseif($product_card->product_discounted_price!=null && $product_card->product_discount==0)
                <span class="price mr-2">₹ {{$product_card->product_discounted_price}}</span>
              @else
                <span class="price mr-2">₹ {{$product_card->product_price}}</span>
              @endif
              @if($product_card->product_discount_type!=null && $product_card->product_discount_type=='percent' && $product_card->product_discount!=0)
                <span class="discount">({{$product_card->product_discount}}% OFF)</span>
              @elseif($product_card->product_discount_type!=null && $product_card->product_discount_type=='flat' && $product_card->product_discount!=0)
                <span class="discount">(₹ {{$product_card->product_discount}} OFF)</span>
              @endif

          </p>
        </div>
 </div>
 <div class="img-text">
   <p><span>HAND</span>-PICKED</p>
 </div>
</div>
</div>
</a>
