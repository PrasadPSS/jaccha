@extends('frontend.layouts.app')
@section('title','Wishlist')
@section('content')

<!-- Similar product section sart -->
<div class="container-fluidcustom top-padding ">
  <div class="row similar-product">
    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
      <!-- <h1>Your Wishlist</h1> -->
    </div>
  </div>
  <div class=" similar-product-images">
    <div class="wishlist-empty">
      <div class="container">
          <div class="row">
            <div class="col-sm-12">
              <h1 class="heading-underline wishlist-heading">Your wishlist is empty!</h1>
              <p>Add the products which you like in your wishlist.</br>You may easily review and buy them at anytime.</p>
              <div class="empty-img">
              <img src="{{ asset('frontend-assets/images/wishlist-is-empty-image.jpg') }}">
              </div>
              <div class="c-shopping-btn">
              <a href="{{url('/')}}" name="button " class="">Continue Shopping</a>
            </div>
            </div>
          </div>
      </div>
    </div>
  </div>
  </div>

<!-- Similar product section end -->



@endsection

<!-- <script>
    function removeWishlist($id) {

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
</script> -->
