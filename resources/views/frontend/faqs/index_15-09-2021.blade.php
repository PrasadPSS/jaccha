@extends('frontend.layouts.home')
@section('title','FAQs')
@section('content')

<!-- Terms & Conditions sart -->
<div class="container top-padding">
  <div class="row faqs-heading pt-3">
    <div class="col-sm-12 ">
      <h1 class="inner-title">Frequently Asked Questions</h1>
      <hr class="terms-hr">
    </div>
  </div>
</div>

<div class="container ">
    <div class="row faqs-section">
        <div class="col-lg-3">
          <div class="faqs-section-head faqs-topics" >
            <p style="">IMPORTANT TOPICS</p>
          </div>
            <div class="nav nav-pills faq-nav" id="faq-tabs" role="tablist" aria-orientation="vertical">
              @if(isset($faqs) && count($faqs)>0)
                @php $faqs_cnt = 1; @endphp
                @foreach($faqs as $faq)
                  <a href="#jump-tab-{{ $faq->faq_id }}" class="nav-link {{ ($faqs_cnt==1)?'active':''}}" data-toggle="pill" role="tab" aria-controls="tab1" aria-selected="true">
                    <i class="mdi mdi-help-circle"></i>{{ $faq->faq_name }}
                  </a>
                  @php $faqs_cnt++; @endphp
                @endforeach
              @endif
            </div>
        </div>
        <div class="col-lg-9">
          <!-- <div class="faqs-section-head faqs-selected-topics" >
            <p>Login & Registration Related Queries...</p>
          </div> -->
            <div class="tab-content " id="faq-tab-content">
              @if(isset($faqs) && count($faqs)>0)
              @php $faquestion_cnt = 1; @endphp
              @foreach($faqs as $faq)
              @if(isset($faq->questions) && count($faq->questions)>0)
                <div class="tab-pane show {{ ($faquestion_cnt==1)?'active':''}}" id="jump-tab-{{ $faq->faq_id }}" role="tabpanel" aria-labelledby="tab1">
                  <div class="faqs-section-head faqs-selected-topics" >
                    <p>{{ $faq->faq_name }} Related Queries...</p>
                  </div>
                  <div class="faqs-tab-section">
                  @foreach($faq->questions as $faquestion)
                  <div class="faqs-qusns">
                    <div class="accordion-item">
                      <div class="accordion-item-header">
                        {{ $faquestion->fa_question }}
                      </div>
                      <div class="accordion-item-body">
                        <div class="accordion-item-body-content">
                          {!! $faquestion->fa_question_ans !!}
                        </div>
                      </div>
                    </div>
                  </div>
                  @endforeach
                </div>
                </div>
              @else
                <div class="tab-pane show {{ ($faquestion_cnt==1)?'active':''}}" id="jump-tab-{{ $faq->faq_id }}" role="tabpanel" aria-labelledby="tab1">
                  <div class="faqs-section-head faqs-selected-topics" >
                    <p>{{ $faq->faq_name }} Related Queries...</p>
                  </div>
                  <div class="faqs-tab-section">
                  <div class="faqs-qusns">
                    <div class="accordion-item">
                      <div class="accordion-item-header">
                        No Record Found..
                      </div>
                      <div class="accordion-item-body">
                        <div class="accordion-item-body-content">
                          No Record Found..
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                </div>
              @endif
              @php $faquestion_cnt++; @endphp
              @endforeach
            @endif

            </div>
        </div>
    </div>
</div>

<!-- Terms & Conditions section end -->
<script>
const accordionItemHeaders = document.querySelectorAll(".accordion-item-header");

accordionItemHeaders.forEach(accordionItemHeader => {
accordionItemHeader.addEventListener("click", event => {

  // Uncomment in case you only want to allow for the display of only one collapsed item at a time!

  // const currentlyActiveAccordionItemHeader = document.querySelector(".accordion-item-header.active");
  // if(currentlyActiveAccordionItemHeader && currentlyActiveAccordionItemHeader!==accordionItemHeader) {
  //   currentlyActiveAccordionItemHeader.classList.toggle("active");
  //   currentlyActiveAccordionItemHeader.nextElementSibling.style.maxHeight = 0;
  // }

  accordionItemHeader.classList.toggle("active");
  const accordionItemBody = accordionItemHeader.nextElementSibling;
  if(accordionItemHeader.classList.contains("active")) {
    accordionItemBody.style.maxHeight = accordionItemBody.scrollHeight + "px";
  }
  else {
    accordionItemBody.style.maxHeight = 0;
  }

});
});
</script>






@endsection
