@extends('frontend.layouts.product')
@if(isset($product_listing_title) && $product_listing_title !="")
@section('title', $product_listing_title)
@endif
@section('title','Product List')
@section('content')

<!-- filter menu for mobile view start -->
<div class="sticky-filter top-padding">
  <div class="one-fourth" id="filters">
    <button id="show-hidden-filter" class="sticky-filter-sort-btn w-100 triggerSidebar" type="button" name="button">Filters</button>
  </div>
  <div class="one-fourth" id="sortby">
    <button id="show-hidden-sort" class="sticky-filter-sort-btn w-100 triggerSidebar1" type="button" name="button1">Sort By</button>
  </div>
</div>
<!-- filter menu for mobile view start -->
<!-- sort by section start -->
@if(true)
<input type="hidden" name="category_slug" value="{{$category_slug}}" id="category_slug">
<input type="hidden" name="sub_category_slug" value="{{$sub_category_slug}}" id="sub_category_slug">
<input type="hidden" name="sub_sub_category_slug" value="{{$sub_sub_category_slug}}" id="sub_sub_category_slug">
<input type="hidden" name="search_query" value="{{$search_query}}" id="search_query">
@endif
<div id="loader-wrapper">
  <div id="loader"></div>

  <div class="loader-section section-left"></div>
  <div class="loader-section section-right"></div>

</div>
<div class="container-fluidcustom top-padding ">

  <div class="row sortyby-section no-gutters sidebar-sortby">
    <div class="col-lg-12 col-sm-12 col-md-12 col-12 ">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item overview-list-subhead"><a href="{{url('/')}}">Home</a></li>
          @if(isset($breadcrumb) && strlen($breadcrumb)>0)
          {!! $breadcrumb !!}
          @endif
        </ol>
      </nav>
    </div>
    <div class="col-lg-10 col-sm-12 col-md-12 col-12 ">
      @if(isset($search) && strlen($search)>0)
      @if($search_flag)
      <h4 id="page_title_count_search">Search Result for <!-- : --> "{!!$search!!}"<span class="product-count" id="product-count"> ({{$product_count}})</span></h4>
      @else
      <h1 id="page_title_count">{!!$search!!}<span class="product-count" id="product-count"> ({{$product_count}})</span></h1>
      @endif
      @endif
    </div>
    <div class="col-lg-2 col-sm-12 col-md-12 col-12 sort-filter-section hidden-sort sidebar1">
      <a href="#" class="hideSidebar1"><i class="fa fa-times" aria-hidden="true"></i></a>

      <div class="center" id="sort_order">
        <select name="sources" id="sources" class="custom-select sources " placeholder="{{$sort_by_options[$sort_order]}}">
          @foreach($sort_by_options as $sort_key=>$sort_option)
          <option value="{{$sort_key}}" @if($sort_order==$sort_key)selected @endif>{{$sort_option}}</option>
          @endforeach
        </select>
      </div>
      <span class="sort-by ">Sort By: </span>
    </div>
  </div>
</div>
<!-- sort by section end -->

