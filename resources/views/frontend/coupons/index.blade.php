@extends('frontend.layouts.app')
@section('title','Dadreeios Coupons')
@section('content')

<!-- Similar product section sart -->
<div class="container-fluidcustom top-padding ">
  <div class="row similar-product">
    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
      <h1>Dadreeios Coupons List</h1>
    </div>
  </div>
  <div class=" similar-product-images">
  <div class="row mb-5">

    @if(isset($coupons))
      @foreach($coupons as $coupon)
      <div class="col-sm-6">
      <div class="tag-content-color product-shortinfo mb-2">
         <table>
            <tr>
               <td class="tag-icon pr-3"><i class="fa fa-tag" aria-hidden="true"></i></td>
               <td>
                  <p class="p-0">{{ $coupon->coupon_title}}</p>
               </td>
            </tr>
         </table>
      </div>
    </div>
      @endforeach
    @endif



  </div>
  </div>
  </div>

<!-- Similar product section end -->




@endsection
