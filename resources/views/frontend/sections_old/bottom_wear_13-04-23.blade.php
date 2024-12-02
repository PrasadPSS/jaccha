<!--section-EXPLORE TOP WEAR-->
<div class="container-fluidcustom one-pt" style="padding-top:3rem;padding-bottom:{{ $homepagesection->padding_bottom }}rem;">
		<div class="row shop-categories pt-4 row-bg">
			<div class="col-lg-12 col-md-12 col-sm-12 col-12 pb-4">
				<p class="heading-underline heading-sections">{{ isset($homepagesection->home_page_section_title)?$homepagesection->home_page_section_title:'EXPLORE BOTTOM WEAR'}}</p>
			</div>
		</div>

		<div class="row  row-bg pb-4">
			@if(isset($homepagesection->section_childs) && count($homepagesection->section_childs)>0)
      @php $catcnt = 1; @endphp
        @foreach($homepagesection->section_childs as $section_child)
					<div class="col-lg-3 col-md-3 col-sm-3 col-12 pb-4 @if($loop->iteration==1||$loop->iteration==2||$loop->iteration==3||$loop->iteration==4) pb-4 @endif">
						<div class="explore-product">
							<a href="{{ $section_child->home_page_section_child_url }}"><img class="img-fluid w-100" src="{{ asset('backend-assets/uploads/home_page_section_child_images/'.$section_child->home_page_section_child_images) }}" alt="Img"></a>

							</div>
							<div class="explore-info">
								<h3 class="text-center">{{ isset($section_child->home_page_section_child_footer_title)?$section_child->home_page_section_child_footer_title:''}}</h3>
								<p class="text-center">{{ isset($section_child->home_page_section_child_footer_sub_title)?$section_child->home_page_section_child_footer_sub_title:''}}</p>
							</div>
					</div>

        @php $catcnt++; @endphp
        @endforeach
      @endif

		</div>


</div>
<!--section-EXPLORE TOP WEAR end-->
