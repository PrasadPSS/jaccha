@extends('frontend.layouts.app')
@section('title','Download App')
@section('content')

<!-- TODAY’S SPECIAL DEALS END IN sectionn start -->
<div class="container-fluidcustom top-padding mt-4 hotoffer-page">


   <div class="row download-app">
    <div class="col-md-12 downloadApp_img">
      @if(isset($downloadapp_image->image_url))
        <a href="{{ $downloadapp_image->url }}" target="_blank">
          <img class="downloadApp_img1 img-responsive" src="{{ asset('backend-assets/uploads/downloadapp_image') }}/{{ $downloadapp_image->image_url }}">
        </a>
      @else
        <a href="#">
          <img class="downloadApp_img1 img-responsive" src="{{ asset('frontend-assets/images/dadreeios-img.jpg') }}">
        </a>
      @endif
    </div>


      <!-- <div class="col-sm-5 col-xs-12 downloadApp_content">
        <div class="row headerStyle">
          <h1>the all new app</h1>
          <h4>Shop on the go!</h4>
          <p>Dadreeios Shopping App</p>
        </div>

        <div class="row">
          <div class="col-md-5 col-sm-5 col-xs-6 downloadApp_btn"><img class="img-responsive cursorPointer" src="https://images.bewakoof.com/web/apps/ios.png" title="Campaign Apps - Download iOS App @ Bewakoof.com" alt="Download App @ Bewakoof.com">
          </div>

          <div class="col-md-5 col-sm-5 col-xs-6 downloadApp_btn"><img class="img-responsive cursorPointer" src="https://images.bewakoof.com/web/apps/android.png" title="Campaign Apps - Download Android App @ Bewakoof.com" alt="Download Android App @ Bewakoof.com">
          </div>
        </div>
 -->
      </div>
   </div>

</div>
@endsection
