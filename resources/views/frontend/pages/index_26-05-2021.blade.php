@extends('frontend.layouts.pages')
@section('title',$page_content->cms_pages_title)
@section('content')

<!-- Product details start -->
  <div class="container-fluidcustom top-padding ">
    <!-- <div class="images-box"> -->
      <div class="row pt-4">
        <div class=" col-md-12 col-sm-12 col-12">

          <h4>{{ $page_content->cms_pages_title }}</h4>
          <hr class="terms-hr">
          <div class="">
            {!! $page_content->cms_pages_content !!}
          </div>

        </div>

     </div>
    <!-- </div> -->
 </div>
<!-- Product details end -->






@endsection
