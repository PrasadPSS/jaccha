<!--section-Shop by category-->
	<div class="container-fluidcustom one-pt" style="padding-top:{{ $homepagesection->padding_top }}rem;padding-bottom:{{ $homepagesection->padding_bottom }}rem;">
		<div class="row shop-categories">
			<div class="col-lg-12 col-md-12 col-sm-12 col-12">
				<h1 class="heading-underline">{{ isset($homepagesection->home_page_section_title)?$homepagesection->home_page_section_title:'SHOP BY CATEGORIES'}}</h1>
				<p>{{ isset($homepagesection->home_page_section_sub_title)?$homepagesection->home_page_section_sub_title:''}}</p>
			</div>
		</div>
      @if(isset($homepagesection->section_childs) && count($homepagesection->section_childs)>0)
      <div class="row shop-categories-row pt-4">
      @php $catcnt = 1; @endphp
        @foreach($homepagesection->section_childs as $section_child)
        <div class="col-lg col-sm col-12">
          <a class="img-hover " href="{{ $section_child->home_page_section_child_url }}"><img class="img-fluid  mb-2" src="{{ asset('backend-assets/uploads/home_page_section_child_images/'.$section_child->home_page_section_child_images) }}" alt="Img"></a>
        </div>
        @if(($catcnt % 5) == 0 && $catcnt < 15 )
          </div>
          <div class="row shop-categories-row pt-4">
        @endif
        @php $catcnt++; @endphp
        @endforeach
      @endif


    </div>
	</div>
<!--section-Shop by category end-->
