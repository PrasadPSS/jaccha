<!-- Slider <img src="{{ asset('frontend-assets/images/slider/banner-4.jpg') }}" class="img-fluid" alt="Slider-2">-->
  <div class="container-fluidcustom" style="padding-top:{{ $homepagesection->padding_top }}rem;padding-bottom:{{ $homepagesection->padding_bottom }}rem;">
	<div id="demo" class="carousel slide" data-ride="carousel">
	  <!-- The slideshow-->
	  <div class="carousel-inner main-slider">
      @if(isset($homepagesection->section_childs) && count($homepagesection->section_childs)>0)
      @php $slidercnt = 1; @endphp
        @foreach($homepagesection->section_childs as $section_child)
      		<div class="carousel-item {{ $slidercnt==1?'active':'' }}">
			  @if(isset($section_child->visibility) && $section_child->visibility == 1) 
      			<a href="{{ $section_child->home_page_section_child_url }}">
      				 <img src="{{ asset('backend-assets/uploads/home_page_section_child_images/'.$section_child->home_page_section_child_images) }}" class="img-fluid w-100 h-100" alt="Slider-1">
      			</a>
			  @endif
      		</div>
          @php $slidercnt++; @endphp
        @endforeach
      @endif
	  </div>
	  <!-- Left and right controls<a href="#" target="_blank">-->
	  <a class="prev-arrow" id="prev" href="#demo" data-slide="prev">
	   <i class="arrow left"></i>
	  </a>
	  <a class="next-arrow" id="next" href="#demo" data-slide="next">
	   <i class="arrow right"></i>
	  </a>
	</div>
  </div>
<!--Slider end-->
