@php

use App\Models\backend\FeaturedProducts;
use App\Models\backend\Products;

$homepagefeaturedproducts = FeaturedProducts::all();

@endphp
<!--section-tab-->
	<div class="container-fluidcustom" style="padding-top:{{ $homepagesection->padding_top }}rem;padding-bottom:{{ $homepagesection->padding_bottom }}rem;">
		<div class="best-new-recommended-section">
			<div class="row best-new-recommended section-tab">
				<ul class="nav nav-pills">
					@if(isset($homepagefeaturedproducts) && count($homepagefeaturedproducts)>0)
		      @php $slidercnt = 1; @endphp
		        @foreach($homepagefeaturedproducts as $section_child)
							<li><a class="btn {{ $slidercnt==1?'active':'' }}" data-toggle="pill" href="#{{ $section_child->home_page_featured_product_code }}">{{ $section_child->home_page_featured_product_name }}</a></li>
		          @php $slidercnt++; @endphp
		        @endforeach
		      @endif
			    </ul>
			</div>
		</div>
	</div>
		<div class="container-fluidcustom tab-content pt-4">
			@if(isset($homepagefeaturedproducts) && count($homepagefeaturedproducts)>0)
			@php $sliderchcnt = 1; @endphp
				@foreach($homepagefeaturedproducts as $section_child)
					@php
						$product_ids = explode(',',$section_child->product_id);
						$products = Products::whereIn('product_id',$product_ids)->get();
						//dd($products);
					@endphp
					<div id="{{ $section_child->home_page_featured_product_code }}" class="row tab-pane  {{ $sliderchcnt==1?'active':'fade' }}">
						<div class="col-lg-12">
							<div class="owl-carousel  owl-theme product-slider">
								@if(isset($products) && count($products)>0)
									@foreach($products as $product)
									<a href="{{ url('dp/') }}/{{ $product->category_slug }}/{{ $product->sub_category_slug }}/{{ $product->sub_sub_category_slug }}/{{ $product->product_slug }}">
										 <div class="item">
											 <div class=" card ">
													<div class="container1">
														 <img class="img-fluid img-border-bottom" src="{{ asset('backend-assets/uploads/product_images/') }}/{{ isset($product->product_images[0])?$product->product_images[0]->image_name:'' }}" alt="Img">
														 <div class="pro-details">
																<p class="pro-name mb-0"> @if(isset($product->brands->brand_name)){{ $product->brands->brand_name }} @endif</p>
																<p class="pro-style mb-0 ">{{ $product->product_title }}</p>
															 	<p class="pro-price-details mb-0">
																	@if($product->product_discounted_price!=null && $product->product_discount!=0)
																		<span class="price mr-2">₹ {{ $product->product_discounted_price }}</span>
																		<span class="mrp-cut mr-2">₹ {{ $product->product_price }}</span>
																	@elseif($product->product_discounted_price!=null && $product->product_discount==0)
									                  <span class="price mr-2">₹ {{$product->product_discounted_price}}</span>
										              @else
									                  <span class="price mr-2">₹ {{$product->product_price}}</span>
										              @endif
																	@if($product->product_discount_type!=null && $product->product_discount_type=='percent' && $product->product_discount!=0)
										                <span class="discount">({{$product->product_discount}}% OFF)</span>
										              @elseif($product->product_discount_type!=null && $product->product_discount_type=='flat' && $product->product_discount!=0)
										                <span class="discount">(₹ {{$product->product_discount}} OFF)</span>
										              @endif
													 			</p>
													 		</div>




												 </div>
											 </div>
											 <div class="img-text">
						 						<p><span>HAND</span>-PICKED</p>
						 					</div>

										 </div>
										 </a>
					 				@endforeach
					 			@endif

							</div>
						</div>
					</div>
					@php $sliderchcnt++; @endphp
				@endforeach
			@endif

		</div>
<!--section-tab end-->
