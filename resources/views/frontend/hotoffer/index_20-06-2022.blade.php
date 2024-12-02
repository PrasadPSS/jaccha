@extends('frontend.layouts.app')
@section('title','Hot Offer')
@section('content')

<!-- TODAY’S SPECIAL DEALS END IN sectionn start -->
<div class="container-fluidcustom top-padding mt-4 hotoffer-page">
  <div class="row shop-categories">
    <div class="col-md-12">
      <h1 class="heading-underline">DADREEIOS HOT OFFERS ZONE</h1>
      <p style="color: black;">Discover our exciting and phenomenal hot offers here.</p>
      <p style="color: black;">Add value to your wardrobe and take you to new fashion heights... Top of the Line!</p>
    </div>
    @if(isset($hotoffers) && count($hotoffers) > 0)
      @foreach($hotoffers as $hotoffer)
        @if($hotoffer->col_type == 1)
          <div class="col-md-12">
            <a href="{{ $hotoffer->first_image_url }}" class="image">
              <img class="img-thumbnail border-0 shadow" src="{{ asset('backend-assets/uploads/hotoffers/') }}/{{ $hotoffer->first_image }}">
            </a>
          </div>
        @endif
        @if($hotoffer->col_type == 2)
          <div class="col-md-6">
            <a href="{{ $hotoffer->first_image_url }}" class="image">
              <img class="img-thumbnail border-0 shadow" src="{{ asset('backend-assets/uploads/hotoffers/') }}/{{ $hotoffer->first_image }}">
            </a>
          </div>
          <div class="col-md-6">
            <a href="{{ $hotoffer->second_image_url }}" class="image">
              <img class="img-thumbnail border-0 shadow" src="{{ asset('backend-assets/uploads/hotoffers/') }}/{{ $hotoffer->second_image }}">
            </a>
          </div>
        @endif
        @if($hotoffer->col_type == 4)
          <div class="col-md-3">
            <a href="{{ $hotoffer->first_image_url }}" class="image">
              <img class="img-thumbnail border-0 shadow" src="{{ asset('backend-assets/uploads/hotoffers/') }}/{{ $hotoffer->first_image }}">
            </a>
          </div>
          <div class="col-md-3">
            <a href="{{ $hotoffer->second_image_url }}" class="image">
              <img class="img-thumbnail border-0 shadow" src="{{ asset('backend-assets/uploads/hotoffers/') }}/{{ $hotoffer->second_image }}">
            </a>
          </div>
          <div class="col-md-3">
            <a href="{{ $hotoffer->third_image_url }}" class="image">
              <img class="img-thumbnail border-0 shadow" src="{{ asset('backend-assets/uploads/hotoffers/') }}/{{ $hotoffer->third_image }}">
            </a>
          </div>
          <div class="col-md-3">
            <a href="{{ $hotoffer->fourth_image_url }}" class="image">
              <img class="img-thumbnail border-0 shadow" src="{{ asset('backend-assets/uploads/hotoffers/') }}/{{ $hotoffer->fourth_image }}">
            </a>
          </div>
        @endif
      @endforeach
    @endif
  </div>
</div>
@endsection
