@php
use App\Models\frontend\Categories;
use App\Models\backend\HeaderNotes;

$categories = Categories::get();
$header_notes = HeaderNotes::where('visibility',1)->get();
//echo "<pre>";print_r($categories);exit;
@endphp

<a id="return-to-top" href="javascript:" ><i class="fa fa-chevron-up"></i></a>


<section  class="fixed-top">
		<section class="top-header">
			<div class="container-fluidcustom">
				<div class="row divider">
					<div class="col-lg-1 dn top-column text-center">
						<a class="m-left " href="#"><i class="fa fa-mobile mr-2" aria-hidden="true"></i>DOWNLOAD APP</a>
					</div>

					<div class="col-lg-1 dn top-column text-center">
						<a href="#"><i class="fa fa-headphones mr-2" aria-hidden="true"></i>CUSTOMER CARE</a>
					</div>
					<div class="col-lg-6 dn top-column text-center ">

						<header class="ag-header">
<div class="ag-ticker-block">
<div class="ag-format-container">
<div class="ag-ticker_box-wrap">
<div class="ag-ticker_box">
 <div class="js-marquee">
	 <ul class="ag-ticker_list">
		 <li class="ag-ticker_item">
			 <a href="#" class="ag-ticker_link">
				 <div class="ag-ticker_category-item">Far far away</div>
				 <div class="ag-ticker_news-item">
					 Far-far beyond the verbal mountains in the country of vowels and consonants live fish texts
				 </div>
			 </a>
		 </li>

		 <li class="ag-ticker_item">
			 <a href="#" class="ag-ticker_link">
				 <div class="ag-ticker_category-item">Soul</div>
				 <div class="ag-ticker_news-item">
					 My soul is illumined with unearthly joy, like these wonderful spring mornings that I enjoy with
					 all my heart
				 </div>
			 </a>
		 </li>

		 <li class="ag-ticker_item">
			 <a href="#" class="ag-ticker_link">
				 <div class="ag-ticker_category-item">Gregor Zamza</div>
				 <div class="ag-ticker_news-item">
					 Waking up one morning after a restless sleep, Gregor Zamza discovered that in his bed he had
					 turned into a terrible insect
				 </div>
			 </a>
		 </li>

		 <li class="ag-ticker_item">
			 <a href="#" class="ag-ticker_link">
				 <div class="ag-ticker_category-item">Loving</div>
				 <div class="ag-ticker_news-item">
					 Loving, eat tongs - the mayor sighs, - the buzz is burning. Chef vzaryan tchk pliers with an
					 echo goodbye Jules
				 </div>
			 </a>
		 </li>

		 <li class="ag-ticker_item">
			 <a href="#" class="ag-ticker_link">
				 <div class="ag-ticker_category-item">Lorem</div>
				 <div class="ag-ticker_news-item">
					 Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor
				 </div>
			 </a>
		 </li>

		 <li class="ag-ticker_item">
			 <a href="#" class="ag-ticker_link">
				 <div class="ag-ticker_category-item">Aenean</div>
				 <div class="ag-ticker_news-item">
					 Aenean tellus metus, bibendum sed, posuere ac, mattis non, nunc
				 </div>
			 </a>
		 </li>
	 </ul>
 </div>
</div>
</div>
</div>
</div>
</header>
					<!-- <ul id="webTicker">
						@if(isset($header_notes))
						 @foreach($header_notes as $header_note)
						<li>{{ $header_note->header_note_text }}</li>
						@endforeach
					 @endif
					</ul> -->


						<!-- <div class="col-lg-6 dn top-column text-center"> -->
						<!-- <header class="ag-header">
							<div class="ag-ticker-block">
								<div class="ag-format-container">
									<div class="ag-ticker_box-wrap">
										<div class="ag-ticker_box">
											<div class="js-marquee">
												<ul class="ag-ticker_list">
													<li class="ag-ticker_item">
														<a href="#" class="ag-ticker_link">
															<div class="ag-ticker_news-item">
																ORDERS DELIVERIES MAY GET DELAYED DUE TO THE CURRENT COVID-19 SITUATION AND LOCKDOWN1.
															</div>
														</a>
													</li>
												</ul>
											</div>
										</div>
									</div>
								</div>
							</div>
						</header> -->

					                    <!-- </div> -->
															<!-- <div class="tickerwrapper">
																@if(isset($header_notes))
																 @foreach($header_notes as $header_note)
																 <ul class='list'>
																		<li class='listitem'>
																			{{ $header_note->header_note_text }}
																		</li>
																		@endforeach
																	 @endif
																</ul>
															</div> -->

											<!-- <div  id="outer">
											 <div id ="tick">
												 @if(isset($header_notes))
												 	@foreach($header_notes as $header_note)
												 		<li class="" > <a href="#">{{ $header_note->header_note_text }}</a></li>
												 	@endforeach
												 @endif
											  </div>
										 </div> -->

										 <!-- <div class="tcontainer">
											 <div class="ticker-wrap">
												 <div class="ticker-move">
													 @if(isset($header_notes))
													 	@foreach($header_notes as $header_note)
												  <div class="ticker-item">{{ $header_note->header_note_text }}</div>
													@endforeach
												 @endif
												</div>
											</div>
										</div> -->

										<!-- <ul  id="webTicker">
											@if(isset($header_notes))
												@foreach($header_notes as $header_note)
													<li> {{ $header_note->header_note_text }}</li>
												@endforeach
											@endif
										 </ul> -->

									</div>

					@if( auth()->check() )
						<div class="col-lg-1 col-3 top-column text-center">
							<a href="#"><span class="dn">Hi, {{ auth()->user()->name }}</span></a>
						</div>
						<div class="col-lg-1 col-3  top-column text-center">
							<a href="{{ url('/myaccount/profile') }}"><i class="fa fa-user-circle mr-2" aria-hidden="true"></i><span class="dn">YOUR ACCOUNT</span></a>
						</div>
					@else
						<div class="col-lg-1 col-3 top-column text-center">
							<a href="{{ url('/login') }}"><i class="fa fa-unlock-alt mr-2" aria-hidden="true"></i><span class="dn">LOGIN</span></a>
						</div>
						<div class="col-lg-1 col-3  top-column text-center">
							<a href="{{ url('/myaccount/profile') }}"><i class="fa fa-user-circle mr-2" aria-hidden="true"></i><span class="dn">YOUR ACCOUNT</span></a>
						</div>
					@endif

					<div class="col-lg-1 col-3  top-column text-center">
						<a  href="{{ url('/wishlists') }}"><span class="dn">YOUR</span><span class="heart"><i class="fa fa-heart mr-1 ml-1" aria-hidden="true"></i></span><span class="dn">WISHLIST</span></a>
					</div>

					<div class="col-lg-1 col-3 top-column text-center"><a class="cart-link" href="{{ url('/cart') }}"><i class="fa fa-cart-plus mr-2" aria-hidden="true"></i><span class="dn">CART</span></a>
					</div>
				</div>
			</div>
		</section>
