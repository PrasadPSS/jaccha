<!--section-COUPONS-->
<div class="container-fluidcustom section-bottom-padding" style="padding-top:{{ $homepagesection->padding_top }}rem;padding-bottom:{{ $homepagesection->padding_bottom }}rem;">
	<div class="row ">
    @if(isset($homepagesection->section_childs) && count($homepagesection->section_childs)>0)
    @php $slidercnt = 1; @endphp
      @foreach($homepagesection->section_childs as $section_child)
        <div class="col-lg-12 col-sm-12 col-md-12 col-12">
          <a href="{{ $section_child->home_page_section_child_url }}">
    		    <img class="img-fluid w-100 coupon-img" alt="Coupon img" src="{{ asset('backend-assets/uploads/home_page_section_child_images/'.$section_child->home_page_section_child_images) }}">
          </a>
    		</div>
        @php $slidercnt++; @endphp
      @endforeach
    @endif
	</div>
</div>
<!--section-COUPONS end-->
