<!--Banner Start-->
	<div class="container-fluidcustom one-pb" style="padding-top:{{ $homepagesection->padding_top }}rem;padding-bottom:{{ $homepagesection->padding_bottom }}rem;">
		<div class="row banner">
			<div class="col-lg-12 col-md-12 col-sm-12 col-12">
				<div id="demo-banner" class="carousel slide" data-ride="carousel">
				  <!-- The slideshow -->
				  <div class="carousel-inner">
            @if(isset($homepagesection->section_childs) && count($homepagesection->section_childs)>0)
            @php $slidercnt = 1; @endphp
              @foreach($homepagesection->section_childs as $section_child)
			  @if(isset($section_child->visibility) && $section_child->visibility == 1)            
            		<div class="carousel-item {{ $slidercnt==1?'active':'' }}">
            			<a href="{{ $section_child->home_page_section_child_url }}">
                  			<img class="img-fluid w-100" src="{{ asset('backend-assets/uploads/home_page_section_child_images/'.$section_child->home_page_section_child_images) }}" alt="Img">
                		</a>
            		</div>
				@endif
                @php $slidercnt++; @endphp
              @endforeach
            @endif
				  </div>
				  <!-- Left and right controls -->
				  <a class="prev-arrow" id="prev" href="#demo-banner" data-slide="prev">
				   <i class="arrow left"></i>
				  </a>
				  <a class="next-arrow" id="next" href="#demo-banner" data-slide="next">
				   <i class="arrow right"></i>
				  </a>
				</div>
			</div>
		</div>
	</div>
<!-- Banner End -->