<!--Topbar End-->

<!--Navigationbar start-->
<nav id="navigation1" class="navigation navbar navbar-expand-lg ">
			<div class="row navigationbar mx-0">
			<div class="col-lg-2 col-md-6 col-sm-6 col-12 left-pad-adj15">
			 <a class="navbar-brand" href="{{ url('/') }}"><img class="img-fluid" src="{{ asset('frontend-assets/images/logoparwani.png') }}" alt=""></a>
			 <button class="navbar-toggler text-center" onclick="openNav()" data-toggle="collapse" data-target="#collapsibleNavbar-two">
			<span class="navbar-toggler-icon text-dark"><i class="fa fa-bars" aria-hidden="true"></i></span>
			</button>
		</div>

			<div class="nav-menus-wrapper collapse navbar-collapse col-lg-6 col-md-5 col-sm-4 col-12 " id="collapsibleNavbar-two">
				<button class="close-menu-btn" onclick="closeNav()" ><i class="fa fa-times" aria-hidden="true"></i></button>
				<ul class="nav-menu m-auto ">
					@if($categories)
					@foreach($categories as $category)
					@if($category->has_subcategories == '1')
					<li class="menulink">
						@if(isset($category->text_color))
							<a class="sweep-to-bottom"  href="#">
								<span style="color:{{ $category->text_color }};">{{ $category->category_name }}</span>
							</a>
						@else
							<a class="sweep-to-bottom"  href="#">{{ $category->category_name }}</a>
						@endif
						@if(isset($category->subcategories))
						<div class="megamenu-panel container-fluidcustom">
							<div class="megamenu-lists">
								@foreach($category->subcategories as $subcategory)
								 <ul class="megamenu-list list-col-2">
										<li class="megamenu-list-title"><a href="#">{{ $subcategory->subcategory_name }}</a></li>
										@if(isset($subcategory->subsubcategories))
										@foreach($subcategory->subsubcategories as $subsubcategory)
											<li><a href="{{ url('s/') }}/{{ $category->category_slug }}/{{ $subcategory->sub_category_slug }}/{{ $subsubcategory->sub_sub_category_slug }}">{{ $subsubcategory->sub_subcategory_name }}</a></li>

										@endforeach
										<div class="view-color-div float-left"><a href="{{ url('s/') }}/{{ $category->category_slug }}/{{ $subcategory->sub_category_slug }}/" class="see-more mega-menu-view-color ">View More</a></div>
										@endif
								 </ul>
								 @endforeach
							</div>

						</div>
						@endif
					</li>
					@else

					@endif
				 @endforeach
				 @endif

				</ul>
			</div>

				<div class="col-lg-4 col-md-6 col-sm-6 col-12 right-pad-adj15 my-auto">
					<!-- <form class="input-group">
						<input class="search" type="text" placeholder="Search For Products, Categories & More.." aria-label="Search">
						<i class="fa fa-search" aria-hidden="true"></i>
					</form> -->
					<form class="input-group">
						<input class="search" type="text" placeholder="Search For Products, Categories &amp; More.." aria-label="Search">
						<button id="search-button" type="submit">
                <span><i id="search-btn" class="fa fa-search"></i></span>
            </button>
					</form>
				</div>
</div>
		</nav>
</section>
<!--Navigationbar end-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.webticker/3.0.0/jquery.webticker.min.js"></script>
<script>
	 $('#webTicker').webTicker();
</script>
