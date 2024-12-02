@extends('frontend.layouts.product_details')
@section('title','All Reviews')
@section('content')

<!-- Product details start -->

  <div class="container-fluidcustom top-padding ">
    <div class="row similar-product">
      <div class="col-lg-12 col-md-12 col-sm-12 col-12">
        <h1>All Reviews</h1>
      </div>
    </div>
         <!-- <div class="images-box"> -->
         {{-- <div class="row pt-4" style="margin: "> --}}

                <div class="col-md-5 mt-4">
                   <div class="star-border">
                     <div class="star-content">
                         @if(floor($avgrates)==1 && floor($avgrates)<2)
                             <div class="star-rating star-rating1 ">
                                 <span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span>
                                 <div class="star-rating__current">
                                     <span>★</span>
                                 </div>
                             </div>
                         @elseif(floor($avgrates)==2 && floor($avgrates)<3)
                             <div class="star-rating star-rating1 ">
                                 <span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span>
                                 <div class="star-rating__current">
                                     <span>★</span><span>★</span>
                                 </div>
                             </div>
                         @elseif(floor($avgrates)==3 && floor($avgrates)<4)
                             <div class="star-rating star-rating1 ">
                                 <span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span>
                                 <div class="star-rating__current">
                                     <span>★</span><span>★</span><span>★</span>
                                 </div>
                             </div>
                         @elseif(floor($avgrates)==4 && floor($avgrates)<5)
                             <div class="star-rating star-rating1 ">
                                 <span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span>
                                 <div class="star-rating__current">
                                     <span>★</span><span>★</span><span>★</span><span>★</span>
                                 </div>
                             </div>
                             @else
                             <div class="star-rating star-rating1 ">
                                 <span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span>
                                 <div class="star-rating__current">
                                     <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                                 </div>
                             </div>

                         @endif

                        <div class="star-rating1">
                           <h1>{{floor($avgrates)}} out of 5</h1>
                        </div>
                     </div>
                     <p><span>{{floor($avgrates)}} </span>Based <span>on {{$countReviews}} Customer Reviews</span></p>
                   </div>
                </div>
                <div class="col-md-7">
                </div>
             </div>
            <div class="row pt-4 ml-5 mb-3">
                <div class="col-md-6 ">
                   <!-- <div class=""> -->
                   <div class="review">
                      <span class="icon-container">5 STAR</span>

                        @if(empty($percentage[5]))
                            <div class="progress">
                                <div class="progress-done" data-done="68"></div>
                            </div>
                            <span class="percent">0%</span>
                        @else
                            <div class="progress">
                                <div class="progress-done" data-done="68" style="width:{{floor($percentage[5])}}%;"></div>
                            </div>
                      <span class="percent">{{floor($percentage[5])}}%</span>
                            @endif
                   </div>
                   <div class="review">
                      <span class="icon-container">4 STAR</span>
                       @if(empty($percentage[4]))
                           <div class="progress">
                               <div class="progress-done" data-done="68"></div>
                           </div>
                           <span class="percent">0%</span>
                       @else
                           <div class="progress">
                               <div class="progress-done" data-done="68" style="width:{{floor($percentage[4])}}%;"></div>
                           </div>
                      <span class="percent">{{floor($percentage[4])}}%</span>
                           @endif
                   </div>
                   <div class="review">
                      <span class="icon-container">3 STAR</span>
                       @if(empty($percentage[3]))
                           <div class="progress">
                               <div class="progress-done" data-done="68"></div>
                           </div>
                           <span class="percent">0%</span>
                       @else
                           <div class="progress">
                               <div class="progress-done" data-done="68" style="width:{{floor($percentage[3])}}%;"></div>
                           </div>
                      <span class="percent">{{floor($percentage[3])}}%</span>
                           @endif
                   </div>

                   <div class="review">
                      <span class="icon-container">2 STAR</span>
                       @if(empty($percentage[2]))
                           <div class="progress">
                               <div class="progress-done" data-done="68"></div>
                           </div>
                           <span class="percent">0%</span>
                       @else
                           <div class="progress">
                               <div class="progress-done" data-done="68" style="width:{{floor($percentage[2])}}%;"></div>
                           </div>
                      <span class="percent">{{floor($percentage[2])}}%</span>
                           @endif
                   </div>
                   <div class="review">
                      <span class="icon-container">1 STAR</span>
                       @if(empty($percentage[1]))
                           <div class="progress">
                               <div class="progress-done" data-done="68" ></div>
                           </div>
                           <span class="percent">0%</span>
                       @else
                           <div class="progress">
                               <div class="progress-done" data-done="68" style="width:{{floor($percentage[1])}}%;"></div>
                           </div>
                           <span class="percent">{{floor($percentage[1])}}%</span>
                       @endif

                   </div>
                   <!-- </div> -->
                </div>
                <div class="col-md-6">
                </div>
             </div>
            <div class="mb-5 pl-4 col-6" style="margin-left: 37px;">

                    <div class="all-ratings mb-4">
                       <h4> All Ratings & Reviews ( {{$countReviews}} )</h4>
                    </div>

                @if(isset($allreviews) && count($allreviews)>0)
                             @foreach($allreviews as $allreview)

                                 <div class="tab-content-color ">
                                     <div class="review-star">
                                         @for($i=0;$i<$allreview->rating;$i++)
                                             <i class="fa fa-star" aria-hidden="true"></i>
                                         @endfor

                                         <span class="reviewer-comment">{{$allreview->headline}}</span>
                                     </div>
                                     <p class="reviewer-comment">{{$allreview->comment}}</p>
                                     <p><span class="">Reviewed by:</span>
                                         <span class="reviewer-name">{{$allreview->username}}</span>
                                         <span class="reviewer-date">{{date('d F,Y',strtotime($allreview->created_at))}}</span>
                                     </p>
                                 </div>

                             @endforeach
                         @endif

            </div>
            </div>






@endsection
