<!--section-Hot treand-->
	<div class="container-fluidcustom one-pt" style="padding-top:{{ $homepagesection->padding_top }}rem;padding-bottom:{{ $homepagesection->padding_bottom }}rem;">
		<div class="row shop-categories">
			<div class="col-lg-12 col-md-12 col-sm-12 col-12">
				<p class="heading-underline heading-sections">{{ isset($homepagesection->home_page_section_title)?$homepagesection->home_page_section_title:'HOT IN TRENDING'}}</p>
			</div>
		</div>
		<div class="row pt-2">
			@if(isset($homepagesection->section_childs) && count($homepagesection->section_childs)>0)

      @php $catcnt = 1; @endphp
        @foreach($homepagesection->section_childs as $section_child)
		@if(isset($section_child->visibility) && $section_child->visibility == 1)
					<div class="col-lg-3 col-md-3 col-sm-3 col-6">
						<div class="product-section mb-4" >
							<a href="{{ $section_child->home_page_section_child_url }}" ><img class="img-fluid" src="{{ asset('backend-assets/uploads/home_page_section_child_images/'.$section_child->home_page_section_child_images) }}" alt="Img"></a>

							<div class="product-info">
								<p style="font-size:18px;font-weight:500!important;">{{ isset($section_child->home_page_section_child_footer_title)?$section_child->home_page_section_child_footer_title:''}}</p>
								<p>{{ isset($section_child->home_page_section_child_footer_sub_title)?$section_child->home_page_section_child_footer_sub_title:''}}</p>
								<a class="product-more" href="{{ $section_child->home_page_section_child_url }}">+ Explore more...</a>
							</div>
						</div>
					</div>
		@endif
        @php $catcnt++; @endphp
        @endforeach
      @endif
		</div>
	</div>
<!--section-Hot treand end-->