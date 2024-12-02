@extends('frontend.layouts.app')
@section('title','Wishlist')
@section('content')

<!-- Similar product section sart -->
<div class="container-fluidcustom top-padding ">
  <div class="row similar-product">
    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
      <h1>Your Wishlist</h1>
    </div>
  </div>
  <div class=" similar-product-images">
  <div class="row ">

    @if(isset($wishlists))
    @foreach($wishlists as $wishlist)
    <div class="column ">
      <div class="content">
        <div class="item">
          <div class=" card ">

                  <div class="container1">
                 @if(array_key_exists($wishlist->product_id,$wishlistImage))
                 <a href="{{ url('dp/') }}/{{ $wishlist->category_slug }}/{{ $wishlist->sub_category_slug }}/{{ $wishlist->sub_sub_category_slug }}/{{ $wishlist->product_slug }}">
                     <img class="img-fluid img-border-bottom" src="{{ asset('backend-assets/uploads/product_images/'.$wishlistImage[$wishlist->product_id]) }}" alt="Img">
                 </a>
                 @endif
                 <div class="pro-details " style="padding:1.4rem .85rem 1rem .85rem">
                     <a href="{{ url('dp/') }}/{{ $wishlist->category_slug }}/{{ $wishlist->sub_category_slug }}/{{ $wishlist->sub_sub_category_slug }}/{{ $wishlist->product_slug }}">
                     <p class="pro-name mb-0"> @if(isset($wishlist->brand_name)){{ $wishlist->brand_name }} @else &nbsp; @endif</p>
                     <p class="pro-style mb-0 ">{{$wishlist->product_title}}</p>
                     <p class="pro-price-details mb-0">
                         @if($wishlist->product_discounted_price!=null)
                             <span class="price mr-2">₹ {{$wishlist->product_discounted_price}}</span>
                             <span class="mrp-cut mr-2">₹ {{$wishlist->product_price}}</span>
                         @else
                             <span class="price mr-2">₹ {{$wishlist->product_price}}</span>
                         @endif
                         @if($wishlist->product_discount_type!=null && $wishlist->product_discount_type=='percent')
                             <span class="discount">({{$wishlist->product_discount}}% OFF)</span>
                         @elseif($wishlist->product_discount_type!=null && $wishlist->product_discount_type=='flat')
                             <span class="discount">(₹ {{$wishlist->product_discount}} OFF)</span>
                         @endif

                     </p>
                     </a>
                     <div class="mt-3 mb-1">
                       <form class="" action="{{ url('/cart/addtocart')}}" method="post">
                         {{ csrf_field() }}
                         <input type="hidden" name="product_id" id="product_id" value="{{$wishlist->product_id}}">
                         <input type="hidden" name="quantity" id="quantity" value="1">
                         <input type="hidden" name="color_id" id="color_id" value="{{$wishlist->color_id}}">
                         <input type="hidden" name="size_id" id="size_id" value="{{$wishlist->size_id}}">
                         <input type="hidden" name="page_name" id="page_name" value="wishlist">
                         <input type="hidden" name="wishlistid" id="wishlistid" value="{{$wishlist->wishlist_id}}">
                         <!--<button type="submit" name="addto" class="move-cart-btn" value="addtocart">MOVE TO CART</button>-->
                       </form>
                     </div>
                 </div>

            </div>
            <div class="remove-wishlist">
              <button type="submit" name="button" onclick="removeWishlist({{$wishlist->wishlist_id}})"><i class="fa fa-times" aria-hidden="true"></i></button>
            </div>
            <div class="img-text">
              <p><span>HAND</span>-PICKED</p>
            </div>
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

{{--<!-- Continue Shopping button section start -->--}}
{{--<div class="container-fluidcustom">--}}
{{--  <div class="row pt-5 pb-5">--}}
{{--    <div class="col-lg-12 col-md-12 col-sm-12 col-12 text-center">--}}
{{--      <div class="wish-continuebtn">--}}
{{--        <a href="index.html" name="button">Continue Shopping</a>--}}
{{--      </div>--}}
{{--    </div>--}}
{{--  </div>--}}
{{--</div>--}}
{{--<!-- Continue Shopping button section start -->--}}


@endsection

<script>
    function removeWishlist($id)
    {
        alert('are you sure want to delete??');

        $.ajax({
            url:'{{url('/wishlists/removewishlist')}}',
            type:'get',
            data:{
                "wishlistid":$id
            },
            success: function (data) {
                console.log(data);
                alert(data[1]);
                window.location = '{{route('wishlists')}}';

            },
            error:function (data) {

            }
        })
    }
</script>
