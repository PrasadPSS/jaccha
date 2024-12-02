<!--hdfc start <img class="img-fluid" src="{{ asset('frontend-assets/images/infologo.png') }}">-->
	<div class="container-fluidcustom hdfc" style="padding-top:{{ $homepagesection->padding_top }}rem;padding-bottom:{{ $homepagesection->padding_bottom }}rem;">
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-12">
						<div id="demo-hdfc" class="carousel slide" data-ride="carousel">
						  <!-- Indicators -->

						  <!-- The slideshow -->
						  <div class="carousel-inner hdfc-imgs">
                @if(isset($homepagesection->section_childs) && count($homepagesection->section_childs)>0)
                @php $slidercnt = 1; @endphp
                  @foreach($homepagesection->section_childs as $section_child)
                		<div class="carousel-item {{ $slidercnt==1?'active':'' }}">
							<a href="{{ $section_child->home_page_section_child_url }}">
                      			<img class="img-fluid w-100" src="{{ asset('backend-assets/uploads/home_page_section_child_images/'.$section_child->home_page_section_child_images) }}" alt="Img">
							</a>
                		</div>
                    @php $slidercnt++; @endphp
                  @endforeach
                @endif
						  </div>
						</div>
					</div>
				</div>
	</div>
<!--hdfc end-->
