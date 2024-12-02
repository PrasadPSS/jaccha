<!-- section-collection start -->
	<div class="container-fluidcustom section-collection zero-pt-pb" style="padding-top:{{ $homepagesection->padding_top }}rem;padding-bottom:{{ $homepagesection->padding_bottom }}rem;">
		<div class="row collection">
			<div class="col-lg-12 col-md-12 col-sm-12 col-12">
				<p class="heading-sections heading-underline">{{ isset($homepagesection->home_page_section_title)?$homepagesection->home_page_section_title:''}}</p>
			</div>
		</div>
			<div class="row cart-row">
        @if(isset($homepagesection->section_childs) && count($homepagesection->section_childs)>0)
        @php $colcnt = 1; @endphp
          @foreach($homepagesection->section_childs as $section_child)
          @if(isset($section_child->visibility) && $section_child->visibility == 1)
            <div class="col-lg-4 col-md-4 col-sm-4 col-12 cart ">
              <div class="cart-items">
                <a href="{{ $section_child->home_page_section_child_url }}"><img class="img-fluid" src="{{ asset('backend-assets/uploads/home_page_section_child_images/'.$section_child->home_page_section_child_images) }}" alt="Img"></a>
              </div>
            </div>
          @endif
          @endforeach
        @endif

			</div>

	</div>
<!--section-collection end-->
