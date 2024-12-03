<!--section-ads start-->
<div class="container-fluidcustom  one-pt-pb" style="padding-top:{{ $homepagesection->padding_top }}rem;padding-bottom:{{ $homepagesection->padding_bottom }}rem;">
	<div class="row ">
		@if(isset($homepagesection->section_childs) && count($homepagesection->section_childs)>0)
		<div class="col-lg-4 col-md-4 col-sm-4 col-12 text-center ">
			@php $adcnt = 1; @endphp
			@foreach($homepagesection->section_childs as $section_child)
			@if(isset($section_child->home_page_section_child_images))
			@if(isset($section_child->visibility) && $section_child->visibility == 1) 
			<div class="{{ ($adcnt==1 || $adcnt==4 || $adcnt == 5)?'img-height1':'img-height2' }} mt-4 ads-mobile-spacing-adjustment section-img {{ ($adcnt==2 || $adcnt==6)?'pt-2 mt-4':'' }} {{ ($adcnt==4)?' ':'' }}" style="">
				<a href="{{ $section_child->home_page_section_child_url }}">
					<img class="img-fluid" src="{{ asset('backend-assets/uploads/home_page_section_child_images/'.$section_child->home_page_section_child_images) }}" alt="Img">
				</a>
			</div>
			@endif
			@else
			@php
			$path = parse_url($section_child->home_page_section_child_video_url, PHP_URL_PATH);

			// Get the video ID, which is the basename of the URL path
			$videoId = basename($path);
			//$section_child->home_page_section_child_video_url
			@endphp
			@if(isset($section_child->visibility) && $section_child->visibility == 1)
			<div class="img-height2 mt-4 section-img"> 
				<iframe class=" youtube w-100" src="https://www.youtube.com/embed/{{ $videoId }}" height="100%" width="100%" title="Dadreeios" allowfullscreen></iframe>
			</div>
			@endif
			@endif
			@if($adcnt%2 == 0)
		</div>
		<div class="col-lg-4 col-md-4 col-sm-4 col-12 ">
			@endif

			@php $adcnt++; @endphp
			@endforeach
		</div>
		@endif
		<!-- <div class="col-lg-4 col-md-4 col-sm-4 col-12 text-center">
				<div class="img-height1 mb-4">
					<img class="img-fluid" src="{{ asset('frontend-assets/images/category/category5.jpg') }}" alt="Img">
				</div>

				<div class="img-height2 pt-2">
					<img class="img-fluid" src="{{ asset('frontend-assets/images/category/category1.jpg') }}" alt="Img">
				</div>
			</div> -->
		<!-- <div class="col-lg-4 col-md-4 col-sm-4 col-12">
				<div class="img-height2">
					<iframe class=" youtube w-100" src="https://www.youtube.com/embed/NrmMk1Myrxc" allowfullscreen></iframe>
					</div>
				<div class="img-height1 mt-4">
					<img class="img-fluid" src="{{ asset('frontend-assets/images/category/category5.jpg') }}" alt="Img">
				</div>
			</div> -->
		<!-- <div class="col-lg-4 col-md-4 col-sm-4 col-12">
				<div class="img-height1 mb-4">
					<img class="img-fluid " src="{{ asset('frontend-assets/images/category/category5.jpg') }}" alt="Img">
				</div>

				<div class="img-height2 pt-2">
					<img class="img-fluid w-100" src="{{ asset('frontend-assets/images/category/category3.jpg') }}" alt="Img">
				</div>
			</div> -->
	</div>
</div>

<!--section-ads end-->