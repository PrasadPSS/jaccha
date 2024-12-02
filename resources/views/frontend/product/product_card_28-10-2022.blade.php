
@if(isset($products) && count($products)>0)
@foreach($products as $product)
<div class="col-lg-3 col-md-6 col-sm-6 content pb-4">
 <div class="product-hover img-hover1 card ">
       <a href="{{ url('dp/') }}/{{ $product->category_slug }}/{{ $product->sub_category_slug }}/{{ $product->sub_sub_category_slug }}/{{ $product->product_slug }}">
        <img class="img-fluid image" src="{{ asset('backend-assets/uploads/product_thumbs/') }}/{{ isset($product->product_thumb)?$product->product_thumb:'' }}" alt="Img">
      </a>
       <div class="pro-details img-border-up">
          <p class="pro-name mb-0"> @if(isset($product->brands->brand_name)){{ $product->brands->brand_name }}@else &nbsp; @endif </p>
          <p class="pro-style mb-0 ">{{ $product->product_title }}</p>
          <p class="pro-price-details mb-0">
          @if($product->product_discounted_price!=null && $product->product_discount!=0)
            <span class="price mr-2">₹ {{ $product->product_discounted_price }}</span>
            <span class="mrp-cut mr-2">₹ {{ $product->product_price }}</span>
          @elseif($product->product_discounted_price!=null && $product->product_discount==0)
            <span class="price mr-2">₹ {{$product->product_discounted_price}}</span>
          @else
            <span class="price mr-2">₹ {{$product->product_price}}</span>
          @endif
          @if($product->product_discount_type!=null && $product->product_discount_type=='percent' && $product->product_discount!=0)
            <span class="discount">({{$product->product_discount}}% OFF)</span>
          @elseif($product->product_discount_type!=null && $product->product_discount_type=='flat' && $product->product_discount!=0)
            <span class="discount">(₹ {{$product->product_discount}} OFF)</span>
          @endif
          </p>
        </div>

       <div class="overlay dn">
         <a href="{{ url('dp/') }}/{{ $product->category_slug }}/{{ $product->sub_category_slug }}/{{ $product->sub_sub_category_slug }}/{{ $product->product_slug }}" target="_blank">
         <div class="sliderdemo">
           @if(isset($product->product_images) && count($product->product_images)>0)
            @foreach($product->product_images->take(6) as $product_image)
              <div class="img-border-bottom"><img class="img-fluid " src="{{ asset('backend-assets/uploads/product_images/') }}/{{ $product_image->image_name }}" alt="Img"></div>
            @endforeach
          @endif
         </div>
       </a>
             <!-- Indicators -->
             <div class="btn-whishlist-view">
                <div class="row button-area">
                  <div class="col-6 pl-0 pr-1 wishlistbox">
                    <input type="hidden" name="product_id" class="product_id" value="{{ $product->product_id }}">
                    <a class="whishlist-rborder d-block whishlist-color addtowishlist" href="javascript:{}">WISHLIST</a>
                  </div>
                  <div class="col-6 pr-0 pl-1">
                    <a class="similar-color d-block" href="{{ url('/similar') }}/{{ $product->product_id }}">SIMILAR</a>
                  </div>
                </div>
                <a href="{{ url('dp/') }}/{{ $product->category_slug }}/{{ $product->sub_category_slug }}/{{ $product->sub_sub_category_slug }}/{{ $product->product_slug }}" target="_blank">
                <p class="pro-price-details mb-0">
                  @if($product->product_discounted_price!=null && $product->product_discount!=0)
                    <span class="price mr-2">₹ {{ $product->product_discounted_price }}</span>
                    <span class="mrp-cut mr-2">₹ {{ $product->product_price }}</span>
                  @elseif($product->product_discounted_price!=null && $product->product_discount==0)
                    <span class="price mr-2">₹ {{$product->product_discounted_price}}</span>
                  @else
                    <span class="price mr-2">₹ {{$product->product_price}}</span>
                  @endif
                  @if($product->product_discount_type!=null && $product->product_discount_type=='percent' && $product->product_discount!=0)
                    <span class="discount">({{$product->product_discount}}% OFF)</span>
                  @elseif($product->product_discount_type!=null && $product->product_discount_type=='flat' && $product->product_discount!=0)
                    <span class="discount">(₹ {{$product->product_discount}} OFF)</span>
                  @endif
                 </p>
                <section class="size-product">
                  <p>
                    <span class="font-bold product-sizes">Sizes: </span>
                    @if($product->product_type == 'simple')
                      <span class="product-sizes">{{ isset($product->size->size_name)?$product->size->size_name:'' }}</span>
                    @elseif($product->product_type == 'configurable')
                    @php
                      $product_size_ids = array_unique(array_column($product->product_variants->toArray(), 'size_id'));
                      //dd(array_unique($product_size_ids));
                    @endphp
                    <span class="product-sizes">
                      @foreach($product_size_ids as $product_size_id)
                          @if(isset($size_list[$product_size_id]))
                            @if(!$loop->last)
                            {{ $size_list[$product_size_id].", "}}
                            @else
                            {{ $size_list[$product_size_id]}}
                            @endif
                          @endif
                         
                      @endforeach
                    </span>
                    @endif
                  </p>
                   <!-- <p><span class="font-bold">Sizes: </span><span>S, M, L, XL, 2XL, 3XL, 4XL, 5XL</span></p> -->
                </section>
                </a>
             </div>
       </div>
 </div>

 <div class="img-text">
   <p><span>HAND</span>-PICKED</p>
 </div>
</div>
@endforeach
@else
<div class="col-lg-12 col-md-12 col-sm-12">
<p class="product-hover product-hover-border img-hover1 card ">
Sorry, We could not find any matches!
</p>
</div>
@endif
