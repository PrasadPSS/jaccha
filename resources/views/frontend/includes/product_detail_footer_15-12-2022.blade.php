@include('frontend.includes.dynamic_footer')

<!--  -->

<!--  -->

<script src="{{ asset('frontend-assets/js/jquery-3.4.0.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="{{ asset('frontend-assets/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('frontend-assets/js/back-to-top.js') }}"></script>
<script src="{{ asset('frontend-assets/js/mega-menu.js') }}"></script>
<script src="{{ asset('frontend-assets/js/product-quantity.js') }}"></script>
<script src="{{ asset('frontend-assets/js/toastr.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.Marquee/1.5.0/jquery.marquee.min.js"></script>
<!--<script type="text/javascript" src="//code.jquery.com/jquery-1.9.1.min.js"></script>-->
<script src="{{ asset('frontend-assets/js/cloudzoom.js') }}"></script>
<script src="{{ asset('frontend-assets/js/owl.carousel.min.js') }}"></script>


<!--<script src="{{ asset('frontend-assets/js/1_9_7_jquery.lazyload.js') }}"></script>-->
<!-- Call quick start function. -->
<script type="text/javascript">CloudZoom.quickStart();</script>
<script>
    (function($) {
        $(function() {
            var agMarqueeOptions = {
                duration: 20500,
                gap: 0,
                delayBeforeStart: 0,
                direction: 'left',
                duplicated: true,
                pauseOnHover: true,
                startVisible: true
            };
            $(document).ready(function() {
                var agMarqueeBlock = $('.js-marquee');
                agMarqueeBlock.marquee(agMarqueeOptions);
            });
        });
    })(jQuery);
</script>

<script>
    function openNav() {
        document.getElementById("collapsibleNavbar-two").style.display = "block";
    }
    function closeNav() {
        document.getElementById("collapsibleNavbar-two").style.display = "none";
    }
</script>
<script>
    $('.product-slider1').owlCarousel({
        loop: true,
        margin: 10,
        dots: false,
        nav: true,
        mouseDrag: true,
        autoplay: false,
        navSpeed: 1000,
        responsive: {
            0: {
                items: 1,
                slideBy: 1
            },
            600: {
                items: 2,
                slideBy: 1
            },
            1000: {
                items: 4,
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
<script>
    $(document).ready(function() {
        $(document).on('click', '.img-li', function(e) {
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
    });
    // window.onload = function() {
    //     if(!window.location.hash) {
    //         window.location = window.location + '#loaded';
    //         window.location.reload();
    //     }
    // }

</script>
