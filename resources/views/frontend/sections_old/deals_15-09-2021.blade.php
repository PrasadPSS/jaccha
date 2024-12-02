<!--section-Todays special-->
<div class="container-fluidcustom one-pt" style="padding-top:{{ $homepagesection->padding_top }}rem;padding-bottom:{{ $homepagesection->padding_bottom }}rem;">
		<div class="row special-deals ">
			<div class="col-lg-12 col-md-12 col-sm-12 col-12">
				<h1 class="heading-underline-deals">{{ isset($homepagesection->home_page_section_title)?$homepagesection->home_page_section_title:'TODAY’S SPECIAL DEALS'}}</h1>
			</div>
		</div>
		</div>
<div class="container-fluidcustom special-deals-timer pt-4">
		<div class="row shop-now-index row-bg">
			@if(isset($homepagesection->section_childs[0]))
			<div class="col-lg-3 col-md-3 col-sm-3 col-12  ">
					<a href="{{ $homepagesection->section_childs[0]->home_page_section_child_url }}" ><img src="{{ asset('backend-assets/uploads/home_page_section_child_images/'.$homepagesection->section_childs[0]->home_page_section_child_images) }}" class="img-fluid" alt=""></a>
					<!--<div class="img-text">-->
					<!--	<p><span>HAND</span>-PICKED</p>-->
					<!--</div>-->
			</div>
			@endif
			<div class="col-lg-6 my-auto col-md-6 col-sm-6 col-12 text-center timer-p">
				<h1 class="timer-heading">{{ isset($homepagesection->home_page_section_sub_title)?$homepagesection->home_page_section_sub_title:''}}</h1>
						<div class="row no-gutters">
							<div class="col-lg-2 col-md col-sm-1 col-12">
								<input type="hidden" name="deals_date" id="deals_date" value="{{ isset($homepagesection->home_page_section_end_date)?$homepagesection->home_page_section_end_date:''}}">
							</div>
							<div class="col-lg-8 col-md-12 col-sm-12 col-12">
								<div class="row timer no-gutters" id="clockdiv">
									<div class="col-lg-2 col-md-2 col-2 m-auto ">
										<div class="timer__container">
										<span id="days" class="days">0</span>
											<div class="smalltext">Days</div>
										</div>
									</div>
									<div class="col-lg-1 col-md-1 col-1 divider-col p-0">
										<span>:</span>
									</div>
									<div class="col-lg-2 col-md-2 col-2 m-auto">
										<div class="timer__container">
										<span id="hours" class="hours">0</span>
											<div class="smalltext">Hours</div>
										</div>
									</div>
									<div class="col-lg-1 col-md-1 col-1 divider-col p-0">
										<span>:</span>
									</div>
									<div class="col-lg-2 col-md-2 col-2 m-auto">
										<div class="timer__container">
										<span id="minutes" class="minutes">0</span>
											<div class="smalltext">Minutes</div>
										</div>
									</div>
									<div class="col-lg-1 col-md-1 col-1 divider-col p-0">
										<span>:</span>
									</div>
									<div class="col-lg-2 col-md-2 col-2 m-auto">
										<div class="timer__container">
										<span id="seconds" class="seconds">0</span>
											<div class="smalltext">Seconds</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-2 col-md ">

							</div>
						</div>
					<h4 class="shop-now-description">{{ isset($homepagesection->home_page_section_footer_title)?$homepagesection->home_page_section_footer_title:''}}</h4>
				<h5 class="shop-now-description2">{{ isset($homepagesection->home_page_section_footer_sub_title)?$homepagesection->home_page_section_footer_sub_title:''}}</h5>
				<div class="shop-now">
					<a class="shop-now-btn" href="{{ url('/deals') }}">SHOP NOW</a>
				</div>
			</div>
			@if(isset($homepagesection->section_childs[1]))
			<div class="col-lg-3 col-md-3 col-sm-3 col-12 ">
					<a href="{{ $homepagesection->section_childs[0]->home_page_section_child_url }}" ><img src="{{ asset('backend-assets/uploads/home_page_section_child_images/'.$homepagesection->section_childs[0]->home_page_section_child_images) }}" class="img-fluid" alt=""></a>
					<!--<div class="img-text">-->
					<!--	<p><span>HAND</span>-PICKED</p>-->
					<!--</div>-->
			</div>
			@endif
		</div>
</div>

<!--section-Todays special end-->
