<!--section-info start-->
	<div class="container-fluidcustom info-padding" style="padding-top:{{ $homepagesection->padding_top }}rem;padding-bottom:{{ $homepagesection->padding_bottom }}rem;">
			<div class="row section-info">
        @if(isset($homepagesection->section_childs) && count($homepagesection->section_childs)>0)
        @php $gen_cnt = 1; @endphp
          @foreach($homepagesection->section_childs as $section_child)
            <div class="col-lg-6 col-md-6 col-sm-6 col-12">
              <div class="text-center info info-mb">
                <a href="{{ $section_child->home_page_section_child_url }}">
                  <img class="img-fluid w-100" src="{{ asset('backend-assets/uploads/home_page_section_child_images/'.$section_child->home_page_section_child_images) }}" alt="Img">
                </a>
              </div>
            </div>
          @endforeach
        @endif
			</div>
	</div>
<!--section-info end-->
