<!--section-DADREEIOS EXCLUSIVES-->
<div class="container-fluidcustom shop-categories-section one-pt-pb" style="padding-top:{{ $homepagesection->padding_top }}rem;padding-bottom:{{ $homepagesection->padding_bottom }}rem;">
		<div class="row shop-categories">
			<div class="col-lg-12 col-md-12 col-sm-12 col-12">
				<p class="heading-underline heading-sections">{{ isset($homepagesection->home_page_section_name)?$homepagesection->home_page_section_name:'DADREEIOS EXCLUSIVES'}}</p>
			</div>
		</div>
		<div class="row exclusive-padding py-4">
			@if(isset($homepagesection->section_childs) && count($homepagesection->section_childs)>0)
      @php $catcnt = 1; @endphp
        @foreach($homepagesection->section_childs as $section_child)
					<div class="col-lg-4 col-md-4 col-sm-4 col-12 mb-2 {{ ($catcnt==1||$catcnt==2||$catcnt==3)?'shop-categories-col':'' }}">
						<a href="{{ $section_child->home_page_section_child_url }}"><img class="img-fluid" src="{{ asset('backend-assets/uploads/home_page_section_child_images/'.$section_child->home_page_section_child_images) }}" alt="Img"></a>
					</div>
					@if($catcnt%3==0)
					</div>
					<div class="row">
					@endif
        @php $catcnt++; @endphp
        @endforeach
      @endif

		</div>

</div>
<!--section-DADREEIOS EXCLUSIVES end-->
