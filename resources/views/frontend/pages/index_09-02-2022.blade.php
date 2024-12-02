@extends('frontend.layouts.pages')
@section('title',$page_content->cms_pages_title)
@section('content')

<!-- Product details start -->
  <div class="container-fluidcustom top-padding ">
    <!-- <div class="images-box"> -->
      <div class="row pt-4">
        <div class=" col-md-12 col-sm-12 col-12">

          <h1 class="inner-title">{{ $page_content->cms_pages_title }}</h1>
          <hr class="terms-hr">
          <div class="container  mt-3 pb-5">
            <!-- top-padding -->
            <!-- <div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                <p class="need-help">Need Help!</p>
                <div class="contact-us">
                  <h4>CONTACT US</h4>
                </div>
              </div>
            </div> -->
            <div class="row">
              @if($page_content->contactus_form_flag == 1)
              <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                {!! $page_content->cms_pages_content !!}
              </div>
              <div class="col-lg-6 col-md-6 col-sm-6 col-12">
                <div class=" pt-4">
                  <h5 class="contact-head1">Submit your query</h5>
                </div>
                <p class="mandatory-fields text-right"><span class="star">*</span>All fields are Mandatory</p>


              <form class="contact-form form-field" action="" method="post" onsubmit="return mycontact()">
                <div class="row">
                <div class="form-group  col-md-12 pb-3">
                <div class="input-wrapper">
                  <input class="form-control form-control-h" type="text" required>
                  <label class="contfirst-label" for="user">Full Name <span class="star">*</span></label>
                </div>
                </div>

                <div class="form-group col-md-12 pb-3">
                <div class="input-wrapper">
                <input class="form-control form-control-h" type="email" required>
                <label for="user">Email ID <span class="star">*</span></label>
                </div>
                </div>

                <div class="form-group col-md-12 pb-3">
                <div class="input-wrapper">
                <input class="form-control form-control-h" type="text" id="mobnumber" required>

                <label for="user">Mobile Phone Number <span class="star">*</span></label>
                <span class="number-msg" id="messages"></span>
                </div>
                </div>

                <div class="form-group col-md-6 pb-3">
                <div class="input-wrapper">
                <input class="form-control form-control-h" type="text" required>
                <label for="user">Order Number <span class="star">*</span></label>
                </div>
                </div>

                <div class="form-group col-md-6 pb-3">
                <div class="input-wrapper select-arrrow">
                <!-- <input class="form-control form-control-h" type="text"  required> -->
                <select class="form-control form-control-h " required>
                  <!-- <option class="select-star" selected hidden></option> -->
                  <option hidden=""></option>
                  <option>Account Related</option>
                  <option>Coupons Related</option>
                  <option>Offers Related</option>
                  <option>Order Related</option>
                  <option>Order Cancellation Related</option>
                  <option>Product Return Related</option>
                  <option>Refund Related</option>
                  <option>Others</option>

                </select>
                <label for="user">Select Issue <span class="star">*</span></label>

                </div>
                </div>

                <div class="form-group col-md-12 pb-3">
                   <div class="input-wrapper">
                   <textarea class="form-control " rows="5" required=""></textarea>
                   <label for="user">Write Comment Here <span class="star">*</span></label>
                   </div>
                </div>
                </div>

                <input type="hidden" name="recaptcha_response" id="recaptchaResponse" value="03AGdBq261Wc1FM2u3RojhKGilsluD8icOPc8Gb97-zezqYVv_DR1HDocozMVJt3tnB5Pg4cykE5W5vPn-QRg8NzAK0rESFAzfmDepqnHjD6jY1uB8vrMgX8vv8DpUIDsIzbxn2wRQ0Bxf47Xv96MCI-ByhigfbFqtKtxUMNx6xJSSfITa1uC3wfvOqPB0tCGx3KbqynhEKd3_3rNRqHYJ4JcLdCcsECZd9ZuCZ8o9OIfyzMSHC1QZ2pLyo9W-0ceHHRBZaibMdFUylxRL0xGp9P1Tgpl-e2gjzWSC0tPDyjDtKJJmgRDqCYLPbXUPeWGwn4ZvnHIDDFsUt0oI2DYxGPNbQpnNj5XowLUh8n3WR6MqfcS34pziFGJudGw__CL0icpuAz1k8ATeVpNGmKQefFW15zdTOadXsHcgdnrjJjBfY_jx89UXN-Ya5RV9hFPEiMVjdt4fp_pTstp73t7fUsE5-0a6BzVxSA">

              <button type="submit" class="contact-btn">SUBMIT</button>
              </form>
              <script>
                   grecaptcha.ready(function() {
                      grecaptcha.execute('6LdEIBAaAAAAAKfBjn8xfjhX_Z9vfeYFzbShZjky', {action: 'submit'}).then(function(token) {
                         var recaptchaResponse = document.getElementById('recaptchaResponse');
                         recaptchaResponse.value = token;
                      });
                   });
                </script>
            </div>
              @else
                {!! $page_content->cms_pages_content !!}
              @endif
            </div>

          </div>
        </div>

     </div>
    <!-- </div> -->
 </div>
<!-- Product details end -->






@endsection
