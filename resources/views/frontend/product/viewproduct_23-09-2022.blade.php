@extends('frontend.layouts.product_details')
@section('title', $product_details_title)
@section('metatags')
<meta name="title" content="{{$product->meta_title}}">
<meta name="description" content="{{$product->meta_desc}}">
<meta name="keywords" content="{{$product->meta_keywords}}">
<meta property="og:url" content="">
<meta property="og:image" content="">
<meta property="og:description" content="{{$product->og_desc}}">
<meta property="og:url" content="">
<meta property="og:title" content="{{$product->og_title}}">
@endsection
@section('content')

<!-- Product details start -->

<div id="loader-wrapper">
  <div id="loader"></div>
  
  <div class="loader-section section-left"></div>
  <div class="loader-section section-right"></div>
  
</div>
  <div class="container-fluidcustom pd-top top-padding sortyby-section">
    <div class="col-lg-12 col-sm-12 col-md-12 col-12 padd-left">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item overview-list-subhead"><a href="{{url('/')}}" >Home</a></li>
                  @if(isset($breadcrumb) && strlen($breadcrumb)>0)
                    {!! $breadcrumb !!}
                  @endif
                </ol>
              </nav>
            </div>
         <!-- <div class="images-box"> -->
         <div class="row pt-4 padd-top">
            <div class=" col-lg-6">
               <div class="row">
                  <div class="col-lg-7 ">
                     <!--Carousel Wrapper-->
                     <div id="carousel-thumb" class="carousel  carousel-fade carousel-thumbnails">
                        <!--Slides-->
                        <div class="carousel-inner" role="listbox" id="carousel_thumbs_div">
                          @php $slidcount = 0; @endphp
                          @if(isset($product->product_images) && count($product->product_images)>0)
                           @foreach($product->product_images->take(6) as $product_image)
                             <div class="carousel-item {{ ($slidcount==0)?'active':'' }}">
                                <div class="wrapper">
                                   <div class="block">
                                      <img src="{{ asset('backend-assets/uploads/product_images_original/') }}/{{ $product_image->image_name }}" alt="Image To Zoom" class="block__pic" >
                                   </div>
                                </div>
                             </div>
                             @php $slidcount++; @endphp
                           @endforeach
                         @endif
                        </div>
                        <!--/.Slides-->
                     </div>
                  </div>
                  <!--Controls-->
                  <div class="col-lg-5  pl-0">
                     <div id="carousel-thumb" class="carousel  carousel-fade carousel-thumbnails">
                        <div class="produt-list" id="carousel_div">
                          @php $thumbcount = 0; @endphp
                          @if(isset($product->product_images) && count($product->product_images)>0)
                           @foreach($product->product_images->take(6) as $product_image)
                              @if($thumbcount == 0)
                                <ul class="carousel-indicators1">
                              @endif
                              @if($thumbcount == 3)
                              </ul>
                              <ul class="carousel-indicators2">
                              @endif
                              <li data-target="#carousel-thumb " class="{{ ($thumbcount==0 || $thumbcount==3)?'image-mb':'' }} {{ ($thumbcount==2 || $thumbcount==5)?'image-mt':'' }} img-li {{ ($thumbcount==0)?'active':'' }}" data-slide-to="{{ $thumbcount }}">
                                <img class="img-fluid {{ ($thumbcount==0)?'active1':'' }} img-hover-shadow" src="{{ asset('backend-assets/uploads/product_images_original/') }}/{{ $product_image->image_name }}" >
                              </li>
                              @php $thumbcount++; @endphp
                           @endforeach
                           </ul>
                          @endif
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class=" col-lg-6 ">

              <div class="row product-details-info">
                 <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    @if(isset($product->brands->brand_name))
                    <h1 id="product_sub_title">{{ $product->brands->brand_name }}</h1>
                    @else &nbsp;
                    @endif
                    <h5 id="product_title">{{ $product->product_title }}</h5>
                    <p class="pro-price-details pro-price-details mb-1">
                      @if($product->product_discounted_price!=null && $product->product_discount!=0)
                        <span id="product_discounted_price" class="price mr-2">₹ {{ $product->product_discounted_price }}</span>
                        M.R.P. <span id="product_price" class="mrp-cut mr-2">₹ {{ $product->product_price }}</span>
                      @elseif($product->product_discounted_price!=null && $product->product_discount==0)
                        <span id="product_discounted_price" class="price mr-2">₹ {{$product->product_discounted_price}}</span>
                      @else
                        <span id="product_discounted_price" class="price mr-2">₹ {{$product->product_price}}</span>
                      @endif
                      @if($product->product_discount_type!=null && $product->product_discount_type=='percent' && $product->product_discount!=0)
                        <span class="discount" id="discount_flat_per">({{$product->product_discount}}% OFF)</span>
                        <span class="save-amount" id="save_amount">|   You Save ₹ {{ $product->product_price-$product->product_discounted_price }}</span>
                      @elseif($product->product_discount_type!=null && $product->product_discount_type=='flat' && $product->product_discount!=0)
                        <span class="discount" id="discount_flat_per">(₹ {{$product->product_discount}} OFF)</span>
                        <span class="save-amount" id="save_amount">|   You Save ₹ {{ $product->product_price-$product->product_discounted_price }}</span>
                      @else
                        <span class="discount" id="discount_flat_per"></span>
                        <span class="save-amount" id="save_amount"></span>
                      @endif
                    </p>

                    <p class="product-details-tax">M.R.P. Inclusive of all taxes</p>
                 </div>
              </div>


               <div class="row product-details-info pt-04">
                 <div class="col-lg-12 col-md-12 col-sm-12 col-12">

                   <form class="color-size-selected" action="{{ url('/cart/addtocart')}}" method="post">
                     {{ csrf_field() }}
                     <input type="hidden" name="product_id" id="product_id" value="{{$product->product_id}}">
                     <input type="hidden" name="product_variant_id" id="product_variant_id" value="">
                     <input type="hidden" name="product_type" id="product_type" value="{{$product->product_type}}">
                     <!-- color -->
                     <div class="produt-details-headings colors-option-padd">
                        <p class="p-0">COLOR OPTIONS: <span id="color_name">NONE</span></p>
                        <p id="wrapper1"></p>
                     </div>
                     <div class="row swatches">
                       <div class="swatch clearfix" data-option-index="1">

                         <!-- color condition -->
                         @if($product->product_type == 'simple')
                           <div data-value="{{ $product->color_id }}" class="swatch-element color blue available">

                            <input quickbeam="color" id="color-{{ $product->color_id }}" type="radio" name="color_id" value="{{ $product->color_id }}" class="color_checked" checked required  />
                             <label for="color-{{ $product->color_id }}" style="border-color: #000;">
                               <span style="background-color: {{ isset($color_list[$product->color_id])?$color_list[$product->color_id]:'' }};"></span>
                             </label>
                           </div>
                         @elseif($product->product_type == 'configurable')
                          @if(isset($product->product_variants) && count($product->product_variants)>0)
                          @php
                            $product_color_ids = array_unique(array_column($product->product_variants->toArray(), 'color_id'));
                            //dd(array_unique($product_size_ids));
                          @endphp
                            @foreach($product_color_ids as $color)
                            @php
                            @endphp
                             <div data-value="{{ $color }}" class="swatch-element color blue available">
                               <input quickbeam="color" id="color-{{ $color }}" type="radio" name="color_id" value="{{ $color }}"  class="color_checked" {{($loop->first)?'checked':''}} />
                               <label for="color-{{ $color }}" style="border-color: #000;">
                                 <span style="background-color: {{ isset($color_list[$color])?$color_list[$color]:'' }};"></span>
                               </label>
                             </div>
                           @endforeach
                          @endif
                         @endif

                         <!-- color condition end -->

                       </div>
                       @if($errors->has('color_id'))
                       <!-- <div class="col-md-12"> -->
                       <div class="error">{{ $errors->first('color_id') }}</div>
                       <!-- </div> -->
                       @endif

                     </div>


                <div class="row product-details-info ">
                  <div class="  col-sm-5 col-7">
                     <div class="produt-details-headings colors-option-padd">
                        <p class="p-0">SELECT SIZE <span class="left-product" id="product_qty">@if($product->product_qty<=0)Out Of Stock @else Only {{ $product->product_qty?$product->product_qty:0 }} Left @endif</span></p>
                        <!-- <div id="test-pjax">
                          test pjax
                        </div> -->
                        <!-- <div id='wrapper'>
                            <a data-pjax href='foo'>Foobar</a>
                        </div> -->
                     </div>
                  </div>
                  <div class="col-sm-7 col-5 view-sizechart-text">
                     <a href="#" class="size-chart" data-toggle="modal" data-target="#myModal"><!-- VIEW SIZE CHART --> SIZE CHART </a>
                     <!-- The Modal sizr chart POPUP-->
                     <div class="modal" id="myModal">
                        <div class="modal-dialogSizechart">
                           <div class="modal-content">
                              <!-- Modal Header -->
                              <div class="modal-header">
                                 <h4 class="modal-title"><!-- Size Chart -->Size Chart </h4>
                                 <button type="button" class="close" data-dismiss="modal">×</button>
                              </div>
                              <!-- Modal body -->
                              <div class="modal-body">
                                 <div class="container-fluid">
                                    <div class="row">
                                      <div class="col-md-12">
                                        @if(isset($size_chart))
                                          {!! $size_chart->size_chart_desc !!}
                                        @endif
                                      </div>
                                       <div class="col-md-12">
                                          <div class="sizechart-section">
                                             <ul class="nav nav-tabs  nav-justified">
                                                <li class="nav-item">
                                                   <a class="nav-link active" data-toggle="tab" href="#sizechart-table-in"><!-- Size Chart in Inch -->Size in Inches</a>
                                                </li>
                                                <li class="nav-item">
                                                   <a class="nav-link" data-toggle="tab" href="#sizechart-table-cm">Size in Cms</a>
                                                </li>
                                                <li class="nav-item">
                                                   <a class="nav-link" data-toggle="tab" href="#sizechart-img">How to Measure</a>
                                                </li>
                                             </ul>
                                             <!-- Tab panes -->
                                             <div class="tab-content">
                                                <div class="tab-pane container pt-3 active  pr-0 pl-0 contain-full" id="sizechart-table-in">
                                                   <div class="table-responsive modal-size-chart">
                                                      <table class="table table-hover sizechart-style table-bordered">
                                                         <thead class="thead-light">
                                                           @if(isset($size_chart_types))
                                                             <tr id="trupper">
                                                             <th>Size</th>
                                                             @foreach ($size_chart_types as $size_chart_type)
                                                               <th>
                                                               {{ $size_chart_type->size_chart_field_name }}
                                                               </th>
                                                             @endforeach
                                                             </tr>
                                                           @endif
                                                         </thead>
                                                         <tbody>
                                                           @if(isset($size_chart->chart_childs) && count($size_chart->chart_childs)>0)

                                                             @foreach($size_chart->chart_childs as $size_chart_child)
                                                             <tr>
                                                               @if(isset($size_chart_types))
                                                                 <td>{{ isset($size_chart_child->size->size_name)?$size_chart_child->size->size_name:'' }}</td>
                                                                 @foreach ($size_chart_types as $size_chart_type)
                                                                   <td>{{ $size_chart_child->{$size_chart_type->size_chart_field_code} }}</td>
                                                                 @endforeach
                                                               @endif
                                                             </tr>
                                                             @endforeach
                                                           @endif
                                                         </tbody>
                                                      </table>
                                                   </div>
                                                </div>
                                                <div class="tab-pane container text-center pt-3 pr-0 pl-0" id="sizechart-table-cm">
                                                  <div class="table-responsive modal-size-chart">
                                                     <table class="table table-hover sizechart-style table-bordered">
                                                       <thead class="thead-light">
                                                         @if(isset($size_chart_types))
                                                           <tr id="trupper">
                                                           <th>Size</th>
                                                           @foreach ($size_chart_types as $size_chart_type)
                                                             <th>
                                                             {{ $size_chart_type->size_chart_field_name }}
                                                             </th>
                                                           @endforeach
                                                           </tr>
                                                         @endif
                                                       </thead>
                                                       <tbody>
                                                         @if(isset($size_chart->chart_childs) && count($size_chart->chart_childs)>0)

                                                           @foreach($size_chart->chart_childs as $size_chart_child)
                                                           <tr>
                                                             @if(isset($size_chart_types))
                                                               <td>{{ isset($size_chart_child->size->size_name)?$size_chart_child->size->size_name:'' }}</td>
                                                               @foreach ($size_chart_types as $size_chart_type)
                                                                 <td>{{ isset($size_chart_child->{$size_chart_type->size_chart_field_code})?is_numeric($size_chart_child->{$size_chart_type->size_chart_field_code})?$size_chart_child->{$size_chart_type->size_chart_field_code}*2.54:$size_chart_child->{$size_chart_type->size_chart_field_code}:'-' }}</td>
                                                               @endforeach
                                                             @endif
                                                           </tr>
                                                           @endforeach
                                                         @endif
                                                       </tbody>
                                                     </table>
                                                  </div>
                                                  </div>

                                                <div class="tab-pane container text-center fade" id="sizechart-img">
                                                  @if(isset($size_chart->chart_images) && count($size_chart->chart_images)>0)
                                                    @foreach($size_chart->chart_images as $size_chart_image)
                                                      <img class="img-fluid mt-3  mb-3" src="{{ asset('backend-assets/uploads/size_chart_images/') }}/{{ $size_chart_image->image_name }}" alt="">
                                                    @endforeach
                                                  @endif
                                                </div>
                                             </div>
                                          </div>
                                          <!-- chart end -->
                                       </div>
                                       <div class="col-md-12">
                                         @if(isset($size_chart) && isset($size_chart->size_chart_footer_desc))
                                           {!! $size_chart->size_chart_footer_desc !!}
                                         @endif
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="row product-details-info " id="shakeonempty">
                 <div class="col-md-12">
                   <div class="form-group mb-0" >
                      <div class=" input-group">
                        <div class="details-color-selected" >

                          <div class="swatches">
                            <div class="swatch clearfix" data-option-index="0" id="sizes_div">
                              <!-- <div class="header">Size</div> -->
                              @if($product->product_type == 'simple')
                                <div data-value="{{ $product->size_id }}" class="swatch-element-size plain s available">
                                  <input id="size-{{ $product->size_id }}" type="radio" name="size_id" value="{{ $product->size_id }}" class="size_checked" checked  />
                                  <label for="size-{{ $product->size_id }}">
                                    {{ isset($size_list[$product->size_id])?$size_list[$product->size_id]:'' }}
                                  </label>
                                </div>
                              @elseif($product->product_type == 'configurable')
                                @if(isset($product->product_variants) && count($product->product_variants)>0)
                                @php
                                  $product_size_ids = array_unique(array_column($product->product_variants->toArray(), 'size_id'));
                                  //dd(array_unique($product_size_ids));
                                @endphp
                                  @foreach($product_size_ids as $size)

                                    <div data-value="{{ $size }}" class="swatch-element-size plain s available">
                                      <input id="size-{{ $size }}" type="radio" name="size_id" value="{{ $size }}" class="size_checked"  />
                                      <label for="size-{{ $size }}">
                                        {{ isset($size_list[$size])?$size_list[$size]:'' }}
                                      </label>
                                    </div>
                                  @endforeach
                                 @endif
                                @endif

                              <!-- <div data-value="M" class="swatch-element-size plain m available">
                                <input id="swatch-0-m" type="radio" name="size_id" value="M" class="size_checked"   />
                                <label for="swatch-0-m">
                                  M
                                </label>
                              </div>
                              <div data-value="L" class="swatch-element-size plain l available">
                                <input id="swatch-0-l" type="radio" name="size_id" value="L" class="size_checked"  />
                                <label for="swatch-0-l">
                                  L
                                </label>
                              </div>
                              <div data-value="XL" class="swatch-element-size plain xl available">
                                <input id="swatch-0-xl" type="radio" name="size_id" value="XL" class="size_checked"  />
                                <label for="swatch-0-xl">
                                  XL
                                </label>
                              </div>
                              <div data-value="2XL" class="swatch-element-size plain 2xl available">
                                <input id="swatch-0-2xl" type="radio" name="size_id" value="2XL" class="size_checked"  />
                                <label for="swatch-0-2xl">
                                  2XL
                                </label>

                              </div>
                              <div data-value="3XL" class="swatch-element-size plain 3xl available">
                                <input id="swatch-0-3xl" type="radio" name="size_id" value="3XL" class="size_checked"  />
                                <label for="swatch-0-3xl">
                                  3XL
                                </label>
                              </div>
                              <div data-value="4XL" class="swatch-element-size plain 4xl available">
                                <input id="swatch-0-4xl" type="radio" name="size_id" value="4XL" class="size_checked"  />
                                <label for="swatch-0-4xl">
                                  4XL
                                </label>
                              </div>
                              <div data-value="5XL" class="swatch-element-size plain 5xl available">
                                <input id="swatch-0-5xl" type="radio" name="size_id" value="5XL" class="size_checked"  />
                                <label for="swatch-0-5xl">
                                  5XL
                                </label>
                              </div> -->
                            </div>
                          </div>
                        </div>
                      </div>
                      @if($errors->has('size_id'))
                        <!-- <div class="col-md-12"> -->
                          <div class="error">{{ $errors->first('size_id') }}</div>
                        <!-- </div> -->
                      @endif
                      <div class="error" id="empty_size_error" style="dislplay:none;">Please Select the Size</div>
                    </div>

                 </div>

               </div>
                         <div class="row product-details-info ">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                               <div class="produt-details-headings colors-option-padd">
                                  <p class="p-0">SELECT QUANTITY</p>
                               </div>
                               <div class="qtySelector text-center">
                                  <i class="fa fa-minus decreaseQty"></i>
                                  <input type="text" class="qtyValue" name="quantity" value="1" />
                                  <i class="fa fa-plus increaseQty"></i>
                               </div>
                            </div>
                         </div>
                         <div class="row product-details-info pt-4">
                           <!-- @include('frontend.includes.errors') -->
                            <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                               <div class="product-details-addbtn">
                                  <!-- <button class="pro-details-btn pro-add" type="button" name="button">ADD TO CART</button> -->
                                  <button type="submit" name="addto" class="pro-details-btn pro-add" value="addtocart">ADD TO CART</button>
                                  <button class="pro-like addtowishlist" type="button" name="button"><i class="fa fa-heart heart" aria-hidden="true"></i></button>
                                  <button type="submit" class="pro-details-btn  pro-buy" name="addto" value="addtobuy">BUY NOW</button>
                                  <!-- <button class="pro-details-btn  pro-buy" type="button" name="button">BUY NOW</button> -->
                               </div>
                            </div>
                         </div>

                   </form>
                 </div>
               </div>
             </div>
            </div>
         </div>

         <div class="container-fluidcustom">
  <div class="row product-description-row">
     <div class="col-lg-6 product-description-col">
        <div class="pro-details-tabs">
           <nav class="pb-4">
              <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                 <a class="nav-item nav-link mr-1 active" id="nav-description" data-toggle="tab" href="#nav-description-tab" role="tab" aria-controls="nav-home" aria-selected="true">DESCRIPTION</a>
                 <a class="nav-item nav-link mr-1" id="nav-specificatios" data-toggle="tab" href="#nav-specificatios-tab" role="tab" aria-controls="nav-profile" aria-selected="false">SPECIFICATIONS</a>
                 <a class="nav-item nav-link mr-1" id="nav-disclaimer" data-toggle="tab" href="#nav-disclaimer-tab" role="tab" aria-controls="nav-contact" aria-selected="false">DISCLAIMER</a>
                 <a class="nav-item nav-link" id="nav-rating" data-toggle="tab" href="#nav-rating-tab" role="tab" aria-controls="nav-about" aria-selected="false">RATINGS & REVIEWS</a>
              </div>
           </nav>
           <div class="tab-content" id="nav-tabContent">
              <div class="tab-pane fade show active" id="nav-description-tab" role="tabpanel" aria-labelledby="nav-description">
                 <div class="tab-content-color">
                    <p class="tab-content-para">{!! $product->product_desc !!}</p>
                 </div>
              </div>
              <div class="tab-pane fade" id="nav-specificatios-tab" role="tabpanel" aria-labelledby="nav-specificatios">
                 <!-- <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                       <tr>
                          <td class="table-column-color">Label</td>
                          <td>Kapachi</td>
                       </tr>
                       <tr>
                          <td class="table-column-color">Material</td>
                          <td>50% Cotton & 50% Viscose</td>
                       </tr>
                       <tr>
                          <td class="table-column-color">Fit Type </td>
                          <td>Regular</td>
                       </tr>
                       <tr>
                          <td class="table-column-color">Print or Pattern</td>
                          <td>Floral</td>
                       </tr>
                       <tr>
                          <td class="table-column-color">Neck Type </td>
                          <td>Round</td>
                       </tr>
                       <tr>
                          <td class="table-column-color">Sleeve Type</td>
                          <td>Bell</td>
                       </tr>
                       <tr>
                          <td class="table-column-color">Sleeve Length </td>
                          <td>Full</td>
                       </tr>
                       <tr>
                          <td class="table-column-color">Type </td>
                          <td>Straight</td>
                       </tr>
                       <tr>
                          <td class="table-column-color">Length </td>
                          <td>Half</td>
                       </tr>
                       <tr>
                          <td class="table-column-color">Occasion</td>
                          <td>Daily wear</td>
                       </tr>
                       <tr>
                          <td class="table-column-color">Fabric Transparency</td>
                          <td>Not Transparent</td>
                       </tr>
                       <tr>
                          <td class="table-column-color">Stretch</td>
                          <td>Stretchable</td>
                       </tr>
                       <tr>
                          <td class="table-column-color">Closure </td>
                          <td>Button</td>
                       </tr>
                       <tr>
                          <td class="table-column-color">Distress  </td>
                          <td>Flat</td>
                       </tr>
                       <tr>
                          <td class="table-column-color">Waist-Rise</td>
                          <td>Mid-Rise</td>
                       </tr>
                       <tr>
                          <td class="table-column-color">Waistband </td>
                          <td>Yes</td>
                       </tr>
                       <tr>
                          <td class="table-column-color">Collar</td>
                          <td>No</td>
                       </tr>
                       <tr>
                          <td class="table-column-color">Style </td>
                          <td>Boot cut</td>
                       </tr>
                       <tr>
                          <td class="table-column-color">Fade  </td>
                          <td>Lightly</td>
                       </tr>
                       <tr>
                          <td class="table-column-color">Shade</td>
                          <td>Dark </td>
                       </tr>
                       <tr>
                          <td class="table-column-color">Basic Trend </td>
                          <td>Ethnic</td>
                       </tr>
                       <tr>
                          <td class="table-column-color">Suitable for Season  </td>
                          <td>Summer</td>
                       </tr>
                       <tr>
                          <td class="table-column-color">Number of Pockets </td>
                          <td>4</td>
                       </tr>
                       <tr>
                          <td class="table-column-color">Ideal for</td>
                          <td>Girls</td>
                       </tr>
                       <tr>
                          <td class="table-column-color">Set of (Number of Units in Set)</td>
                          <td>Unit of 1Set</td>
                       </tr>
                       <tr>
                          <td class="table-column-color">Product Weight </td>
                          <td>200 gm</td>
                       </tr>
                       <tr>
                          <td class="table-column-color">Package Dimensions L x W x H</td>
                          <td>10 x 3 x 12 cm.</td>
                       </tr>
                       <tr>
                          <td class="table-column-color">Eligible for Return</td>
                          <td>Yes</td>
                       </tr>
                       <tr>
                          <td class="table-column-color">Wash Care Instructions</td>
                          <td>Dry Clean</td>
                       </tr>
                    </table>
                 </div> -->
                 <div class="table-responsive specification-table">
                    {!! $product->product_specification !!}
                 </div>
                 <div class="tab-content-color pt-4">
                    <p><span class="tab-content-specificatios">Generic Name:</span> <span class="">{{ $product->product_generic_name }}</span><br>
                       <span class="tab-content-specificatios">Product ID:</span> <span class="">{{ $product->product_sku }}</span><br>
                       <span class="tab-content-specificatios">Country of Origin:</span> <span class="">{{ ($product->country)?$product->country->name:'NA' }}</span><br>
                    </p>
                    <p>
                       <span class="tab-content-specificatios">Sold by: </span><span class="">{{ ($product->seller)?$product->seller->seller_name:'NA' }}</span><br>
                    </p>
                    <span id="toggle" class="">View More Info</span>
                 </div>
                 <div id="text" class="tab-content-table more-info-bg pt-4">
                   <p><span class="tab-content-details">Manufacturer Details</span><br>
                      <span class="tab-content-subdetails">{{ ($product->manufacturer)?$product->manufacturer->manufacturer_name:'NA' }}<br>
                      {{ ($product->manufacturer)?$product->manufacturer->manufacturer_address:'NA' }}</span>
                   </p>
                   <p><span class="tab-content-details">Packer Details</span><br>
                      <span class="tab-content-subdetails">{{ ($product->packer)?$product->packer->packer_name:'NA' }}<br>
                      {{ ($product->packer)?$product->packer->packer_address:'NA' }}</span>
                   </p>
                   <p><span class="tab-content-details">Importer Details</span><br>
                      <span class="tab-content-subdetails">{{ ($product->importer)?$product->importer->importer_name:'NA' }}<br>
                      {{ ($product->importer)?$product->importer->importer_address:'NA' }}</span>
                   </p>
                 </div>
              </div>
              <div class="tab-pane fade" id="nav-disclaimer-tab" role="tabpanel" aria-labelledby="nav-disclaimer">
                 <div class="tab-content-color">
                    <p class="tab-content-para">{!! $product->product_disclaimer !!}</p>
                 </div>
              </div>
              <div class="tab-pane fade" id="nav-rating-tab" role="tabpanel" aria-labelledby="nav-rating">
                 <div class="product-details-rating">
                   <p class="rating-head">Customer Ratings & Reviews |
                       @auth
                       <a href="#" class="rating-star" data-toggle="modal" data-target="#reviewRating"> Write your Review for this Product <span><sup>Click</sup></span></a></p>
                    @else
                        <a href="{{route('login')}}" class="rating-star"> Write your Review for this Product <span><sup>Click</sup></span></a></p>
                   @endauth
                    <!-- The Modal star rating reviews-->
                    <div class="modal" id="reviewRating">
                       <div class="modal-dialogRatings">
                          <div class="modal-content">
                             <!-- Modal Header -->
                             <div class="modal-header">
                                <h4 class="modal-title">Review for Product</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                             </div>
                             <!-- Modal body -->
                             <div class="modal-body">
                                <div class="container-fluid">
                                   <div class="row content-ratinng">
                                      <div class="col-lg-2 col-md-2 col-sm-5 col-5">
                                         <div class="produtct-rating-img">
                                           <img class="img-fluid" src="{{ asset('frontend-assets/images/tops/t-12.jpg') }}" alt="">
                                         </div>
                                      </div>
                                      <div class="col-lg-10 col-md-10 col-sm-7 col-7">
                                        <div class="product-rating-info">
                                           <p>Product ID:{{ $product->product_id }}</p>
                                           <p>{{ $product->product_title }}</p>
                                           <p>{{ $product->product_generic_name }}</p>
                                        </div>
                                      </div>
                                   </div>
                                   <div class="row ">
                                      <div class="col-lg-12 col-md-12 col-sm-12">
                                        <form class="pt-4 rating-review-form" action="{{route('reviews')}}" method="post">
                                            @csrf
                                           <h6>Rate This Product <span class="star">*</span></h6>
                                            <input type="hidden" name="product_id" value="{{$product->product_id}}">
                                            @auth
                                            <input type="hidden" name="user_id" value="{{Auth()->user()->id}}">
                                            <input type="hidden" name="username" value="{{Auth()->user()->name}}">
                                            @endauth
                                            <div class="form-group m-0">
                                               <div class="form-item">
                                                  <input id="rating-5" name="rating" type="radio" value="5" required>
                                                  <label for="rating-5" data-value="5">
                                                     <span class="rating-star">
                                                     <span class="ratingstar-hollow rating-star">&#9734;</span>
                                                     <span class="ratingstar-fill rating-star">&#9733;</span>
                                                     </span>
                                                     <!-- <span class="ir">5</span> -->
                                                  </label>
                                                  <input id="rating-4" name="rating" type="radio" value="4" required>
                                                  <label for="rating-4" data-value="4">
                                                     <span class="rating-star">
                                                     <span class="ratingstar-hollow rating-star">&#9734;</span>
                                                     <span class="ratingstar-fill rating-star">&#9733;</span>
                                                     </span>
                                                     <!-- <span class="ir">4</span> -->
                                                  </label>
                                                  <input id="rating-3" name="rating" type="radio" value="3" required>
                                                  <label for="rating-3" data-value="3">
                                                     <span class="rating-star">
                                                     <span class="ratingstar-hollow rating-star">&#9734;</span>
                                                     <span class="ratingstar-fill rating-star">&#9733;</span>
                                                     </span>
                                                     <!-- <span class="ir">3</span> -->
                                                  </label>
                                                  <input id="rating-2" name="rating" type="radio" value="2" required>
                                                  <label for="rating-2" data-value="2">
                                                     <span class="rating-star">
                                                     <span class="ratingstar-hollow rating-star">&#9734;</span>
                                                     <span class="ratingstar-fill rating-star">&#9733;</span>
                                                     </span>
                                                     <!-- <span class="ir">2</span> -->
                                                  </label>
                                                  <input id="rating-1" name="rating" type="radio" value="1" required>
                                                  <label for="rating-1" data-value="1">
                                                     <span class="rating-star">
                                                     <span class="ratingstar-hollow rating-star">&#9734;</span>
                                                     <span class="ratingstar-fill rating-star">&#9733;</span>
                                                     </span>
                                                     <!-- <span class="ir">1</span> -->
                                                  </label>
                                               </div>
                                            </div>
                                            <h6>Add your Key Headline<span class="star">*</span></h6>
                                            <div class="form-group  pb-2">
                                               <input class="form-control rating-input"  name="headline" placeholder="Main Title" type="text" required>
                                            </div>
                                            <h6>Write your Review and share your experience with other people<span class="star">*</span></h6>
                                            <div class="form-group pb-2">
                                               <textarea class="form-control rating-input" rows="3" name="comment"placeholder="Review"  required></textarea>
                                            </div>
                                            <button type="submit" class="contact-btn">SUBMIT</button>
                                         </form>
                                      </div>
                                   </div>
                                </div>
                             </div>
                          </div>
                       </div>
                    </div>
                 </div>
                 <div class="row">
                    <div class="col-md-6">
                       <div class="star-border">
                         <div class="star-content">
                             @if(floor($avgrates)==0 && floor($avgrates)<1)
                                 <div class="star-rating star-rating1 ">
                                     <span>☆</span><span>☆</span><span>☆</span><span>☆</span><span>☆</span>
                                     <div class="star-rating__current">
                                     </div>
                                 </div>
                             @elseif(floor($avgrates)==1 && floor($avgrates)<2)
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
                 <div class="row pt-4">
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
                 <div class="row pt-4">
                   <div class="col-lg-12 col-md-12 col-sm-12 col-12 ">
                       <div class="all-ratings">
                          <h4>See All Ratings & Reviews ( {{$countReviews}} )</h4>
                       </div>
                        @if(isset($twoReviews) && count($twoReviews)>0)
                        @foreach($twoReviews as $twoReview)

                       <div class="tab-content-color">
                          <div class="review-star">
                              @for($i=0;$i<$twoReview->rating;$i++)
                                  <i class="fa fa-star" aria-hidden="true"></i>
                              @endfor

                             <span class="reviewer-comment">{{$twoReview->headline}}</span>
                          </div>
                          <p class="reviewer-comment">{{$twoReview->comment}}</p>
                          <p><span class="">Reviewed by:</span>
                             <span class="reviewer-name">{{$twoReview->username}}</span>
                             <span class="reviewer-date">
                              {{date('d F, Y', strtotime($twoReview->created_at))}}</span>
                          </p>
                       </div>

                        @endforeach
                        @endif
                        @if($countReviews>=2)
                        <div class="review_bttn">
                     <a href="{{ url('dp/') }}/{{ $product->category_slug }}/{{ $product->sub_category_slug }}/{{ $product->sub_sub_category_slug }}/{{ $product->product_slug }}/product-reviews">See All Reviews</a>
                     </div>
                     @endif

                     {{-- <div class="" id="target-see-all-reviews">
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
                                         <span class="reviewer-date">
                                          {{date('d F, Y', strtotime($allreview->created_at))}}</span>
                                     </p>
                                 </div>

                             @endforeach
                         @endif
                     </div>
                            <div class="see-more-reviews mt-3">
                         <p class="m-0">
                           <span class="see-all-reviews-content">See All Reviews</span>

                         </p>
                       </div> --}}
                    </div>

                 </div>
              </div>
           </div>
        </div>
     </div>
     <div class="col-lg-6 check-info-contennt" >
       <div class="row product-details-infos">
          <div class="col-lg-12 col-md-12 col-sm-12 col-12">
             <div class="produt-details-headings colors-option-padd">
                <p class="p-0">Please Check Delivery Details & Cash on Delivery Availability</p>
             </div>
             <div class="subscribe_form pincode-form">
                <div class="pincode-input" style="">
                   <div class="form-group  " style="margin-bottom: 5px;">
                      <div class=" input-group">
                         <input class="form-control form-control-h" id="shipping_pincode" type="text" maxlength="6" value="{{ old('shipping_pincode') }}"  minlength="6" inputmode="numeric" required>
                         <label for="user">ENTER PINCODE </label>
                         <span class="input-group-btn">
                         <button class="pincode-btn" id="check_pincode" type="button">CHECK</button>
                         </span>
                      </div>
                   </div>
                </div>
             </div>
             <!-- <div class="produt-details-headings" >
                <p class="p-0" ></p>
             </div> -->
          </div>
       </div>
       <div class="row product-details-info ">
          <div class="col-lg-12 col-md-12 col-sm-12 col-12">
             <div class="product-shortinfo">
                <table>
                    <tr id="invalid_pincode" style="text-color: red;color: #C00000;">
                      <td class="pr-2">
                         <p class="m-0 text-center"><i class="fa fa-exclamation" aria-hidden="true"></i></p>
                      </td>
                      <td>
                         <p class="m-0">Invalid Pincode</p>
                      </td>
                   </tr>
                   <tr id="exclusive_hide">
                      <td class="pr-2">
                         <p class="m-0"><i class=" flat-icon flaticon-vip" ></i></p>
                      </td>
                      <td>
                         <p class="m-0">Exclusive, Hand-Picked & Genuine Products</p>
                      </td>
                   </tr>
    
                   <tr id="order_now_show" style="display:none;">
                      <td class="pr-2">
                         <p class="m-0"><i class="flat-icon flaticon-free-delivery"></i></p>
                      </td>
                      <td>
                        @php
                          $today = date('d-m-Y');
                          $no_of_days = ($order_delivery->order_delivery_max_days>0)?$order_delivery->order_delivery_max_days:7;
                          $estimated_delivery_date = date('l, d F Y', strtotime($today. ' + '.$no_of_days.' days'));
                        @endphp
                         <p class="m-0">Order now & get it by {{ $estimated_delivery_date }}</p>
                      </td>
                   </tr>
                   <!-- <tr>
                      <td class="pr-2">
                         <p class="m-0"><i class="flat-icon flaticon-free-delivery"></i></p>
                      </td>
                      <td>
                         <p class="m-0">Free Delivery will be available on Order above ₹699</p>
                      </td>
                   </tr> -->
                   <tr id="result_div">
                      <td class="pr-2">
                         <p class="m-0"><i class="flat-icon flaticon-cash" ></i></p>
                      </td>
                      <td >
                         <p class="m-0" id="result">Cash on Delivery might be available</p>
                      </td>
                   </tr>
                   <tr id="easy_days_color">
                      <td class="pr-2">
                         <p class="m-0"><i class="flat-icon flaticon-return" ></i></p>
                      </td>
                      <td>
                         <p class="m-0">Easy 7 Days Return Policy</p>
                      </td>
                   </tr>
                </table>
             </div>
          </div>
       </div>
       <!-- <div class="row product-details-info pt-4">
          <div class="col-lg-12 col-md-12 col-sm-12 col-12">
             <div class="product-shortinfo produt-pincodeinfo">
                <p class="m-0">Order now & get it by Tuesday, 8 December 2020</p>
                <p class="m-0">Sorry, Cash on Delivery is not available on your Location</p>
                <p class="m-0">Easy 7 Days Return Policy</p>
             </div>
          </div>
       </div> -->
       <div class="row product-details-info pt-4">
          <div class="col-md-12 col-12">
             <div class="product-shortinfo product-policyinfo">
                <p class="m-0 icons">Return & Refund Policy may vary based on Products, Promotions & Offers.
                   For more details, please refer our <a href="{{ url('/') }}/pages/return-refund-policy" class="return-policy" target="_blank">Return & Refund Policy</a>
                </p>
             </div>
          </div>
       </div>
       <div class="row product-details-info no-top-padd pt-4">
          <div class="col-md-12 col-12">
             <div class="produt-details-headings colors-option-padd">
                <p class="p-0">SHARE</p>
             </div>
             <div class="social-media-icon">
                <a class="product-share fb" id="fb_share" href="javascript:void(0);" ><i class="fa fa-facebook" aria-hidden="true"></i></a>
                <a class="product-share insta" href="https://www.instagram.com/" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                <a class="product-share twit" id="twit_share" href="javascript:void(0);" ><i class="fa fa-twitter" aria-hidden="true"></i></a>
                <!-- <a class="product-share pint" href="https://in.pinterest.com/" target="_blank"><i class="fa fa-pinterest" aria-hidden="true"></i></a> -->
               <a class="product-share pint" id="pint_share" href="javascript:void(0);">
               <!-- (function()%7Bvar%20e=document.createElement('script');e.setAttribute('type','text/javascript');e.setAttribute('charset','UTF-8');e.setAttribute('src','http://assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);document.body.appendChild(e)%7D)() -->
               <i class="fa fa-pinterest" aria-hidden="true"></i>
               </a>
                <a class="product-share whtsp" id="whatsapp_share" href="javascript:void(0);" ><i class="fa fa-whatsapp" aria-hidden="true"></i></a>
             </div>
          </div>
       </div>
       <div class="row product-details-info pt-5">
          <div class="col-md-12 col-12">
             <div class="produt-details-headings">
                <p class="p-0">PROMOTIONS AND BEST OFFERS </p>
             </div>
             @if(isset($coupon_data) && count($coupon_data)>0)
             @foreach($coupon_data->take(3) as $coupon)
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
             @endforeach
             @endif
             <!-- <div class="tag-content-color product-shortinfo mb-2">
                <table>
                   <tr>
                      <td class="tag-icon pr-3"><i class="fa fa-tag" aria-hidden="true"></i></td>
                      <td>
                         <p class="p-0">Use Coupon Code: DADRE100 & Get 10% Off  *T&C Apply On minimum purchase of  ₹1500</p>
                      </td>
                   </tr>
                </table>
             </div> -->
             <!-- <div class="tag-content-color product-shortinfo">
                <table>
                   <tr>
                      <td class="tag-icon pr-3"><i class="fa fa-tag" aria-hidden="true"></i></td>
                      <td>
                         <p class="p-0">Use Coupon Code: DADRE100 & Get 10% Off  *T&C Apply On minimum purchase of  ₹1500</p>
                      </td>
                   </tr>
                </table>
             </div> -->
          </div>
       </div>
     </div>
  </div>
</div>
<!-- Product details end -->
@if(isset($relatedProducts) && count($relatedProducts)>0)
  <!-- You might prefer to buy this too start -->
  <div class="container-fluidcustom2 pt-4 ">
     <div class="row prodetails-head2 pt-4 ">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12 ">
           <h4 class="ml-4">You might prefer this</h4>
        </div>
     </div>

     <div class="row prodetails-head2 pt-4 pb-4">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
           <div class="owl-carousel  owl-theme product-slider1" >
             @php
              $list_images=$imageList;
             @endphp
               @foreach($relatedProducts as $product_card)
                   @include('frontend.product.details_product_card',compact('product_card','list_images'))
               @endforeach
             @php
              $list_images=[];
             @endphp
           </div>
        </div>
     </div>
  </div>
@endif
  <!-- You might prefer to buy this too end -->
  @if(isset($frequently_boughts) && count($frequently_boughts)>0)
    <!-- Frequently bought together star -->
    <div class="container-fluidcustom2 pt-4 mb-4">
       <div class="row prodetails-head2 pt-4 ">
          <div class="col-lg-12 col-md-12 col-sm-12 col-12 ">
             <h4 class="ml-4">Frequently bought together</h4>
          </div>

       </div>
       <div class="row prodetails-head2 pt-4 pb-4">
          <div class="col-lg-12 col-md-12 col-sm-12 col-12">
             <div class="owl-carousel  owl-theme product-slider1" >
               @php
                $list_images=$frequently_bought_image;
               @endphp
               @foreach($frequently_boughts as $product_card)
                     @include('frontend.product.details_product_card',compact('product_card'))
               @endforeach
               @php
                $list_images=[];
               @endphp
           </div>
        </div>
     </div>
  </div>
  <!-- Frequently bought together end -->
@endif
  <!-- Recently viewed star -->
@auth
    @if(isset($recentlyViews) && count($recentlyViews)>0)
  <div class="container-fluidcustom2 pt-4 pb-5 ">
    <div class="row prodetails-head2 pt-4 ">
        <div class="col-lg-8 col-md-8 col-sm-8 col-12 ">
           <h4 class="ml-4 recent-view-left">Recently viewed </h4>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-4 remove-btn-right col-12 text-right ">
           <a class="remove-btn mr-4"  href="{{route('recentViewProductDelete')}}">REMOVE ALL</a>
        </div>
     </div>
     <div class="row prodetails-head2 pt-4 pb-4 mb-2">
        <div class="col-lg-12 col-md-12 col-sm-12 col-12">
           <div class="owl-carousel  owl-theme product-slider1" >
             @php
              $list_images=$recentlyViewsimage;
             @endphp
             @foreach($recentlyViews as $product_card)
              @include('frontend.product.details_product_card',compact('product_card'))
             @endforeach
             @php
              $list_images=[];
             @endphp
           </div>
        </div>
     </div>
  </div>
  <!-- Recently viewed end -->
    @endif
@endauth
  <!-- Recently viewed end -->
  <!-- <d`iv id="pjax-container">
    Hello Pjax!
  </div> -->



  <script>
      function check_shipping_pincode(shipping_pincode)
      {
         if (shipping_pincode)
         {
            $("#result_div").hide();
            $.ajax({
               url:"{{ url('product/verifypincode') }}",
               data:{
               _token: "{{ csrf_token() }}",
               shipping_pincode: shipping_pincode,
               },
               type: "post",
               success: function(data)
               {
               $("#result_div").show();
               $("#invalid_pincode").hide();
               if (data[0] == 'Y')
               {
                  $("#order_now_show").addClass('pincode_verify_success_color');
                  $("#result_div").addClass('pincode_verify_success_color');
                  $("#easy_days_color").addClass('pincode_verify_success_color');
                  $("#result").html('Cash on Delivery is available');
                  $("#exclusive_hide").hide();
                  $("#order_now_show").show();
               }
               else if (data[0] == 'N')
               {
                  $("#result").html('Sorry, Cash on Delivery is not available on your Location');
                  $("#exclusive_hide").show();
                  $("#invalid_pincode").show();
                  $("#order_now_show").hide();
                  $("#order_now_show").removeClass('pincode_verify_success_color');
                  $("#result_div").removeClass('pincode_verify_success_color');
                  $("#easy_days_color").removeClass('pincode_verify_success_color');
               }
               else if (data[0] == 'C')
               {
                  $("#result").html('Sorry, Cash on Delivery is not available on your Location');
                  $("#exclusive_hide").hide();
                  $("#order_now_show").show();
                  $("#order_now_show").addClass('pincode_verify_success_color');
                  $("#result_div").addClass('pincode_verify_success_color');
                  $("#easy_days_color").addClass('pincode_verify_success_color');
               }
               else
               {
                  $("#result").html('Sorry, Cash on Delivery is not available on your Location');
                  $("#exclusive_hide").show();
                  $("#order_now_show").hide();
                  $("#order_now_show").removeClass('pincode_verify_success_color');
                  $("#result_div").removeClass('pincode_verify_success_color');
                  $("#easy_days_color").removeClass('pincode_verify_success_color');
               }
               },
               error: function(XMLHttpRequest, textStatus, errorThrown)
               {

               $("#exclusive_hide").show();
               $("#order_now_show").hide();
               if (errorThrown == 'Unauthorized')
               {
                  alert('Please login !');
               }
               }
            });
            setCookie("cookie_pincode", shipping_pincode, 30);
         }
      }
      function setCookie(cname,cvalue,exdays) 
      {
         const d = new Date();
         d.setTime(d.getTime() + (exdays*24*60*60*1000));
         let expires = "expires=" + d.toUTCString();
         document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
      }

      function getCookie(cname) 
      {
         let name = cname + "=";
         let decodedCookie = decodeURIComponent(document.cookie);
         let ca = decodedCookie.split(';');
         for(let i = 0; i < ca.length; i++) 
         {
            let c = ca[i];
            while (c.charAt(0) == ' ') 
            {
               c = c.substring(1);
            }
            if (c.indexOf(name) == 0) 
            {
               return c.substring(name.length, c.length);
            }
         }
         return "";
      }
      function colors(color_id)
      {
         // alert(color_id);
         $.ajax({
            url: '{{url("/product/getcolors")}}',
            type: 'post',
            data:
            {
               color_id: color_id ,_token: "{{ csrf_token() }}",
            },
            success: function (data)
            {
               // alert(data);
               console.log(data);
               $('#color_name').text(data);
            }
         });
      }

      function variant_size_list(product_id,color_id)
      {
         // alert(color_id);
         $.ajax({
            url: '{{url("/product/getvariantsizelist")}}',
            type: 'post',
            data:
            {
               product_id: product_id ,color_id: color_id ,
               _token: "{{ csrf_token() }}",
            },
            success: function (data)
            {
               //console.log(data);
               $('#sizes_div').html(data[1]['sizes']);
               $('#carousel_thumbs_div').html(data[1]['product_thumbs']);
               $('#carousel_div').html(data[1]['product_images']);
               $("#sizes_div").find(".size_checked:checked").trigger("change");
               $(".size_checked:checked").prop('checked', false);
               // $('.size_checked:checked').trigger('change');
               $(".block__pic").imagezoomsl({
                  zoomrange: [5, 5]
               });
            }
         });
      }
  $(document).ready(function()
  {
      
    var load_color_id = $('.color_checked:checked').val();
    if (load_color_id != '')
    {
      // alert(load_color_id);
      var product_id = $('#product_id').val();
      var product_type = $('#product_type').val();
      setTimeout(() => {
         colors(load_color_id);
         if (product_type == 'configurable')
         {
            variant_size_list(product_id,load_color_id);
            // variant_images(product_id,color_id);
         }
         else
         {
            $('#empty_size_error').hide();
         }
      }, 500);
      // colors(load_color_id);
    }

    $('.color_checked').on('change',function()
    {
      // alert('in');
      var color_id = $(this).val();
      var product_id = $('#product_id').val();
      var product_type = $('#product_type').val();

      colors(color_id);
      if (product_type == 'configurable')
      {
        variant_size_list(product_id,color_id);
        // variant_images(product_id,color_id);
      }
    });

    // $(window).on("load", function () {
    //   // makes sure the whole site is loaded
    //   $("#status").fadeOut(); // will first fade out the loading animation
    //   $("#preloader").delay(350).fadeOut("slow"); // will fade out the white DIV that covers the website.
    //   $("body").delay(350).css({ overflow: "visible" });
    // });

    

    $(document).on('change','.size_checked',function()
    {
      // alert('test');
      var color_id = $('.color_checked:checked').val();
      var product_id = $('#product_id').val();
      var size_id = $('.size_checked:checked').val();
      // colors(color_id);
      if(size_id != '')
      {
          $('#empty_size_error').hide();
          variants(product_id,size_id,color_id);
      }
      
      
      // pjaxvariants(product_id,size_id,color_id);
    });
   //  function pjaxvariants(product_id,size_id,color_id)
   //  {
   //    alert('test2');
   //    var _token = "{{ csrf_token() }}";
   //    // $.pjax.defaults.timeout = 5000; // time in milliseconds
   //    $.pjax({
   //      url:'{{url("/product/getproductvariants")}}',
   //      type:"post",
   //      container:'#test-pjax',
   //      // data:giveMeData(),
   //      data:
   //      {
   //        product_id: product_id ,size_id: size_id ,
   //        color_id: color_id ,_token: _token,
   //      },
   //      beforeSend: function(xhr){
   //          xhr.setRequestHeader('X-PJAX', true);
   //          xhr.setRequestHeader('X-PJAX-Container', '#test-pjax')
   //      },
   //      custom_success:function()
   //      {
   //        console.log('Custom success works!');
   //      }
   //   });
   //  }
    function variants(product_id,size_id,color_id)
    {
      $.ajax({
          url: '{{url("/product/getproductvariants")}}',
          type: 'post',
          data:
          {
            product_id: product_id ,size_id: size_id ,
            color_id: color_id ,_token: "{{ csrf_token() }}",
          },
          success: function (data)
          {
            // $(document).pjax('.size-chart', '#test-pjax');
            $('#product_variant_id').val(data[1]['product_variant_id']);
            $('#product_title').html(data[1]['product_title']);
            $('#product_sub_title').html(data[1]['product_sub_title']);
            if(data[1]['product_discounted_price']!=null && data[1]['product_discount']!=0 && data[1]['product_discount']!=null)
            {
              $('#product_price').show();
              $('#product_price').html('₹ '+data[1]['product_price']);
              $('#product_discounted_price').html('₹ '+data[1]['product_discounted_price']);
            }
            else if(data[1]['product_discounted_price']!=null && data[1]['product_discount']==0 && data[1]['product_discount']!=null)
            {
              $('#product_discounted_price').html('₹ '+data[1]['product_discounted_price']);
              $('#product_price').hide();
            }
            else
            {
              $('#product_discounted_price').html('₹ '+data[1]['product_discounted_price']);
              $('#product_price').hide();
            }
            if(data[1]['product_discount_type']!=null && data[1]['product_discount_type']=='percent' && data[1]['product_discount']!=0 && data[1]['product_discount']!=null)
            {
              $('#discount_flat_per').show();
              $('#save_amount').show();
              $('#discount_flat_per').html('('+data[1]['product_discount']+'% OFF)');
              var disocunt_amount = data[1]['product_price']-data[1]['product_discounted_price'];
              $('#save_amount').html('|   You Save ₹ '+disocunt_amount);
            }
            else if(data[1]['product_discount_type']!=null && data[1]['product_discount_type']=='flat' && data[1]['product_discount']!=0 && data[1]['product_discount']!=null)
            {
              $('#discount_flat_per').show();
              $('#save_amount').show();
              $('#discount_flat_per').html('(₹ '+data[1]['product_discount']+' OFF)');
              var disocunt_amount = data[1]['product_price']-data[1]['product_discounted_price'];
              $('#save_amount').html('|   You Save ₹ '+disocunt_amount);
            }
            else
            {
              $('#discount_flat_per').hide();
              $('#save_amount').hide();
            }
            if(data[1]['product_qty']!=null && data[1]['product_qty']!=0)
            {
              $('#product_qty').html('Only '+data[1]['product_qty']+' Left');
            }
            else
            {
              $('#product_qty').html('Out Of Stock');
            }
            // $('#carousel_thumbs_div').html(data[1]['product_thumbs']);
            // $('#carousel_div').html(data[1]['product_images']);
            // $(".block__pic").addEventListener('imagezoomsl');
            // $(".block__pic").imagezoomsl({
            //   zoomrange: [3, 3]
            // });
            // $('#product_discount').html(data[1]['product_discount']);
            // $('#color_id').val(data[1]['color_id']);
            // $('#size_id').val(data[1]['size_id']);
            // console.log(data[1]);
            // $('#color_name').text(data);
          }
       });

      // $.ajax({
      //     url: '{{url("/product/getproductvariantsget")}}',
      //     type: 'get',
      //     dataType: 'json',
      //     // beforeSend: function(xhr){
      //     //     xhr.setRequestHeader('X-PJAX', true);
      //     //     xhr.setRequestHeader('X-PJAX-Container', '#wrapper')
      //     // },
      //     success: function(resp) { $('#wrapper1').html(resp); }
      // });
    }

    //table design
    $(".specification-table table").addClass("table");
    $(".specification-table table").addClass("table-striped");
    $(".specification-table table").addClass("table-bordered");
    // alert('test1');
    $(function() {
      $('.specification-table table:first tr').each(function() {
        // alert('test');
        // if ($(this).find('a').attr('href').indexOf('myref') != -1)
          $(this).find("td:first-child").addClass('table-column-color');
      });
    });

    $('.addtowishlist').on('click',function()
    {
      // var product = $(this).closest('.wishlistbox').find('.product_id');
      var product_id = $('#product_id').val();
      // console.log(product_id);
      if (product_id)
      {
        $.ajax({
          url: '{{url("/wishlists/addtowishlist")}}',
          type: 'post',
          data:
          {
            product_id: product_id ,_token: "{{ csrf_token() }}",
          },
          success: function (data)
          {
            //console.log(data);
            // $('#color_name').text(data);
            alert(data[1]);
          },
          error: function(XMLHttpRequest, textStatus, errorThrown)
          {
            // alert("Status: " + textStatus);
            if (errorThrown == 'Unauthorized')
            {
              alert('Please login before adding product to Wishlist !');
            }
            // alert("Error: " + errorThrown);
          }
        });
      }
    });
    $("#invalid_pincode").hide();
   
    //check pincode
    $("#check_pincode").on('click',function()
    {
      var shipping_pincode = $("#shipping_pincode").val();
      check_shipping_pincode(shipping_pincode);
    });

    


      $('button[type=submit]').on('click', function(e)
      {
         var check_size_id = $('.size_checked:checked').val();
         if(!check_size_id)
         {
            e.preventDefault();
            $('#shakeonempty').addClass('ahashakeheartache');
            $('#empty_size_error').show();
         }
         else
         {
             $('#empty_size_error').hide();
         }
         
      });

      $('#shakeonempty').on('webkitAnimationEnd oanimationend msAnimationEnd animationend', function(e)
      {
         $('#shakeonempty').delay(200).removeClass('ahashakeheartache');
      });

  });


$(document).ready(function() {
 
   // Fakes the loading setting a timeout
   setTimeout(function() {
      $('body').addClass('loaded');
   }, 2500);
   var sharer_image = '';
   <?php 
      if(isset($product->product_thumb) && $product->product_thumb != "")
      {
         echo "sharer_image = '".asset('backend-assets/uploads/product_thumbs/')."/".$product->product_thumb."';";
      }
      else if(isset($product->product_images) && count($product->product_images)>0)
      {
         foreach($product->product_images->take(1) as $product_image)
         {
            echo "sharer_image = '".asset('backend-assets/uploads/product_images/') ."/".$product_image->image_name."';";
         }
      }
   ?>
   $('#pint_share').on('click',function()
   {
      var u = window.location.href;
      var t = document.title;
      var leftPosition, topPosition;
      var width = 400;
      var height = 300;
      //Allow for borders.
      leftPosition = (window.screen.width / 2) - ((width / 2) + 10);
      //Allow for title and status bars.
      topPosition = (window.screen.height / 2) - ((height / 2) + 50);
      var windowFeatures = "status=no,height=" + height + ",width=" + width + ",resizable=yes,left=" + leftPosition + ",top=" + topPosition + ",screenX=" + leftPosition + ",screenY=" + topPosition + ",toolbar=no,menubar=no,scrollbars=no,location=no,directories=no";
      // window.open('http://www.facebook.com/sharer.php?u='+encodeURIComponent(u)+'&t='+encodeURIComponent(t),'sharer', windowFeatures);
      window.open('http://pinterest.com/pin/create/button/?url=' + encodeURIComponent(u) + '&description=' + encodeURIComponent(t) + '&media=' + encodeURIComponent(sharer_image) + '','sharer', windowFeatures);
      return false;
   });
   $('#twit_share').on('click',function()
   {
      var u = window.location.href;
      var t = document.title;
      var siteurl = window.location.origin;
      var leftPosition, topPosition;
      var width = 400;
      var height = 300;
      //Allow for borders.
      leftPosition = (window.screen.width / 2) - ((width / 2) + 10);
      //Allow for title and status bars.
      topPosition = (window.screen.height / 2) - ((height / 2) + 50);
      var windowFeatures = "status=no,height=" + height + ",width=" + width + ",resizable=yes,left=" + leftPosition + ",top=" + topPosition + ",screenX=" + leftPosition + ",screenY=" + topPosition + ",toolbar=no,menubar=no,scrollbars=no,location=no,directories=no";
      window.open('http://twitter.com/share?url=' + encodeURIComponent(u) + '&text=' + encodeURIComponent(t) + '&via=' + encodeURIComponent(siteurl) + '','sharer', windowFeatures);
      return false;
   });
   $('#fb_share').on('click',function()
   {
      var u = window.location.href;
      var t = document.title;
      var siteurl = window.location.origin;
      var leftPosition, topPosition;
      var width = 400;
      var height = 300;
      //Allow for borders.
      leftPosition = (window.screen.width / 2) - ((width / 2) + 10);
      //Allow for title and status bars.
      topPosition = (window.screen.height / 2) - ((height / 2) + 50);
      var windowFeatures = "status=no,height=" + height + ",width=" + width + ",resizable=yes,left=" + leftPosition + ",top=" + topPosition + ",screenX=" + leftPosition + ",screenY=" + topPosition + ",toolbar=no,menubar=no,scrollbars=no,location=no,directories=no";
      var d = $("[property='og:description']").attr("content");
      // var img = $("[property='og:image']").attr("content");
      // sharePopup('https://www.facebook.com/dialog/share?app_id=' + MartJack.Config.AppId + '&display=popup&href=' + u + '&title=' + t + '&picture=' + sharer_image + '&description=' + d);
      window.open('https://www.facebook.com/dialog/share?app_id=795786888261296&href=' + encodeURIComponent(u) + '&t=' + encodeURIComponent(t) + '&description=' + encodeURIComponent(d)+ '&picture=' + encodeURIComponent(sharer_image) + '','sharer', windowFeatures);
      return false;
   });
   $('#whatsapp_share').on('click',function()
   {
      var u = window.location.href;
      var leftPosition, topPosition;
      var width = 400;
      var height = 300;
      //Allow for borders.
      leftPosition = (window.screen.width / 2) - ((width / 2) + 10);
      //Allow for title and status bars.
      topPosition = (window.screen.height / 2) - ((height / 2) + 50);
      var windowFeatures = "status=no,height=" + height + ",width=" + width + ",resizable=yes,left=" + leftPosition + ",top=" + topPosition + ",screenX=" + leftPosition + ",screenY=" + topPosition + ",toolbar=no,menubar=no,scrollbars=no,location=no,directories=no";
      
      window.open('https://api.whatsapp.com/send?text=' + encodeURIComponent(u) + '','sharer', windowFeatures);
      return false;
   });
   
});
window.onload = function () 
{
   var cookie_pincode = getCookie("cookie_pincode");
   console.log('cookie get');
   console.log(cookie_pincode);
   if (cookie_pincode != "") 
   {
      $("#shipping_pincode").val(cookie_pincode);
      // $("#check_pincode").trigger('click');
      // $('#check_pincode').click();
      setTimeout(function() {
         check_shipping_pincode(cookie_pincode);
      }, 2500);
      
      console.log('cookie else set');
      console.log(cookie_pincode);
   }
   else
   {
      console.log('cookie not set');
      console.log(cookie_pincode);
   }
   
}

    
  </script>



@endsection
