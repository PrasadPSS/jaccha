@include('frontend.includes.dynamic_footer')

<!--  -->

<!--  -->

		<!--<script src="https://code.jquery.com/jquery-3.4.0.min.js" integrity="sha384-JUMjoW8OzDJw4oFpWIB2Bu/c6768ObEthBMVSiIx4ruBIEdyNSUQAjJNFqT5pnJ6" crossorigin="anonymous"></script>-->
		<!-- <script src="{{ asset('frontend-assets/js/jquery-1.9.1.js') }}"></script> -->
		<script src="{{ asset('frontend-assets/js/zoomsl.js') }}"></script>
		<!-- <script src="{{ asset('frontend-assets/js/script.js') }}"></script> -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
		<script src="{{ asset('frontend-assets/js/bootstrap.min.js') }}"></script>
		<script type="text/javascript" src="{{ asset('frontend-assets/js/back-to-top.js') }}"></script>
		<script src="{{ asset('frontend-assets/js/mega-menu.js') }}"></script>
		<script src="{{ asset('frontend-assets/js/owl.carousel.min.js') }}"></script>
		<script src="{{ asset('frontend-assets/js/product-quantity.js') }}"></script>
		<script src="{{ asset('frontend-assets/js/toastr.min.js') }}"></script>
<!-- <script src="{{ asset('frontend-assets/js/script.js') }}"></script> -->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.Marquee/1.5.0/jquery.marquee.min.js"></script>
		
		 <script src="https://rawgit.com/intoro/Lazy_Load_JQuery/master/js/1_9_7_jquery.lazyload.js"></script> 
		<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.pjax/1.9.6/jquery.pjax.min.js"></script> -->
		<!-- <script src="https://cdn.jsdelivr.net/npm/pjax/pjax.js"></script> -->
		<!-- <script src="https://raw.githubusercontent.com/defunkt/jquery-pjax/master/jquery.pjax.js"></script> -->
		<!-- <script src="{{ asset('frontend-assets/js/jquery.pjax.js') }}"></script> -->
		<!-- pjax -->
		<!-- <script>
		    $(document).pjax('a', '#pjax-container');
		    $(document).on("pjax:timeout", function(event) {
		        // Block the timeout causing the link jump event to occur
		        event.preventDefault()
		    });
		</script> -->
		<script>
		(function ($) {
		$(function () {
				var agMarqueeOptions = {
					duration: 20500,
					gap: 0,
					delayBeforeStart: 0,
					direction: 'left',
					duplicated: true,
					pauseOnHover: true,
					startVisible: true
				};
				 $(document) .ready( function () {
					var agMarqueeBlock = $('.js-marquee');
					agMarqueeBlock.marquee(agMarqueeOptions);
				});
		});
		})(jQuery);
		</script>

	<script>
      $(document).ready(function () {
          $(".block__pic").imagezoomsl({
              zoomrange: [5, 5]
          });
        //   window.stop();
      });
      </script>



      <script>
         function openNav(){
         document.getElementById("collapsibleNavbar-two").style.display = "block";
         }
         function closeNav() {
          document.getElementById("collapsibleNavbar-two").style.display = "none";
         }
      </script>

      <script>
         $('.product-slider1').owlCarousel({
             loop:true,
             margin:10,
             dots:false,
             nav:true,
             mouseDrag:true,
             autoplay:false,
             navSpeed: 1000,
             responsive:{
                 0:{
                     items:1,
            slideBy: 1
                 },
                 600:{
                     items:2,
            slideBy: 1
                 },
                 1000:{
                     items:4,
            slideBy: 1
                 }
             }
         });
      </script>
      <!-- View more and less  -->
      <script>
         $(document).ready(function() {
         $("#toggle").click(function() {
           var elem = $("#toggle").text();
           if (elem == "View More Info") {
             //Stuff to do when btn is in the read more state
             $("#toggle").text("View Less Info");
             $("#text").slideDown();
           } else {
             //Stuff to do when btn is in the read less state
             $("#toggle").text("View More Info");
             $("#text").slideUp();
           }
         });
         });
      </script>

      <script >
				$(document).ready(function() {
				 $(document).on('click','.img-li',function (e) {
				     e.preventDefault();
				     $('.img-li img').removeClass('active1');
				     $(this).find('.img-hover-shadow').addClass('active1');

				 });
				});
				</script>

<!-- hide show See All Reviews -->
    <script>
      $(document).ready(function() {
      $(".see-all-reviews-content").click(function() {
        var elem = $(".see-all-reviews-content").text();
        if (elem == "See All Reviews") {
          //Stuff to do when btn is in the read more state
          $(".see-all-reviews-content").text("View Less Reviews");
          $("#target-see-all-reviews").slideDown();
        } else {
          //Stuff to do when btn is in the read less state
          $(".see-all-reviews-content").text("See All Reviews");
          $("#target-see-all-reviews").slideUp();
        }
      });

	    // $(document).pjax('.color_box_checked', '#main');
			// $(document).on('pjax:start', function() {
			// 	alert('test3');
			// 	$(this).addClass('loading')
			// });
			// $(document).on('pjax:end', function() {
			// 	$(this).removeClass('loading')
			// });
      });
    </script>
