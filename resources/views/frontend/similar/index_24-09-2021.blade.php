@extends('frontend.layouts.app')
@section('title','Similar')
@section('content')

<!-- Similar product section sart -->
<div class="container-fluidcustom top-padding ">
  <div class="row similar-product">
    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
      <h1>Similar Products</h1>
    </div>
  </div>
  <div class=" similar-product-images">
    <div class="row ">

      @if(isset($relatedProducts) && count($relatedProducts)>0)
      @foreach($relatedProducts as $relatedProduct)
      <div class="column ">
        <div class="content">
          <div class="item">
            <div class=" card ">
              <a href="{{ url('dp/') }}/{{ $relatedProduct->category_slug }}/{{ $relatedProduct->sub_category_slug }}/{{ $relatedProduct->sub_sub_category_slug }}/{{ $relatedProduct->product_slug }}">
                <div class="container1">
                  <img class="img-fluid" src="{{ asset('backend-assets/uploads/product_images/'.$imageList[$relatedProduct->product_id]) }}" alt="Img">
                  <div class="pro-details pt-4 ">
                     <p class="pro-name mb-0"> @if(isset($relatedProduct->brands->brand_name)){{ $relatedProduct->brands->brand_name }} @endif</p>
                     <p class="pro-style mb-0">{{$relatedProduct->product_title}}</p>
                     <p class=" pro-details-price mb-0">
                       @if($relatedProduct->product_discounted_price!=null)
                         <span class="price mr-2" style="color:#C00000">₹ {{$relatedProduct->product_discounted_price}}</span>
                         <span class="mrp-cut mr-2" style="color:#5C5858;text-decoration: line-through">₹ {{$relatedProduct->product_price}}</span>
                       @else
                         <span class="price mr-2" style="color:#C00000">₹ {{$relatedProduct->product_price}}</span>
                       @endif
                       @if($relatedProduct->product_discount_type!=null && $relatedProduct->product_discount_type=='percent')
                         <span class="discount">({{$relatedProduct->product_discount}}% OFF)</span>
                       @elseif($relatedProduct->product_discount_type!=null && $relatedProduct->product_discount_type=='flat')
                         <span class="discount">(₹ {{$relatedProduct->product_discount}} OFF)</span>
                       @endif
                    </p>
                  </div>

              </div>
              <div class="img-text">
                <p><span>HAND</span>-PICKED</p>
              </div>
              </a>
            </div>
          </div>
        </div>
      </div>
      @endforeach
      @endif



    </div>
  </div>
  </div>

<!-- Similar product section end -->

<!-- Continue Shopping button section start -->
<div class="container-fluidcustom">
  <div class="row pt-5 pb-5">
    <div class="col-lg-12 col-md-12 col-sm-12 col-12 text-center">
      <div class="wish-continuebtn">
        <a href="{{url('/')}}" name="button">Continue Shopping</a>
      </div>
    </div>
  </div>
</div>
<!-- Continue Shopping button section start -->


@endsection
