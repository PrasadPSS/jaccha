@extends('frontend.layouts.home')
@section('title','FAQs')
@section('content')

<!-- Product details start -->
  <div class="container-fluidcustom top-padding ">
    <!-- <div class="images-box"> -->
      <div class="row pt-4">
        <div class=" col-md-12 col-sm-12 col-12">

          <h1>FAQs</h1>

          <div class="row">
            <div class="col-md-4">
              Menu
              @if(isset($faqs) && count($faqs)>0)
                <ul>
                  @foreach($faqs as $faq)
                    <li>{{ $faq->faq_name }}</li>
                  @endforeach
                </ul>
              @endif
            </div>
            <div class="col-md-8">
              Questions
              @if(isset($faqs) && count($faqs)>0)
              @foreach($faqs as $faq)
              <h2>{{ $faq->faq_name }}</h2>
              @if(isset($faq->questions) && count($faq->questions)>0)
                @foreach($faq->questions as $faquestion)
                <p>{{ $faquestion->fa_question }}</p>
                <p>{!! $faquestion->fa_question_ans !!}</p>
                @endforeach
              @endif
              @endforeach
            @endif
            </div>
          </div>

        </div>

     </div>
    <!-- </div> -->
 </div>
<!-- Product details end -->






@endsection