<!-- Product images section start -->
<div class="container-fluidcustom ">
  <div class="row product-filter-section sidebar-filter">
    <!-- filter section start -->
    <div class="col-xl-2 col-lg-3 filter-section hidden-filter pb-2 sidebar">
      <a href="#" class="hideSidebar"><i class="fa fa-times" aria-hidden="true"></i></a>
      <div class="filter-section-style">
        <div class="filter-section-div">
          <div class="row ">
            <div class="col-lg-6 col-md-6 col-sm-6 col-6 m-auto">
              <div class="filter-h4">
                <h4>FILTERS</h4>
              </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-6">
              <button class="reset-btn " id="reset-filters" type="button" name="button"><span class="btn-text">RESET</span></button>
            </div>
          </div>

          @if(isset($search) && strlen($search)>0 && $search_flag)
          <div class="row pt-2">
            <div class="col-lg-12 col-md-12 col-sm-12 col-12 m-auto">
              <div class="style-checkbox">
                <label class="style">
                  <span class="gender-bold checkbox-text">Men</span>
                  <input type="radio" name="filter_gender" value="1" class="filter_ filter_gender" @if(isset($_REQUEST["gender"]) && $_REQUEST["gender"]==1)checked @endif>
                  <span class="checkmark"></span>
                </label>
                <label class="style">
                  <span class="gender-bold checkbox-text">Women</span>
                  <input type="radio" name="filter_gender" value="2" class="filter_ filter_gender" @if(isset($_REQUEST["gender"]) && $_REQUEST["gender"]==2)checked @endif>
                  <span class="checkmark"></span>
                </label>
              </div>
            </div>
          </div>
          @endif
          <div id="filter_list">
            @if(isset($filters) && count($filters)>0)
            @include('frontend.product.product_filters')
            @endif
          </div>

          <div class="mobile-apply-section">
            <hr class="filter-hr">
            <div class="row ">
              <div class="col-12 text-center">
                <div class="mobile-apply-btn">
                  <a href="viewlist.blade.php">Apply</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
    <!-- </div> -->
    <!-- </div> -->
    <!-- filter section end -->
    <!-- dhdkjfhdkjfhfkgj -->

    <!-- product list section start -->
    <div class="col-xl-10 col-lg-9 col-md-12 col-sm-12 col-12 product-list-images">
      <!-- @if ($message = Session::get('success'))
              <div class="alert alert-success">
                  <p>{{ $message }}</p>
              </div>
          @endif -->
      <!-- @include('frontend.includes.errors') -->

      <!-- <br/> -->
      <div class="row product-list-page product_top-spc" id="listing_container">
        @include('frontend.product.product_card')
      </div>

      <!-- Pagination  -->
      <section>
        <div class="row text-center">
          <div class="col-lg-12 col-md-12 col-sm-12 col-12 my-auto">
            <div class="page-bg">
              <ul class="pagination">
                {{ $products->links('frontend.pagination.custom') }}
              </ul>
            </div>
          </div>
        </div>
      </section>
      
      
      {{-- contents from backend --}}
      <section>

        <div class="row pt-4 ">
          <div class="col-md-7" id="content_prod">
            @if(!empty($content_prod->contents))
            <div id="contents" class="contents_toggle">
              {!! $content_prod->contents !!}
            </div>
            <section class="mt-2">
              <p id="btn" class="view_more_btn"></p>
            </section>
            @endif
          </div>
          <div class="col-md-5">
            @if(!$product_list->isEmpty())
            <table class="table table-bordered " style="font-size:12px">
              <thead>
                <tr>
                  <td>{!!$search!!}</td>
                  <td style="width:80px;">Best Price</td>
                </tr>
              </thead>

              <tbody>
                {{-- {{dd($product_list->toArray())}} --}}

                @foreach($product_list as $class)

                <tr>
                  <td class="text-danger"><a href="{{ url('dp/') }}/{{ $class->category_slug }}/{{ $class->sub_category_slug }}/{{ $class->sub_sub_category_slug }}/{{ $class->product_slug }}" target="_blank" style="color:red;">{{$class->product_title}}</a></td>
                  <td>₹ {{$class->product_discounted_price}}</td>
                </tr>
                @endforeach

              </tbody>

            </table>
            @endif
            @if(!empty($content_prod->content_date))
            <p style="font-size:12px;">This Data was Last Updated on {!! date('F d, Y', strtotime($content_prod->content_date)) !!}</p>
            @endif
          </div>

        </div>
      </section>

      <!-- </div> -->





      <!-- Suggestbox -->
      <section class="py-5">
        <div class="row ">
          <div class="col-lg-6">
            <div class="suggest-head">
              <p>Suggest us how we can improve more...</p>
            </div>
            <form action="{{route('suggestion')}}" method="post">
              @csrf

              <div class="text-suggest pb-4">
                <textarea class="suggest-box w-100" name="message" rows="8" placeholder="Your suggestions are very important for us. Please feel free to tell us what you want?" required></textarea>
              </div>
              <button class="suggest-btn " type="submit" name="button"><span class="btn-text">SUBMIT</span></button>
            </form>
          </div>
        </div>
      </section>
      <!-- Suggestbox end-->
    </div>
    <!-- product list section end -->
  </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

<script>
  $(document).ready(function() {
    $('#show-hidden-filter').click(function() {
      $('.hidden-filter').slideToggle("slow");
      // Alternative animation for example
      // slideToggle("fast");
    });
  });
</script>

<script>
  $(document).ready(function() {
    $('#show-hidden-sort').click(function() {
      $('.hidden-sort').slideToggle("slow");
      // Alternative animation for example
      // slideToggle("fast");
    });
  });
</script>



<script>
  $(document).ready(function() {
    $('.triggerSidebar').click(function() {
      // $('.sidebar').css('top', '160px')

      $('body').css('overflow', 'hidden')
    })
    var filter = function() {
      $('.sidebar').css('display', 'none')
    }
    $('.hideSidebar').click(filter)

    $('.triggerSidebar1').click(function() {
      $('body').css('overflow', 'hidden')
    })
    var sortby = function() {
      $('.sidebar1').css('display', 'none')

    }
    $('.hideSidebar1').click(sortby)
    // $('.overlay').click()

    $('.addtowishlist').on('click', function() {
      auth = '{{Auth()->user()}}';
      if (!auth) {
        alert('Please login before adding product to Wishlist !');
        return;
      }
      var product = $(this).closest('.wishlistbox').find('.product_id');
      var product_id = product.val();
      console.log(product);
      if (product_id) {
        $.ajax({
          url: '{{url("/wishlists/addtowishlist")}}',
          type: 'post',
          data: {
            product_id: product_id,
            _token: "{{ csrf_token() }}",
          },
          success: function(data) {
            //console.log(data);
            // $('#color_name').text(data);
            alert(data[1]);
          },
          error: function(data) {
            console.log(data);
            alert(data[1]);
          }
        });
      }
    });
    // alert('test');
    // products('new');
    // $(document).on('click','#sort_order, .filter_check',function()
    var typingTimer = null; //timer identifier
    var doneTypingInterval = 800; //time in ms (1 seconds)
    $(document).on('input', "#low-price, #high-price", function() {
      var low_price = $('#low-price').val();
      var high_price = $('#high-price').val();
      var rangeSlider = document.getElementById('slider-range');
      clearTimeout(typingTimer);
      typingTimer = setTimeout(function() {
        if (rangeSlider != undefined) {
          rangeSlider.noUiSlider.set([low_price, high_price]);
        }
      }, doneTypingInterval);
    });
    $(document).on('mouseup', ".noUi-handle-lower, .noUi-handle-upper", function() {
      console.log('in drag');
      var sort_order = $('#sources').val();
      var filter_check = [];
      var filter_names = [];
      var searchstring = '';
      var price_array = [];
      var low_price = $('#low-price').val();
      var high_price = $('#high-price').val();
      $('input[name="filter_check"]:checked').each(function(index) {
        var category_name = $(this).data('category');
        var filter_name = $(this).data('name');
        // console.log(category_name);

        if (Array.isArray(filter_names[category_name]) && filter_names[category_name].length > 0) {
          var cat_cnt = filter_names[category_name].length;
          filter_check[index] = this.value;
          filter_names[category_name][cat_cnt] = filter_name;
        } else {
          filter_check[index] = this.value;
          filter_names[category_name] = [];
          filter_names[category_name][0] = filter_name;

        }
      });
      // console.log(filter_names);
      var category_slug = $('#category_slug').val();
      var sub_category_slug = $('#sub_category_slug').val();
      var sub_sub_category_slug = $('#sub_sub_category_slug').val();
      price_array = [low_price, high_price];
      // console.log(price_array);
      clearTimeout(typingTimer);
      typingTimer = setTimeout(function() {
        products(sort_order, category_slug, sub_category_slug, sub_sub_category_slug, filter_check, filter_names, null, null, price_array);

      }, doneTypingInterval);
    });
    $("#search_price_filter").on('click', function() {
      var sort_order = $('#sources').val();
      var filter_check = [];
      var filter_names = [];
      var searchstring = '';
      var price_array = [];
      var low_price = $('#low-price').val();
      var high_price = $('#high-price').val();
      $('input[name="filter_check"]:checked').each(function(index) {
        var category_name = $(this).data('category');
        var filter_name = $(this).data('name');
        // console.log(category_name);

        if (Array.isArray(filter_names[category_name]) && filter_names[category_name].length > 0) {
          var cat_cnt = filter_names[category_name].length;
          filter_check[index] = this.value;
          filter_names[category_name][cat_cnt] = filter_name;
        } else {
          filter_check[index] = this.value;
          filter_names[category_name] = [];
          filter_names[category_name][0] = filter_name;

        }
      });
      // console.log(filter_names);
      var category_slug = $('#category_slug').val();
      var sub_category_slug = $('#sub_category_slug').val();
      var sub_sub_category_slug = $('#sub_sub_category_slug').val();
      price_array = [low_price, high_price];
      // console.log(price_array);
      products(sort_order, category_slug, sub_category_slug, sub_sub_category_slug, filter_check, filter_names, null, null, price_array);
    });
    $(".price_filter").on('click', function() {
      var low_price = 0;
      var high_price = 0;
      var pcnt = 0;
      $('.price_filter:checked').each(function(index) {

        high_price = $(this).data('max_price');
        if (pcnt == 0) {
          low_price = $(this).data('min_price');
        }
        pcnt++;
      });
      if ($('.price_filter:checked').length == 0) {
        low_price = 125;
        high_price = 32000;
      }
      console.log($('.price_filter:checked').length);
      $('#low-price').val(low_price);
      $('#high-price').val(high_price);
      var rangeSlider = document.getElementById('slider-range');
      if (rangeSlider != undefined) {
        rangeSlider.noUiSlider.set([low_price, high_price]);
      }
    });
    $(".discount_filter").on('click', function() {
      var low_price = 0;
      var high_price = 0;
      var pcnt = 0;
      $('.discount_filter:checked').each(function(index) {

        high_price = $(this).data('max_price');
        if (pcnt == 0) {
          low_price = $(this).data('min_price');
        }
        pcnt++;
      });
      if ($('.discount_filter:checked').length == 0) {
        low_price = 125;
        high_price = 32000;
      }
      console.log($('.discount_filter:checked').length);

    });

    $(".filter_gender").on('change', function() {
      var filter_gender = $('input[name="filter_gender"]:checked').val();
      var search_query = $('#search_query').val();
      console.log(filter_gender);
      $.ajax({
        url: '{{url("/product/getfilters")}}',
        type: 'post',
        data: {
          filter_gender: filter_gender,
          _token: "{{ csrf_token() }}",
        },
        success: function(data) {
          // console.log(data);
          $('#filter_list').html(data);
          load_accordian();
          var sort_order = '';
          var category_slug = '';
          var sub_category_slug = '';
          var sub_sub_category_slug = '';
          var filter_check = '';
          var filter_names = '';
          products(sort_order, category_slug, sub_category_slug, sub_sub_category_slug, filter_check, filter_names, filter_gender, search_query);
          var low_price = 125;
          var high_price = 32000;
          $('#low-price').val(low_price);
          $('#high-price').val(high_price);
          var rangeSlider = document.getElementById('slider-range');
          if (rangeSlider != undefined) {
            var moneyFormat = wNumb({
              decimals: 0,
              thousand: ',',
              prefix: '₹'
            });
            noUiSlider.create(rangeSlider, {
              start: [125, 32000],
              step: 1,
              range: {
                'min': [125],
                'max': [32000]
              },
              format: moneyFormat,
              connect: true
            });
            // console.log(rangeSlider);
            rangeSlider.noUiSlider.set([low_price, high_price]);
            document.getElementById('slider-range-value1').innerHTML = '₹' + low_price;
            document.getElementById('slider-range-value2').innerHTML = '₹' + high_price;
            document.getElementById('min_value').value = moneyFormat.from(low_price);
            document.getElementById('max_value').value = moneyFormat.from(high_price);
          }
        },
        error: function(data) {
          console.log(data);
          // alert(data[1]);
        }
      });

    });
    $(document).on('click', '#sort_order, .filter_check', function() {
      // alert('test');
      var sort_order = $('#sources').val();
      var filter_check = [];
      var filter_names = [];
      var searchstring = '';
      var price_array = [];
      var low_price = $('#low-price').val();
      var high_price = $('#high-price').val();
      $('input[name="filter_check"]:checked').each(function(index) {
        var category_name = $(this).data('category');
        var filter_name = $(this).data('name');
        console.log(category_name);
        // var category_arr = {};
        // if (typeof filter_check[category_name] == 'undefined' && filter_check[category_name].length == 0)
        if (Array.isArray(filter_names[category_name]) && filter_names[category_name].length > 0) {
          // filter_check[category_name] = 1;

          var cat_cnt = filter_names[category_name].length;
          filter_check[index] = this.value;
          filter_names[category_name][cat_cnt] = filter_name;
        } else {
          // filter_check = [];
          filter_check[index] = this.value;
          filter_names[category_name] = [];
          filter_names[category_name][0] = filter_name;

        }
        // if (searchstring!='')
        // {
        //   searchstring += '&';
        // }
        // searchstring += category_name+'='+filter_name;
        // if (Array.isArray(filter_check[category_name]) && filter_check[category_name].length > 0)
        // {
        //   // filter_check[category_name] = [];
        //   console.log('test out yes');
        // }
        // else
        // {
        //   console.log('test out else');
        //   console.log(filter_check);
        // }
        // // filter_check.push(category_arr);
        // filter_check[index]=category_arr;

        // filter_check['1'][index]=this.value;
      });
      // console.log(filter_names);
      var category_slug = $('#category_slug').val();
      var sub_category_slug = $('#sub_category_slug').val();
      var sub_sub_category_slug = $('#sub_sub_category_slug').val();
      price_array = [low_price, high_price];
      products(sort_order, category_slug, sub_category_slug, sub_sub_category_slug, filter_check, filter_names, null, null, price_array);
    });
    //to reset the filters
    $('#reset-filters').click(function() {
      // alert('test');
      var sort_order = '';
      var filter_check = [];
      var filter_names = [];
      var searchstring = '';
      var filter_gender = $('input[name="filter_gender"]:checked').val();
      $('input[name="filter_gender"]:checked').prop('checked', false);
      $('input[name="filter_check"]:checked').each(function(index) {
        $(this).prop('checked', false);
      });
      if (filter_gender != '' && filter_gender != null) {
        $('#filter_list').html('');
      }
      var rangeSlider = document.getElementById('slider-range');
      if (rangeSlider != undefined) {
        rangeSlider.noUiSlider.set([125, 32000]);
      }
      $('#low-price').val(125);
      $('#high-price').val(32000);
      console.log('reset filter');
      var category_slug = $('#category_slug').val();
      var sub_category_slug = $('#sub_category_slug').val();
      var sub_sub_category_slug = $('#sub_sub_category_slug').val();

      products(sort_order, category_slug, sub_category_slug, sub_sub_category_slug, filter_check, filter_names);
    });

    function products(sort_order, category_slug, sub_category_slug, sub_sub_category_slug, filter_check, filter_names, filter_gender = null, search_query = null, price_array = null) {
      // console.log('price_array');
      // console.log(price_array);
      // alert('test3');
      $('body').removeClass('loaded');
      var sort_order_clause = '';
      var filter_check_clause = '';
      if (sort_order) {
        sort_order_clause = '/' + sort_order;
      }
      var searchstring = '';
      var filter_level = '{{isset($filter_level)?$filter_level:"third"}}';
      var search_query = $('#search_query').val();
      var filter_gender = $('input[name="filter_gender"]:checked').val();
      if (search_query != null && search_query != '') {
        console.log(search_query);
        filter_level = 'search';
      }
      if (filter_check != '' && filter_check != null) {
        // var filter_list = filter_check.join(', ');
        // console.log('above the for');
        for (const filter_value in filter_names) {
          if (searchstring != '') {
            searchstring += '&';
          }
          var filter_list = Array.prototype.join.call(filter_names[filter_value], ',');
          searchstring += filter_value + '=' + filter_list;
          // console.log('index');
          // console.log(filter_names[filter_value]);
        }

        if (sort_order_clause != "" && sort_order_clause != null) {
          filter_check_clause = '?' + searchstring;
        } else {
          filter_check_clause = '?' + searchstring;
        }
      }
      $.ajax({
        url: '{{url("/product/getproducts")}}',
        type: 'post',
        async: true,
        data: {
          category_slug: category_slug,
          sub_category_slug: sub_category_slug,
          sub_sub_category_slug: sub_sub_category_slug,
          filter_check: filter_check,
          filter_level: filter_level,
          search_query: search_query,
          filter_gender: filter_gender,
          price_array: price_array,
          sort_order: sort_order,
          _token: "{{ csrf_token() }}",
        },
        success: function(data) {
          $('#listing_container').html('');
          $('#listing_container').append(data[1]);
          $('#product-count').text(' (' + data[2] + ')');
          // slider.reloadSlider();
          // slider.goToSlide(oldIndex+1);
          // console.log(data[1]);
          if (data[0] == 'success') {
            // var newUrl = "{{ url('s/') }}/{{ $category_slug }}/{{ $sub_category_slug }}/{{ $sub_sub_category_slug }}"+sort_order_clause+filter_check_clause;
            var newUrl = data[3] + sort_order_clause + filter_check_clause;
            if (filter_check_clause != "" && filter_check_clause != null && filter_gender != "" && filter_gender != null) {
              newUrl += '&gender=' + filter_gender;
            } else if ((filter_check_clause == "" || filter_check_clause == null) && filter_gender != "" && filter_gender != null) {
              newUrl += '?gender=' + filter_gender;
            }
            if (!!(window.history && history.pushState)) {
              // e.preventDefault();
              // alert('test url');
              let stateObj = {
                id: "100"
              };
              history.pushState(stateObj, 'test page', newUrl);
            }
          }
          if (data[0] == 'error') {
            // var newUrl = "{{ url('s/') }}/{{ $category_slug }}/{{ $sub_category_slug }}/{{ $sub_sub_category_slug }}"+sort_order_clause+filter_check_clause;
            var newUrl = data[3] + sort_order_clause + filter_check_clause;
            if (filter_check_clause != "" && filter_check_clause != null && filter_gender != "" && filter_gender != null) {
              newUrl += '&gender=' + filter_gender;
            } else if ((filter_check_clause == "" || filter_check_clause == null) && filter_gender != "" && filter_gender != null) {
              newUrl += '?gender=' + filter_gender;
            }
            if (!!(window.history && history.pushState)) {
              // e.preventDefault();
              // alert('test url');
              let stateObj = {
                id: "100"
              };
              history.pushState(stateObj, 'test page', newUrl);
            }
          }

          function sliderInit() {
            $('.sliderdemo').slick({
              slidesToShow: 1,
              slidesToScroll: 1,
              autoplay: true,
              autoplaySpeed: 1000,
              pauseOnHover: false,
              dots: true,
              initialSlide: 0
            });
          };
          sliderInit();
          // $(".sliderdemo").slick('destroy');
          // window.history.pushState({}, null, newUrl);

        }
      });
      setTimeout(function() {
        $('body').addClass('loaded');
      }, 2500);
    }





    function load_accordian() {
      const accordionBtns = document.querySelectorAll(".accordion");

      accordionBtns.forEach((accordion) => {
        accordion.onclick = function() {
          this.classList.toggle("is-open");

          let content = this.nextElementSibling;
          console.log(content);

          if (content.style.maxHeight) {
            //this is if the accordion is open
            content.style.maxHeight = null;
          } else {
            //if the accordion is currently closed
            content.style.maxHeight = content.scrollHeight + "px";
            console.log(content.style.maxHeight);
          }
        };
      });
    }
    load_accordian();

  });
  $(document).ready(function() {

    txt = document.getElementById("contents");
    btn = document.getElementById("btn");


    if (btn != null) {
      btn.innerHTML = 'View More';
    }


    $('#btn').click(function() {
      if (btn.textContent == 'View More') {
        $("#contents").removeClass("contents_toggle");
        btn.innerHTML = 'View Less';
      } else {
        // alert('less'); 
        $("#contents").addClass("contents_toggle");
        // txt.classList.add = 'contents_toggle';
        btn.innerHTML = 'View More';
      }
    });






    // Fakes the loading setting a timeout
    setTimeout(function() {
      $('body').addClass('loaded');
    }, 2500);

  });
</script>


@endsection