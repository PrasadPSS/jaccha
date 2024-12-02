@extends('frontend.layouts.app')
@section('title','Deals')
@section('content')


<!-- TODAY’S SPECIAL DEALS END IN sectionn start -->
<div class="container-fluidcustom top-padding pt-4">
  <div class="row today-deals my-auto">
    <div class="col-lg-1 col-md-2 col-sm-2 col-4 ">
      <div class="today-timerimg">
        <img src="{{ asset('frontend-assets/images/timer-todays.jpg') }}" class="img-fluid" alt="">
      </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-8 pl-0">
      <div class="today-hurry">
        <p class="m-0">Hurry up!</p>
         <p class="m-0 pl-2">Grab the deals…</p>
      </div>
    </div>
    <div class="col-lg-4 col-md-7 col-sm-7 col-12 text-center">
      <div class="today-heading">
        <h1>TODAY’S SPECIAL DEALS END IN:</h1>
      </div>
    </div>
    <div class="col-lg-4 col-md-12 col-sm-12 col-12 deals-timer">
      <div class="row timer no-gutters" id="clockdiv">
			<div class="col-lg-2 col-md-2 col-2 m-auto ">
				<div class="timer__container">
				<span id="days" class="days">0</span>
					<div class="smalltext">Days</div>
				</div>
			</div>
			<div class="col-lg-1 col-md-1 col-1 divider-col p-0">
				<span>:</span>
			</div>
			<div class="col-lg-2 col-md-2 col-2 m-auto">
				<div class="timer__container">
				<span id="hours" class="hours">7</span>
					<div class="smalltext">Hours</div>
				</div>
			</div>
			<div class="col-lg-1 col-md-1 col-1 divider-col p-0">
				<span>:</span>
			</div>
			<div class="col-lg-2 col-md-2 col-2 m-auto">
				<div class="timer__container">
				<span id="minutes" class="minutes">31</span>
					<div class="smalltext">Minutes</div>
				</div>
			</div>
			<div class="col-lg-1 col-md-1 col-1 divider-col p-0">
				<span>:</span>
			</div>
			<div class="col-lg-2 col-md-2 col-2 m-auto">
				<div class="timer__container">
				<span id="seconds" class="seconds">7</span>
					<div class="smalltext">Seconds</div>
				</div>
			</div>
		</div>
    </div>
  </div>
</div>
<!-- TODAY’S SPECIAL DEALS END IN sectionn end -->

<!-- men women view all tabs star -->
<div class="container-fluidcustom today">
<div class="row deals-filter-btns">
  <div class="col-md-12 col-sm-12 col-12 text-center">
    <div id="myBtnFilter">
      <button class="btn1 mr-3" onclick="filterSelection('male')"> MEN</button>
      <button class="btn1 mr-3" onclick="filterSelection('women')"> WOMEN</button>
      <button class="btn1 active" onclick="filterSelection('all')"> VIEW ALL</button>
    </div>
  </div>
</div>
</div>
<div class="container-fluidcustom today">
<div class="row ">
  <div class="column women">
    <div class="content">
      <div class="item">
        <div class=" card ">
           <div class="container1">
              <img class="img-fluid" src="{{ asset('frontend-assets/images/tops/t-2.jpg') }}" alt="Img">
              <div class="pro-details pt-4 ">
                 <p class="pro-name"> Kapachi</p>
                 <p class="pro-style mb-1">Western Top</p>
              </div>
           <p class="pro-details">
             <span class="price mr-2">₹ 475</span>
             <!-- <span class="mrp">MRP</span> -->
             <span class="mrp-cut mr-2">₹ 950</span>
             <span class="discount">(50% OFF)</span>
          </p>
          </div>
          <div class="img-text">
            <p><span>HAND</span>-PICKED</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="column male">
    <div class="content">
      <div class="item">
        <div class=" card ">
           <div class="container1">
              <img class="img-fluid" src="{{ asset('frontend-assets/images/tops/t-18.jpg') }}" alt="Img">
              <div class="pro-details pt-4 ">
                 <p class="pro-name"> Kapachi</p>
                 <p class="pro-style mb-1">Western Top</p>
              </div>
           <p class="pro-details">
             <span class="price mr-2">₹ 475</span>
             <!-- <span class="mrp">MRP</span> -->
             <span class="mrp-cut mr-2">₹ 950</span>
             <span class="discount">(50% OFF)</span>
          </p>
          </div>
          <div class="img-text">
            <p><span>HAND</span>-PICKED</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="column women">
    <div class="content">
      <div class="item">
        <div class=" card ">
           <div class="container1">
              <img class="img-fluid" src="{{ asset('frontend-assets/images/tops/t-6.jpg') }}" alt="Img">
              <div class="pro-details pt-4 ">
                 <p class="pro-name"> Kapachi</p>
                 <p class="pro-style mb-1">Western Top</p>
              </div>
           <p class="pro-details">
             <span class="price mr-2">₹ 475</span>
             <!-- <span class="mrp">MRP</span> -->
             <span class="mrp-cut mr-2">₹ 950</span>
             <span class="discount">(50% OFF)</span>
          </p>
          </div>
          <div class="img-text">
            <p><span>HAND</span>-PICKED</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="column male">
    <div class="content">
      <div class="item">
        <div class=" card ">
           <div class="container1">
              <img class="img-fluid" src="{{ asset('frontend-assets/images/tops/t-10.jpg') }}" alt="Img">
              <div class="pro-details pt-4 ">
                 <p class="pro-name"> Kapachi</p>
                 <p class="pro-style mb-1">Western Top</p>
              </div>
           <p class="pro-details">
             <span class="price mr-2">₹ 475</span>
             <!-- <span class="mrp">MRP</span> -->
             <span class="mrp-cut mr-2">₹ 950</span>
             <span class="discount">(50% OFF)</span>
          </p>
          </div>
          <div class="img-text">
            <p><span>HAND</span>-PICKED</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="column women">
    <div class="content">
      <div class="item">
        <div class=" card ">
           <div class="container1">
              <img class="img-fluid" src="{{ asset('frontend-assets/images/tops/t-4.jpg') }}" alt="Img">
              <div class="pro-details pt-4 ">
                 <p class="pro-name"> Kapachi</p>
                 <p class="pro-style mb-1">Western Top</p>
              </div>
           <p class="pro-details">
             <span class="price mr-2">₹ 475</span>
             <!-- <span class="mrp">MRP</span> -->
             <span class="mrp-cut mr-2">₹ 950</span>
             <span class="discount">(50% OFF)</span>
          </p>
          </div>
          <div class="img-text">
            <p><span>HAND</span>-PICKED</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="column male">
    <div class="content">
      <div class="item">
        <div class=" card ">
           <div class="container1">
              <img class="img-fluid" src="{{ asset('frontend-assets/images/tops/t-10.jpg') }}" alt="Img">
              <div class="pro-details pt-4 ">
                 <p class="pro-name"> Kapachi</p>
                 <p class="pro-style mb-1">Western Top</p>
              </div>
           <p class="pro-details">
             <span class="price mr-2">₹ 475</span>
             <!-- <span class="mrp">MRP</span> -->
             <span class="mrp-cut mr-2">₹ 950</span>
             <span class="discount">(50% OFF)</span>
          </p>
          </div>
          <div class="img-text">
            <p><span>HAND</span>-PICKED</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="column women">
    <div class="content">
      <div class="item">
        <div class=" card ">
           <div class="container1">
              <img class="img-fluid" src="{{ asset('frontend-assets/images/tops/t-8.jpg') }}" alt="Img">
              <div class="pro-details pt-4 ">
                 <p class="pro-name"> Kapachi</p>
                 <p class="pro-style mb-1">Western Top</p>
              </div>
           <p class="pro-details">
             <span class="price mr-2">₹ 475</span>
             <!-- <span class="mrp">MRP</span> -->
             <span class="mrp-cut mr-2">₹ 950</span>
             <span class="discount">(50% OFF)</span>
          </p>
          </div>
          <div class="img-text">
            <p><span>HAND</span>-PICKED</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="column male">
    <div class="content">
      <div class="item">
        <div class=" card ">
           <div class="container1">
              <img class="img-fluid" src="{{ asset('frontend-assets/images/tops/t-5.jpg') }}" alt="Img">
              <div class="pro-details pt-4 ">
                 <p class="pro-name"> Kapachi</p>
                 <p class="pro-style mb-1">Western Top</p>
              </div>
           <p class="pro-details">
             <span class="price mr-2">₹ 475</span>
             <!-- <span class="mrp">MRP</span> -->
             <span class="mrp-cut mr-2">₹ 950</span>
             <span class="discount">(50% OFF)</span>
          </p>
          </div>
          <div class="img-text">
            <p><span>HAND</span>-PICKED</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="column women">
    <div class="content">
      <div class="item">
        <div class=" card ">
           <div class="container1">
              <img class="img-fluid" src="{{ asset('frontend-assets/images/tops/t-2.jpg') }}" alt="Img">
              <div class="pro-details pt-4 ">
                 <p class="pro-name"> Kapachi</p>
                 <p class="pro-style mb-1">Western Top</p>
              </div>
           <p class="pro-details">
             <span class="price mr-2">₹ 475</span>
             <!-- <span class="mrp">MRP</span> -->
             <span class="mrp-cut mr-2">₹ 950</span>
             <span class="discount">(50% OFF)</span>
          </p>
          </div>
          <div class="img-text">
            <p><span>HAND</span>-PICKED</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="column male">
    <div class="content">
      <div class="item">
        <div class=" card ">
           <div class="container1">
              <img class="img-fluid" src="{{ asset('frontend-assets/images/tops/t-18.jpg') }}" alt="Img">
              <div class="pro-details pt-4 ">
                 <p class="pro-name"> Kapachi</p>
                 <p class="pro-style mb-1">Western Top</p>
              </div>
           <p class="pro-details">
             <span class="price mr-2">₹ 475</span>
             <!-- <span class="mrp">MRP</span> -->
             <span class="mrp-cut mr-2">₹ 950</span>
             <span class="discount">(50% OFF)</span>
          </p>
          </div>
          <div class="img-text">
            <p><span>HAND</span>-PICKED</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="column women">
    <div class="content">
      <div class="item">
        <div class=" card ">
           <div class="container1">
              <img class="img-fluid" src="{{ asset('frontend-assets/images/tops/t-7.jpg') }}" alt="Img">
              <div class="pro-details pt-4 ">
                 <p class="pro-name"> Kapachi</p>
                 <p class="pro-style mb-1">Western Top</p>
              </div>
           <p class="pro-details">
             <span class="price mr-2">₹ 475</span>
             <!-- <span class="mrp">MRP</span> -->
             <span class="mrp-cut mr-2">₹ 950</span>
             <span class="discount">(50% OFF)</span>
          </p>
          </div>
          <div class="img-text">
            <p><span>HAND</span>-PICKED</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="column male">
    <div class="content">
      <div class="item">
        <div class=" card ">
           <div class="container1">
              <img class="img-fluid" src="{{ asset('frontend-assets/images/tops/t-10.jpg') }}" alt="Img">
              <div class="pro-details pt-4 ">
                 <p class="pro-name"> Kapachi</p>
                 <p class="pro-style mb-1">Western Top</p>
              </div>
           <p class="pro-details">
             <span class="price mr-2">₹ 475</span>
             <!-- <span class="mrp">MRP</span> -->
             <span class="mrp-cut mr-2">₹ 950</span>
             <span class="discount">(50% OFF)</span>
          </p>
          </div>
          <div class="img-text">
            <p><span>HAND</span>-PICKED</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="column women">
    <div class="content">
      <div class="item">
        <div class=" card ">
           <div class="container1">
              <img class="img-fluid" src="{{ asset('frontend-assets/images/tops/t-4.jpg') }}" alt="Img">
              <div class="pro-details pt-4 ">
                 <p class="pro-name"> Kapachi</p>
                 <p class="pro-style mb-1">Western Top</p>
              </div>
           <p class="pro-details">
             <span class="price mr-2">₹ 475</span>
             <!-- <span class="mrp">MRP</span> -->
             <span class="mrp-cut mr-2">₹ 950</span>
             <span class="discount">(50% OFF)</span>
          </p>
          </div>
          <div class="img-text">
            <p><span>HAND</span>-PICKED</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="column male">
    <div class="content">
      <div class="item">
        <div class=" card ">
           <div class="container1">
              <img class="img-fluid" src="{{ asset('frontend-assets/images/tops/t-10.jpg') }}" alt="Img">
              <div class="pro-details pt-4 ">
                 <p class="pro-name"> Kapachi</p>
                 <p class="pro-style mb-1">Western Top</p>
              </div>
           <p class="pro-details">
             <span class="price mr-2">₹ 475</span>
             <!-- <span class="mrp">MRP</span> -->
             <span class="mrp-cut mr-2">₹ 950</span>
             <span class="discount">(50% OFF)</span>
          </p>
          </div>
          <div class="img-text">
            <p><span>HAND</span>-PICKED</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="column women">
    <div class="content">
      <div class="item">
        <div class=" card ">
           <div class="container1">
              <img class="img-fluid" src="{{ asset('frontend-assets/images/tops/t-6.jpg') }}" alt="Img">
              <div class="pro-details pt-4 ">
                 <p class="pro-name"> Kapachi</p>
                 <p class="pro-style mb-1">Western Top</p>
              </div>
           <p class="pro-details">
             <span class="price mr-2">₹ 475</span>
             <!-- <span class="mrp">MRP</span> -->
             <span class="mrp-cut mr-2">₹ 950</span>
             <span class="discount">(50% OFF)</span>
          </p>
          </div>
          <div class="img-text">
            <p><span>HAND</span>-PICKED</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="column male">
    <div class="content">
      <div class="item">
        <div class=" card ">
           <div class="container1">
              <img class="img-fluid" src="{{ asset('frontend-assets/images/tops/t-18.jpg') }}" alt="Img">
              <div class="pro-details pt-4 ">
                 <p class="pro-name"> Kapachi</p>
                 <p class="pro-style mb-1">Western Top</p>
              </div>
           <p class="pro-details">
             <span class="price mr-2">₹ 475</span>
             <!-- <span class="mrp">MRP</span> -->
             <span class="mrp-cut mr-2">₹ 950</span>
             <span class="discount">(50% OFF)</span>
          </p>
          </div>
          <div class="img-text">
            <p><span>HAND</span>-PICKED</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="column women">
    <div class="content">
      <div class="item">
        <div class=" card ">
           <div class="container1">
              <img class="img-fluid" src="{{ asset('frontend-assets/images/tops/t-8.jpg') }}" alt="Img">
              <div class="pro-details pt-4 ">
                 <p class="pro-name"> Kapachi</p>
                 <p class="pro-style mb-1">Western Top</p>
              </div>
           <p class="pro-details">
             <span class="price mr-2">₹ 475</span>
             <!-- <span class="mrp">MRP</span> -->
             <span class="mrp-cut mr-2">₹ 950</span>
             <span class="discount">(50% OFF)</span>
          </p>
          </div>
          <div class="img-text">
            <p><span>HAND</span>-PICKED</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="column male">
    <div class="content">
      <div class="item">
        <div class=" card ">
           <div class="container1">
              <img class="img-fluid" src="{{ asset('frontend-assets/images/tops/t-5.jpg') }}" alt="Img">
              <div class="pro-details pt-4 ">
                 <p class="pro-name"> Kapachi</p>
                 <p class="pro-style mb-1">Western Top</p>
              </div>
           <p class="pro-details">
             <span class="price mr-2">₹ 475</span>
             <!-- <span class="mrp">MRP</span> -->
             <span class="mrp-cut mr-2">₹ 950</span>
             <span class="discount">(50% OFF)</span>
          </p>
          </div>
          <div class="img-text">
            <p><span>HAND</span>-PICKED</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="column women">
    <div class="content">
      <div class="item">
        <div class=" card ">
           <div class="container1">
              <img class="img-fluid" src="{{ asset('frontend-assets/images/tops/t-6.jpg') }}" alt="Img">
              <div class="pro-details pt-4 ">
                 <p class="pro-name"> Kapachi</p>
                 <p class="pro-style mb-1">Western Top</p>
              </div>
           <p class="pro-details">
             <span class="price mr-2">₹ 475</span>
             <!-- <span class="mrp">MRP</span> -->
             <span class="mrp-cut mr-2">₹ 950</span>
             <span class="discount">(50% OFF)</span>
          </p>
          </div>
          <div class="img-text">
            <p><span>HAND</span>-PICKED</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="column male">
    <div class="content">
      <div class="item">
        <div class=" card ">
           <div class="container1">
              <img class="img-fluid" src="{{ asset('frontend-assets/images/tops/t-10.jpg') }}" alt="Img">
              <div class="pro-details pt-4 ">
                 <p class="pro-name"> Kapachi</p>
                 <p class="pro-style mb-1">Western Top</p>
              </div>
           <p class="pro-details">
             <span class="price mr-2">₹ 475</span>
             <!-- <span class="mrp">MRP</span> -->
             <span class="mrp-cut mr-2">₹ 950</span>
             <span class="discount">(50% OFF)</span>
          </p>
          </div>
          <div class="img-text">
            <p><span>HAND</span>-PICKED</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="column women">
    <div class="content">
      <div class="item">
        <div class=" card ">
           <div class="container1">
              <img class="img-fluid" src="{{ asset('frontend-assets/images/tops/t-2.jpg') }}" alt="Img">
              <div class="pro-details pt-4 ">
                 <p class="pro-name"> Kapachi</p>
                 <p class="pro-style mb-1">Western Top</p>
              </div>
           <p class="pro-details">
             <span class="price mr-2">₹ 475</span>
             <!-- <span class="mrp">MRP</span> -->
             <span class="mrp-cut mr-2">₹ 950</span>
             <span class="discount">(50% OFF)</span>
          </p>
          </div>
          <div class="img-text">
            <p><span>HAND</span>-PICKED</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="column male">
    <div class="content">
      <div class="item">
        <div class=" card ">
           <div class="container1">
              <img class="img-fluid" src="{{ asset('frontend-assets/images/tops/t-9.jpg') }}" alt="Img">
              <div class="pro-details pt-4 ">
                 <p class="pro-name"> Kapachi</p>
                 <p class="pro-style mb-1">Western Top</p>
              </div>
           <p class="pro-details">
             <span class="price mr-2">₹ 475</span>
             <!-- <span class="mrp">MRP</span> -->
             <span class="mrp-cut mr-2">₹ 950</span>
             <span class="discount">(50% OFF)</span>
          </p>
          </div>
          <div class="img-text">
            <p><span>HAND</span>-PICKED</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="column women">
    <div class="content">
      <div class="item">
        <div class=" card ">
           <div class="container1">
              <img class="img-fluid" src="{{ asset('frontend-assets/images/tops/t-7.jpg') }}" alt="Img">
              <div class="pro-details pt-4 ">
                 <p class="pro-name"> Kapachi</p>
                 <p class="pro-style mb-1">Western Top</p>
              </div>
           <p class="pro-details">
             <span class="price mr-2">₹ 475</span>
             <!-- <span class="mrp">MRP</span> -->
             <span class="mrp-cut mr-2">₹ 950</span>
             <span class="discount">(50% OFF)</span>
          </p>
          </div>
          <div class="img-text">
            <p><span>HAND</span>-PICKED</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="column male">
    <div class="content">
      <div class="item">
        <div class=" card ">
           <div class="container1">

              <img class="img-fluid" src="{{ asset('frontend-assets/images/tops/t-10.jpg') }}" alt="Img">
              <div class="pro-details pt-4 ">
                 <p class="pro-name"> Kapachi</p>
                 <p class="pro-style mb-1">Western Top</p>
              </div>
           <p class="pro-details">
             <span class="price mr-2">₹ 475</span>
             <!-- <span class="mrp">MRP</span> -->
             <span class="mrp-cut mr-2">₹ 950</span>
             <span class="discount">(50% OFF)</span>
          </p>
          </div>
          <div class="img-text">
            <p><span>HAND</span>-PICKED</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="column women">
    <div class="content">
      <div class="item">
        <div class=" card ">
           <div class="container1">
              <img class="img-fluid" src="{{ asset('frontend-assets/images/tops/t-4.jpg') }}" alt="Img">
              <div class="pro-details pt-4 ">
                 <p class="pro-name"> Kapachi</p>
                 <p class="pro-style mb-1">Western Top</p>
              </div>
           <p class="pro-details">
             <span class="price mr-2">₹ 475</span>
             <!-- <span class="mrp">MRP</span> -->
             <span class="mrp-cut mr-2">₹ 950</span>
             <span class="discount">(50% OFF)</span>
          </p>
          </div>
          <div class="img-text">
            <p><span>HAND</span>-PICKED</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="column male">
    <div class="content">
      <div class="item">
        <div class=" card ">
           <div class="container1">
              <img class="img-fluid" src="{{ asset('frontend-assets/images/tops/t-10.jpg') }}" alt="Img">
              <div class="pro-details pt-4 ">
                 <p class="pro-name"> Kapachi</p>
                 <p class="pro-style mb-1">Western Top</p>
              </div>
           <p class="pro-details">
             <span class="price mr-2">₹ 475</span>
             <!-- <span class="mrp">MRP</span> -->
             <span class="mrp-cut mr-2">₹ 950</span>
             <span class="discount">(50% OFF)</span>
          </p>
          </div>
          <div class="img-text">
            <p><span>HAND</span>-PICKED</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="column women">
    <div class="content">
      <div class="item">
        <div class=" card ">
           <div class="container1">
              <img class="img-fluid" src="{{ asset('frontend-assets/images/tops/t-8.jpg') }}" alt="Img">
              <div class="pro-details pt-4 ">
                 <p class="pro-name"> Kapachi</p>
                 <p class="pro-style mb-1">Western Top</p>
              </div>
           <p class="pro-details">
             <span class="price mr-2">₹ 475</span>
             <!-- <span class="mrp">MRP</span> -->
             <span class="mrp-cut mr-2">₹ 950</span>
             <span class="discount">(50% OFF)</span>
          </p>
          </div>
          <div class="img-text">
            <p><span>HAND</span>-PICKED</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="column male">
    <div class="content">
      <div class="item">
        <div class=" card ">
           <div class="container1">
              <img class="img-fluid" src="{{ asset('frontend-assets/images/tops/t-9.jpg') }}" alt="Img">
              <div class="pro-details pt-4 ">
                 <p class="pro-name"> Kapachi</p>
                 <p class="pro-style mb-1">Western Top</p>
              </div>
           <p class="pro-details">
             <span class="price mr-2">₹ 475</span>
             <!-- <span class="mrp">MRP</span> -->
             <span class="mrp-cut mr-2">₹ 950</span>
             <span class="discount">(50% OFF)</span>
          </p>
          </div>
          <div class="img-text">
            <p><span>HAND</span>-PICKED</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="column women">
    <div class="content">
      <div class="item">
        <div class=" card ">
           <div class="container1">
              <img class="img-fluid" src="{{ asset('frontend-assets/images/tops/t-2.jpg') }}" alt="Img">
              <div class="pro-details pt-4 ">
                 <p class="pro-name"> Kapachi</p>
                 <p class="pro-style mb-1">Western Top</p>
              </div>
           <p class="pro-details">
             <span class="price mr-2">₹ 475</span>
             <!-- <span class="mrp">MRP</span> -->
             <span class="mrp-cut mr-2">₹ 950</span>
             <span class="discount">(50% OFF)</span>
          </p>
          </div>
          <div class="img-text">
            <p><span>HAND</span>-PICKED</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="column male">
    <div class="content">
      <div class="item">
        <div class=" card ">
           <div class="container1">
              <img class="img-fluid" src="{{ asset('frontend-assets/images/tops/t-9.jpg') }}" alt="Img">
              <div class="pro-details pt-4 ">
                 <p class="pro-name"> Kapachi</p>
                 <p class="pro-style mb-1">Western Top</p>
              </div>
           <p class="pro-details">
             <span class="price mr-2">₹ 475</span>
             <!-- <span class="mrp">MRP</span> -->
             <span class="mrp-cut mr-2">₹ 950</span>
             <span class="discount">(50% OFF)</span>
          </p>
          </div>
          <div class="img-text">
            <p><span>HAND</span>-PICKED</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="column women">
    <div class="content">
      <div class="item">
        <div class=" card ">
           <div class="container1">
              <img class="img-fluid" src="{{ asset('frontend-assets/images/tops/t-2.jpg') }}" alt="Img">
              <div class="pro-details pt-4 ">
                 <p class="pro-name"> Kapachi</p>
                 <p class="pro-style mb-1">Western Top</p>
              </div>
           <p class="pro-details">
             <span class="price mr-2">₹ 475</span>
             <!-- <span class="mrp">MRP</span> -->
             <span class="mrp-cut mr-2">₹ 950</span>
             <span class="discount">(50% OFF)</span>
          </p>
          </div>
          <div class="img-text">
            <p><span>HAND</span>-PICKED</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="column male">
    <div class="content">
      <div class="item">
        <div class=" card ">
           <div class="container1">
              <img class="img-fluid" src="{{ asset('frontend-assets/images/tops/t-1.jpg') }}" alt="Img">
              <div class="pro-details pt-4 ">
                 <p class="pro-name"> Kapachi</p>
                 <p class="pro-style mb-1">Western Top</p>
              </div>
           <p class="pro-details">
             <span class="price mr-2">₹ 475</span>
             <!-- <span class="mrp">MRP</span> -->
             <span class="mrp-cut mr-2">₹ 950</span>
             <span class="discount">(50% OFF)</span>
          </p>
          </div>
          <div class="img-text">
            <p><span>HAND</span>-PICKED</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="column women">
    <div class="content">
      <div class="item">
        <div class=" card ">
           <div class="container1">
              <img class="img-fluid" src="{{ asset('frontend-assets/images/tops/t-7.jpg') }}" alt="Img">
              <div class="pro-details pt-4 ">
                 <p class="pro-name"> Kapachi</p>
                 <p class="pro-style mb-1">Western Top</p>
              </div>
           <p class="pro-details">
             <span class="price mr-2">₹ 475</span>
             <!-- <span class="mrp">MRP</span> -->
             <span class="mrp-cut mr-2">₹ 950</span>
             <span class="discount">(50% OFF)</span>
          </p>
          </div>
          <div class="img-text">
            <p><span>HAND</span>-PICKED</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="column male">
    <div class="content">
      <div class="item">
        <div class=" card ">
           <div class="container1">
              <img class="img-fluid" src="{{ asset('frontend-assets/images/tops/t-10.jpg') }}" alt="Img">
              <div class="pro-details pt-4 ">
                 <p class="pro-name"> Kapachi</p>
                 <p class="pro-style mb-1">Western Top</p>
              </div>
           <p class="pro-details">
             <span class="price mr-2">₹ 475</span>
             <!-- <span class="mrp">MRP</span> -->
             <span class="mrp-cut mr-2">₹ 950</span>
             <span class="discount">(50% OFF)</span>
          </p>
          </div>
          <div class="img-text">
            <p><span>HAND</span>-PICKED</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="column women">
    <div class="content">
      <div class="item">
        <div class=" card ">
           <div class="container1">
              <img class="img-fluid" src="{{ asset('frontend-assets/images/tops/t-4.jpg') }}" alt="Img">
              <div class="pro-details pt-4 ">
                 <p class="pro-name"> Kapachi</p>
                 <p class="pro-style mb-1">Western Top</p>
              </div>
           <p class="pro-details">
             <span class="price mr-2">₹ 475</span>
             <!-- <span class="mrp">MRP</span> -->
             <span class="mrp-cut mr-2">₹ 950</span>
             <span class="discount">(50% OFF)</span>
          </p>
          </div>
          <div class="img-text">
            <p><span>HAND</span>-PICKED</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="column male">
    <div class="content">
      <div class="item">
        <div class=" card ">
           <div class="container1">
              <img class="img-fluid" src="{{ asset('frontend-assets/images/tops/t-10.jpg') }}" alt="Img">
              <div class="pro-details pt-4 ">
                 <p class="pro-name"> Kapachi</p>
                 <p class="pro-style mb-1">Western Top</p>
              </div>
           <p class="pro-details">
             <span class="price mr-2">₹ 475</span>
             <!-- <span class="mrp">MRP</span> -->
             <span class="mrp-cut mr-2">₹ 950</span>
             <span class="discount">(50% OFF)</span>
          </p>
          </div>
          <div class="img-text">
            <p><span>HAND</span>-PICKED</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="column women">
    <div class="content">
      <div class="item">
        <div class=" card ">
           <div class="container1">
              <img class="img-fluid" src="{{ asset('frontend-assets/images/tops/t-8.jpg') }}" alt="Img">
              <div class="pro-details pt-4 ">
                 <p class="pro-name"> Kapachi</p>
                 <p class="pro-style mb-1">Western Top</p>
              </div>
           <p class="pro-details">
             <span class="price mr-2">₹ 475</span>
             <!-- <span class="mrp">MRP</span> -->
             <span class="mrp-cut mr-2">₹ 950</span>
             <span class="discount">(50% OFF)</span>
          </p>
          </div>
          <div class="img-text">
            <p><span>HAND</span>-PICKED</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="column male">
    <div class="content">
      <div class="item">
        <div class=" card ">
           <div class="container1">
              <img class="img-fluid" src="{{ asset('frontend-assets/images/tops/t-1.jpg') }}" alt="Img">
              <div class="pro-details pt-4 ">
                 <p class="pro-name"> Kapachi</p>
                 <p class="pro-style mb-1">Western Top</p>
              </div>
           <p class="pro-details">
             <span class="price mr-2">₹ 475</span>
             <!-- <span class="mrp">MRP</span> -->
             <span class="mrp-cut mr-2">₹ 950</span>
             <span class="discount">(50% OFF)</span>
          </p>
          </div>
          <div class="img-text">
            <p><span>HAND</span>-PICKED</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="column women">
    <div class="content">
      <div class="item">
        <div class=" card ">
           <div class="container1">
              <img class="img-fluid" src="{{ asset('frontend-assets/images/tops/t-6.jpg') }}" alt="Img">
              <div class="pro-details pt-4 ">
                 <p class="pro-name"> Kapachi</p>
                 <p class="pro-style mb-1">Western Top</p>
              </div>
           <p class="pro-details">
             <span class="price mr-2">₹ 475</span>
             <!-- <span class="mrp">MRP</span> -->
             <span class="mrp-cut mr-2">₹ 950</span>
             <span class="discount">(50% OFF)</span>
          </p>
          </div>
          <div class="img-text">
            <p><span>HAND</span>-PICKED</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="column male">
    <div class="content">
      <div class="item">
        <div class=" card ">
           <div class="container1">
              <img class="img-fluid" src="{{ asset('frontend-assets/images/tops/t-18.jpg') }}" alt="Img">
              <div class="pro-details pt-4 ">
                 <p class="pro-name"> Kapachi</p>
                 <p class="pro-style mb-1">Western Top</p>
              </div>
           <p class="pro-details">
             <span class="price mr-2">₹ 475</span>
             <!-- <span class="mrp">MRP</span> -->
             <span class="mrp-cut mr-2">₹ 950</span>
             <span class="discount">(50% OFF)</span>
          </p>
          </div>
          <div class="img-text">
            <p><span>HAND</span>-PICKED</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="column women">
    <div class="content">
      <div class="item">
        <div class=" card ">
           <div class="container1">
              <img class="img-fluid" src="{{ asset('frontend-assets/images/tops/t-7.jpg') }}" alt="Img">
              <div class="pro-details pt-4 ">
                 <p class="pro-name"> Kapachi</p>
                 <p class="pro-style mb-1">Western Top</p>
              </div>
           <p class="pro-details">
             <span class="price mr-2">₹ 475</span>
             <!-- <span class="mrp">MRP</span> -->
             <span class="mrp-cut mr-2">₹ 950</span>
             <span class="discount">(50% OFF)</span>
          </p>
          </div>
          <div class="img-text">
            <p><span>HAND</span>-PICKED</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="column women">
    <div class="content">
      <div class="item">
        <div class=" card ">
           <div class="container1">
              <img class="img-fluid" src="{{ asset('frontend-assets/images/tops/t-7.jpg') }}" alt="Img">
              <div class="pro-details pt-4 ">
                 <p class="pro-name"> Kapachi</p>
                 <p class="pro-style mb-1">Western Top</p>
              </div>
           <p class="pro-details">
             <span class="price mr-2">₹ 475</span>
             <!-- <span class="mrp">MRP</span> -->
             <span class="mrp-cut mr-2">₹ 950</span>
             <span class="discount">(50% OFF)</span>
          </p>
          </div>
          <div class="img-text">
            <p><span>HAND</span>-PICKED</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="column male">
    <div class="content">
      <div class="item">
        <div class=" card ">
           <div class="container1">
              <img class="img-fluid" src="{{ asset('frontend-assets/images/tops/t-10.jpg') }}" alt="Img">
              <div class="pro-details pt-4 ">
                 <p class="pro-name"> Kapachi</p>
                 <p class="pro-style mb-1">Western Top</p>
              </div>
           <p class="pro-details">
             <span class="price mr-2">₹ 475</span>
             <!-- <span class="mrp">MRP</span> -->
             <span class="mrp-cut mr-2">₹ 950</span>
             <span class="discount">(50% OFF)</span>
          </p>
          </div>
          <div class="img-text">
            <p><span>HAND</span>-PICKED</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="column women">
    <div class="content">
      <div class="item">
        <div class=" card ">
           <div class="container1">
              <img class="img-fluid" src="{{ asset('frontend-assets/images/tops/t-6.jpg') }}" alt="Img">
              <div class="pro-details pt-4 ">
                 <p class="pro-name"> Kapachi</p>
                 <p class="pro-style mb-1">Western Top</p>
              </div>
           <p class="pro-details">
             <span class="price mr-2">₹ 475</span>
             <!-- <span class="mrp">MRP</span> -->
             <span class="mrp-cut mr-2">₹ 950</span>
             <span class="discount">(50% OFF)</span>
          </p>
          </div>
          <div class="img-text">
            <p><span>HAND</span>-PICKED</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="column male">
    <div class="content">
      <div class="item">
        <div class=" card ">
           <div class="container1">
              <img class="img-fluid" src="{{ asset('frontend-assets/images/tops/t-1.jpg') }}" alt="Img">
              <div class="pro-details pt-4 ">
                 <p class="pro-name"> Kapachi</p>
                 <p class="pro-style mb-1">Western Top</p>
              </div>
           <p class="pro-details">
             <span class="price mr-2">₹ 475</span>
             <!-- <span class="mrp">MRP</span> -->
             <span class="mrp-cut mr-2">₹ 950</span>
             <span class="discount">(50% OFF)</span>
          </p>
          </div>
          <div class="img-text">
            <p><span>HAND</span>-PICKED</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="column women">
    <div class="content">
      <div class="item">
        <div class=" card ">
           <div class="container1">
              <img class="img-fluid" src="{{ asset('frontend-assets/images/tops/t-8.jpg') }}" alt="Img">
              <div class="pro-details pt-4 ">
                 <p class="pro-name"> Kapachi</p>
                 <p class="pro-style mb-1">Western Top</p>
              </div>
           <p class="pro-details">
             <span class="price mr-2">₹ 475</span>
             <!-- <span class="mrp">MRP</span> -->
             <span class="mrp-cut mr-2">₹ 950</span>
             <span class="discount">(50% OFF)</span>
          </p>
          </div>
          <div class="img-text">
            <p><span>HAND</span>-PICKED</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="column male">
    <div class="content">
      <div class="item">
        <div class=" card ">
           <div class="container1">
              <img class="img-fluid" src="{{ asset('frontend-assets/images/tops/t-18.jpg') }}" alt="Img">
              <div class="pro-details pt-4 ">
                 <p class="pro-name"> Kapachi</p>
                 <p class="pro-style mb-1">Western Top</p>
              </div>
           <p class="pro-details">
             <span class="price mr-2">₹ 475</span>
             <!-- <span class="mrp">MRP</span> -->
             <span class="mrp-cut mr-2">₹ 950</span>
             <span class="discount">(50% OFF)</span>
          </p>
          </div>
          <div class="img-text">
            <p><span>HAND</span>-PICKED</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="column women">
    <div class="content">
      <div class="item">
        <div class=" card ">
           <div class="container1">
              <img class="img-fluid" src="{{ asset('frontend-assets/images/tops/t-7.jpg') }}" alt="Img">
              <div class="pro-details pt-4 ">
                 <p class="pro-name"> Kapachi</p>
                 <p class="pro-style mb-1">Western Top</p>
              </div>
           <p class="pro-details">
             <span class="price mr-2">₹ 475</span>
             <!-- <span class="mrp">MRP</span> -->
             <span class="mrp-cut mr-2">₹ 950</span>
             <span class="discount">(50% OFF)</span>
          </p>
          </div>
          <div class="img-text">
            <p><span>HAND</span>-PICKED</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="column male">
    <div class="content">
      <div class="item">
        <div class=" card ">
           <div class="container1">
              <img class="img-fluid" src="{{ asset('frontend-assets/images/tops/t-10.jpg') }}" alt="Img">
              <div class="pro-details pt-4 ">
                 <p class="pro-name"> Kapachi</p>
                 <p class="pro-style mb-1">Western Top</p>
              </div>
           <p class="pro-details">
             <span class="price mr-2">₹ 475</span>
             <!-- <span class="mrp">MRP</span> -->
             <span class="mrp-cut mr-2">₹ 950</span>
             <span class="discount">(50% OFF)</span>
          </p>
          </div>
          <div class="img-text">
            <p><span>HAND</span>-PICKED</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="column women">
    <div class="content">
      <div class="item">
        <div class=" card ">
           <div class="container1">
              <img class="img-fluid" src="{{ asset('frontend-assets/images/tops/t-4.jpg') }}" alt="Img">
              <div class="pro-details pt-4 ">
                 <p class="pro-name"> Kapachi</p>
                 <p class="pro-style mb-1">Western Top</p>
              </div>
           <p class="pro-details">
             <span class="price mr-2">₹ 475</span>
             <!-- <span class="mrp">MRP</span> -->
             <span class="mrp-cut mr-2">₹ 950</span>
             <span class="discount">(50% OFF)</span>
          </p>
          </div>
          <div class="img-text">
            <p><span>HAND</span>-PICKED</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="column male">
    <div class="content">
      <div class="item">
        <div class=" card ">
           <div class="container1">
              <img class="img-fluid" src="{{ asset('frontend-assets/images/tops/t-9.jpg') }}" alt="Img">
              <div class="pro-details pt-4 ">
                 <p class="pro-name"> Kapachi</p>
                 <p class="pro-style mb-1">Western Top</p>
              </div>
           <p class="pro-details">
             <span class="price mr-2">₹ 475</span>
             <!-- <span class="mrp">MRP</span> -->
             <span class="mrp-cut mr-2">₹ 950</span>
             <span class="discount">(50% OFF)</span>
          </p>
          </div>
          <div class="img-text">
            <p><span>HAND</span>-PICKED</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="column women">
    <div class="content">
      <div class="item">
        <div class=" card ">
           <div class="container1">
              <img class="img-fluid" src="{{ asset('frontend-assets/images/tops/t-8.jpg') }}" alt="Img">
              <div class="pro-details pt-4 ">
                 <p class="pro-name"> Kapachi</p>
                 <p class="pro-style mb-1">Western Top</p>
              </div>
           <p class="pro-details">
             <span class="price mr-2">₹ 475</span>
             <!-- <span class="mrp">MRP</span> -->
             <span class="mrp-cut mr-2">₹ 950</span>
             <span class="discount">(50% OFF)</span>
          </p>
          </div>
          <div class="img-text">
            <p><span>HAND</span>-PICKED</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="column male">
    <div class="content">
      <div class="item">
        <div class=" card ">
           <div class="container1">
              <img class="img-fluid" src="{{ asset('frontend-assets/images/tops/t-1.jpg') }}" alt="Img">
              <div class="pro-details pt-4 ">
                 <p class="pro-name"> Kapachi</p>
                 <p class="pro-style mb-1">Western Top</p>
              </div>
           <p class="pro-details">
             <span class="price mr-2">₹ 475</span>
             <!-- <span class="mrp">MRP</span> -->
             <span class="mrp-cut mr-2">₹ 950</span>
             <span class="discount">(50% OFF)</span>
          </p>
          </div>
          <div class="img-text">
            <p><span>HAND</span>-PICKED</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="column women">
    <div class="content">
      <div class="item">
        <div class=" card ">
           <div class="container1">
              <img class="img-fluid" src="{{ asset('frontend-assets/images/tops/t-6.jpg') }}" alt="Img">
              <div class="pro-details pt-4 ">
                 <p class="pro-name"> Kapachi</p>
                 <p class="pro-style mb-1">Western Top</p>
              </div>
           <p class="pro-details">
             <span class="price mr-2">₹ 475</span>
             <!-- <span class="mrp">MRP</span> -->
             <span class="mrp-cut mr-2">₹ 950</span>
             <span class="discount">(50% OFF)</span>
          </p>
          </div>
          <div class="img-text">
            <p><span>HAND</span>-PICKED</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="column male">
    <div class="content">
      <div class="item">
        <div class=" card ">
           <div class="container1">
              <img class="img-fluid" src="{{ asset('frontend-assets/images/tops/t-18.jpg') }}" alt="Img">
              <div class="pro-details pt-4 ">
                 <p class="pro-name"> Kapachi</p>
                 <p class="pro-style mb-1">Western Top</p>
              </div>
           <p class="pro-details">
             <span class="price mr-2">₹ 475</span>
             <!-- <span class="mrp">MRP</span> -->
             <span class="mrp-cut mr-2">₹ 950</span>
             <span class="discount">(50% OFF)</span>
          </p>
          </div>
          <div class="img-text">
            <p><span>HAND</span>-PICKED</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="column women">
    <div class="content">
      <div class="item">
        <div class=" card ">
           <div class="container1">
              <img class="img-fluid" src="{{ asset('frontend-assets/images/tops/t-7.jpg') }}" alt="Img">
              <div class="pro-details pt-4 ">
                 <p class="pro-name"> Kapachi</p>
                 <p class="pro-style mb-1">Western Top</p>
              </div>
           <p class="pro-details">
             <span class="price mr-2">₹ 475</span>
             <!-- <span class="mrp">MRP</span> -->
             <span class="mrp-cut mr-2">₹ 950</span>
             <span class="discount">(50% OFF)</span>
          </p>
          </div>
          <div class="img-text">
            <p><span>HAND</span>-PICKED</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="column male">
    <div class="content">
      <div class="item">
        <div class=" card ">
           <div class="container1">
              <img class="img-fluid" src="{{ asset('frontend-assets/images/tops/t-18.jpg') }}" alt="Img">
              <div class="pro-details pt-4 ">
                 <p class="pro-name"> Kapachi</p>
                 <p class="pro-style mb-1">Western Top</p>
              </div>
           <p class="pro-details">
             <span class="price mr-2">₹ 475</span>
             <!-- <span class="mrp">MRP</span> -->
             <span class="mrp-cut mr-2">₹ 950</span>
             <span class="discount">(50% OFF)</span>
          </p>
          </div>
          <div class="img-text">
            <p><span>HAND</span>-PICKED</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="column women">
    <div class="content">
      <div class="item">
        <div class=" card ">
           <div class="container1">
              <img class="img-fluid" src="{{ asset('frontend-assets/images/tops/t-7.jpg') }}" alt="Img">
              <div class="pro-details pt-4 ">
                 <p class="pro-name"> Kapachi</p>
                 <p class="pro-style mb-1">Western Top</p>
              </div>
           <p class="pro-details">
             <span class="price mr-2">₹ 475</span>
             <!-- <span class="mrp">MRP</span> -->
             <span class="mrp-cut mr-2">₹ 950</span>
             <span class="discount">(50% OFF)</span>
          </p>
          </div>
          <div class="img-text">
            <p><span>HAND</span>-PICKED</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="column male">
    <div class="content">
      <div class="item">
        <div class=" card ">
           <div class="container1">
              <img class="img-fluid" src="{{ asset('frontend-assets/images/tops/t-10.jpg') }}" alt="Img">
              <div class="pro-details pt-4 ">
                 <p class="pro-name"> Kapachi</p>
                 <p class="pro-style mb-1">Western Top</p>
              </div>
           <p class="pro-details">
             <span class="price mr-2">₹ 475</span>
             <!-- <span class="mrp">MRP</span> -->
             <span class="mrp-cut mr-2">₹ 950</span>
             <span class="discount">(50% OFF)</span>
          </p>
          </div>
          <div class="img-text">
            <p><span>HAND</span>-PICKED</p>
          </div>
        </div>

      </div>
    </div>
  </div>
  <div class="column women">
    <div class="content">
      <div class="item">
        <div class=" card ">
           <div class="container1">
              <img class="img-fluid" src="{{ asset('frontend-assets/images/tops/t-8.jpg') }}" alt="Img">
              <div class="pro-details pt-4 ">
                 <p class="pro-name"> Kapachi</p>
                 <p class="pro-style mb-1">Western Top</p>
              </div>
           <p class="pro-details">
             <span class="price mr-2">₹ 475</span>
             <!-- <span class="mrp">MRP</span> -->
             <span class="mrp-cut mr-2">₹ 950</span>
             <span class="discount">(50% OFF)</span>
          </p>
          </div>
          <div class="img-text">
            <p><span>HAND</span>-PICKED</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="column male">
    <div class="content">
      <div class="item">
        <div class=" card ">
           <div class="container1">
              <img class="img-fluid" src="{{ asset('frontend-assets/images/tops/t-18.jpg') }}" alt="Img">
              <div class="pro-details pt-4 ">
                 <p class="pro-name"> Kapachi</p>
                 <p class="pro-style mb-1">Western Top</p>
              </div>
           <p class="pro-details">
             <span class="price mr-2">₹ 475</span>
             <!-- <span class="mrp">MRP</span> -->
             <span class="mrp-cut mr-2">₹ 950</span>
             <span class="discount">(50% OFF)</span>
          </p>
          </div>
          <div class="img-text">
            <p><span>HAND</span>-PICKED</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="column women">
    <div class="content">
      <div class="item">
        <div class=" card ">
           <div class="container1">
              <img class="img-fluid" src="{{ asset('frontend-assets/images/tops/t-7.jpg') }}" alt="Img">
              <div class="pro-details pt-4 ">
                 <p class="pro-name"> Kapachi</p>
                 <p class="pro-style mb-1">Western Top</p>
              </div>
           <p class="pro-details">
             <span class="price mr-2">₹ 475</span>
             <!-- <span class="mrp">MRP</span> -->
             <span class="mrp-cut mr-2">₹ 950</span>
             <span class="discount">(50% OFF)</span>
          </p>
          </div>
          <div class="img-text">
            <p><span>HAND</span>-PICKED</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="column male">
    <div class="content">
      <div class="item">
        <div class=" card ">
           <div class="container1">
              <img class="img-fluid" src="{{ asset('frontend-assets/images/tops/t-5.jpg') }}" alt="Img">
              <div class="pro-details pt-4 ">
                 <p class="pro-name"> Kapachi</p>
                 <p class="pro-style mb-1">Western Top</p>
              </div>
           <p class="pro-details">
             <span class="price mr-2">₹ 475</span>
             <!-- <span class="mrp">MRP</span> -->
             <span class="mrp-cut mr-2">₹ 950</span>
             <span class="discount">(50% OFF)</span>
          </p>
          </div>
          <div class="img-text">
            <p><span>HAND</span>-PICKED</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="column women">
    <div class="content">
      <div class="item">
        <div class=" card ">
           <div class="container1">
              <img class="img-fluid" src="{{ asset('frontend-assets/images/tops/t-8.jpg') }}" alt="Img">
              <div class="pro-details pt-4 ">
                 <p class="pro-name"> Kapachi</p>
                 <p class="pro-style mb-1">Western Top</p>
              </div>
           <p class="pro-details">
             <span class="price mr-2">₹ 475</span>
             <!-- <span class="mrp">MRP</span> -->
             <span class="mrp-cut mr-2">₹ 950</span>
             <span class="discount">(50% OFF)</span>
          </p>
          </div>
          <div class="img-text">
            <p><span>HAND</span>-PICKED</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="column male">
    <div class="content">
      <div class="item">
        <div class=" card ">
           <div class="container1">
              <img class="img-fluid" src="{{ asset('frontend-assets/images/tops/t-5.jpg') }}" alt="Img">
              <div class="pro-details pt-4 ">
                 <p class="pro-name"> Kapachi</p>
                 <p class="pro-style mb-1">Western Top</p>
              </div>
           <p class="pro-details">
             <span class="price mr-2">₹ 475</span>
             <!-- <span class="mrp">MRP</span> -->
             <span class="mrp-cut mr-2">₹ 950</span>
             <span class="discount">(50% OFF)</span>
          </p>
          </div>
          <div class="img-text">
            <p><span>HAND</span>-PICKED</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="column male">
    <div class="content">
      <div class="item">
        <div class=" card ">
           <div class="container1">
              <img class="img-fluid" src="{{ asset('frontend-assets/images/tops/t-18.jpg') }}" alt="Img">
              <div class="pro-details pt-4 ">
                 <p class="pro-name"> Kapachi</p>
                 <p class="pro-style mb-1">Western Top</p>
              </div>
           <p class="pro-details">
             <span class="price mr-2">₹ 475</span>
             <!-- <span class="mrp">MRP</span> -->
             <span class="mrp-cut mr-2">₹ 950</span>
             <span class="discount">(50% OFF)</span>
          </p>
          </div>
          <div class="img-text">
            <p><span>HAND</span>-PICKED</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="column women">
    <div class="content">
      <div class="item">
        <div class=" card ">
           <div class="container1">
              <img class="img-fluid" src="{{ asset('frontend-assets/images/tops/t-4.jpg') }}" alt="Img">
              <div class="pro-details pt-4 ">
                 <p class="pro-name"> Kapachi</p>
                 <p class="pro-style mb-1">Western Top</p>
              </div>
           <p class="pro-details">
             <span class="price mr-2">₹ 475</span>
             <!-- <span class="mrp">MRP</span> -->
             <span class="mrp-cut mr-2">₹ 950</span>
             <span class="discount">(50% OFF)</span>
          </p>
          </div>
          <div class="img-text">
            <p><span>HAND</span>-PICKED</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="column male">
    <div class="content">
      <div class="item">
        <div class=" card ">
           <div class="container1">
              <img class="img-fluid" src="{{ asset('frontend-assets/images/tops/t-10.jpg') }}" alt="Img">
              <div class="pro-details pt-4 ">
                 <p class="pro-name"> Kapachi</p>
                 <p class="pro-style mb-1">Western Top</p>
              </div>
           <p class="pro-details">
             <span class="price mr-2">₹ 475</span>
             <!-- <span class="mrp">MRP</span> -->
             <span class="mrp-cut mr-2">₹ 950</span>
             <span class="discount">(50% OFF)</span>
          </p>
          </div>
          <div class="img-text">
            <p><span>HAND</span>-PICKED</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="column women">
    <div class="content">
      <div class="item">
        <div class=" card ">
           <div class="container1">
              <img class="img-fluid" src="{{ asset('frontend-assets/images/tops/t-2.jpg') }}" alt="Img">
              <div class="pro-details pt-4 ">
                 <p class="pro-name"> Kapachi</p>
                 <p class="pro-style mb-1">Western Top</p>
              </div>
           <p class="pro-details">
             <span class="price mr-2">₹ 475</span>
             <!-- <span class="mrp">MRP</span> -->
             <span class="mrp-cut mr-2">₹ 950</span>
             <span class="discount">(50% OFF)</span>
          </p>
          </div>
          <div class="img-text">
            <p><span>HAND</span>-PICKED</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="column women">
    <div class="content">
      <div class="item">
        <div class=" card ">
           <div class="container1">
              <img class="img-fluid" src="{{ asset('frontend-assets/images/tops/t-6.jpg') }}" alt="Img">
              <div class="pro-details pt-4 ">
                 <p class="pro-name"> Kapachi</p>
                 <p class="pro-style mb-1">Western Top</p>
              </div>
           <p class="pro-details">
             <span class="price mr-2">₹ 475</span>
             <!-- <span class="mrp">MRP</span> -->
             <span class="mrp-cut mr-2">₹ 950</span>
             <span class="discount">(50% OFF)</span>
          </p>
          </div>
          <div class="img-text">
            <p><span>HAND</span>-PICKED</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="column male">
    <div class="content">
      <div class="item">
        <div class=" card ">
           <div class="container1">
              <img class="img-fluid" src="{{ asset('frontend-assets/images/tops/t-10.jpg') }}" alt="Img">
              <div class="pro-details pt-4 ">
                 <p class="pro-name"> Kapachi</p>
                 <p class="pro-style mb-1">Western Top</p>
              </div>
           <p class="pro-details">
             <span class="price mr-2">₹ 475</span>
             <!-- <span class="mrp">MRP</span> -->
             <span class="mrp-cut mr-2">₹ 950</span>
             <span class="discount">(50% OFF)</span>
          </p>
          </div>
          <div class="img-text">
            <p><span>HAND</span>-PICKED</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="column male">
    <div class="content">
      <div class="item">
        <div class=" card ">
           <div class="container1">
              <img class="img-fluid" src="{{ asset('frontend-assets/images/tops/t-18.jpg') }}" alt="Img">
              <div class="pro-details pt-4 ">
                 <p class="pro-name"> Kapachi</p>
                 <p class="pro-style mb-1">Western Top</p>
              </div>
           <p class="pro-details">
             <span class="price mr-2">₹ 475</span>
             <!-- <span class="mrp">MRP</span> -->
             <span class="mrp-cut mr-2">₹ 950</span>
             <span class="discount">(50% OFF)</span>
          </p>
          </div>
          <div class="img-text">
            <p><span>HAND</span>-PICKED</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="column women">
    <div class="content">
      <div class="item">
        <div class=" card ">
           <div class="container1">
              <img class="img-fluid" src="{{ asset('frontend-assets/images/tops/t-2.jpg') }}" alt="Img">
              <div class="pro-details pt-4 ">
                 <p class="pro-name"> Kapachi</p>
                 <p class="pro-style mb-1">Western Top</p>
              </div>
           <p class="pro-details">
             <span class="price mr-2">₹ 475</span>
             <!-- <span class="mrp">MRP</span> -->
             <span class="mrp-cut mr-2">₹ 950</span>
             <span class="discount">(50% OFF)</span>
          </p>
          </div>
          <div class="img-text">
            <p><span>HAND</span>-PICKED</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="column male">
    <div class="content">
      <div class="item">
        <div class=" card ">
           <div class="container1">
              <img class="img-fluid" src="{{ asset('frontend-assets/images/tops/t-9.jpg') }}" alt="Img">
              <div class="pro-details pt-4 ">
                 <p class="pro-name"> Kapachi</p>
                 <p class="pro-style mb-1">Western Top</p>
              </div>
           <p class="pro-details">
             <span class="price mr-2">₹ 475</span>
             <!-- <span class="mrp">MRP</span> -->
             <span class="mrp-cut mr-2">₹ 950</span>
             <span class="discount">(50% OFF)</span>
          </p>
          </div>
          <div class="img-text">
            <p><span>HAND</span>-PICKED</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="column women">
    <div class="content">
      <div class="item">
        <div class=" card ">
           <div class="container1">
              <img class="img-fluid" src="{{ asset('frontend-assets/images/tops/t-4.jpg') }}" alt="Img">
              <div class="pro-details pt-4 ">
                 <p class="pro-name"> Kapachi</p>
                 <p class="pro-style mb-1">Western Top</p>
              </div>
           <p class="pro-details">
             <span class="price mr-2">₹ 475</span>
             <!-- <span class="mrp">MRP</span> -->
             <span class="mrp-cut mr-2">₹ 950</span>
             <span class="discount">(50% OFF)</span>
          </p>
          </div>
          <div class="img-text">
            <p><span>HAND</span>-PICKED</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="column male">
    <div class="content">
      <div class="item">
        <div class=" card ">
           <div class="container1">

              <img class="img-fluid" src="{{ asset('frontend-assets/images/tops/t-1.jpg') }}" alt="Img">
              <div class="pro-details pt-4 ">
                 <p class="pro-name"> Kapachi</p>
                 <p class="pro-style mb-1">Western Top</p>
              </div>
           <p class="pro-details">
             <span class="price mr-2">₹ 475</span>
             <!-- <span class="mrp">MRP</span> -->
             <span class="mrp-cut mr-2">₹ 950</span>
             <span class="discount">(50% OFF)</span>
          </p>
          </div>
          <div class="img-text">
            <p><span>HAND</span>-PICKED</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="column women">
    <div class="content">
      <div class="item">
        <div class=" card ">
           <div class="container1">
              <img class="img-fluid" src="{{ asset('frontend-assets/images/tops/t-7.jpg') }}" alt="Img">
              <div class="pro-details pt-4 ">
                 <p class="pro-name"> Kapachi</p>
                 <p class="pro-style mb-1">Western Top</p>
              </div>
           <p class="pro-details">
             <span class="price mr-2">₹ 475</span>
             <!-- <span class="mrp">MRP</span> -->
             <span class="mrp-cut mr-2">₹ 950</span>
             <span class="discount">(50% OFF)</span>
          </p>
          </div>
          <div class="img-text">
            <p><span>HAND</span>-PICKED</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="column male">
    <div class="content">
      <div class="item">
        <div class=" card ">
           <div class="container1">
              <img class="img-fluid" src="{{ asset('frontend-assets/images/tops/t-10.jpg') }}" alt="Img">
              <div class="pro-details pt-4 ">
                 <p class="pro-name"> Kapachi</p>
                 <p class="pro-style mb-1">Western Top</p>
              </div>
           <p class="pro-details">
             <span class="price mr-2">₹ 475</span>
             <!-- <span class="mrp">MRP</span> -->
             <span class="mrp-cut mr-2">₹ 950</span>
             <span class="discount">(50% OFF)</span>
          </p>
          </div>
          <div class="img-text">
            <p><span>HAND</span>-PICKED</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="column women">
    <div class="content">
      <div class="item">
        <div class=" card ">
           <div class="container1">
              <img class="img-fluid" src="{{ asset('frontend-assets/images/tops/t-7.jpg') }}" alt="Img">
              <div class="pro-details pt-4 ">
                 <p class="pro-name"> Kapachi</p>
                 <p class="pro-style mb-1">Western Top</p>
              </div>
           <p class="pro-details">
             <span class="price mr-2">₹ 475</span>
             <!-- <span class="mrp">MRP</span> -->
             <span class="mrp-cut mr-2">₹ 950</span>
             <span class="discount">(50% OFF)</span>
          </p>
          </div>
          <div class="img-text">
            <p><span>HAND</span>-PICKED</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="column male">
    <div class="content">
      <div class="item">
        <div class=" card ">
           <div class="container1">
              <img class="img-fluid" src="{{ asset('frontend-assets/images/tops/t-10.jpg') }}" alt="Img">
              <div class="pro-details pt-4 ">
                 <p class="pro-name"> Kapachi</p>
                 <p class="pro-style mb-1">Western Top</p>
              </div>
           <p class="pro-details">
             <span class="price mr-2">₹ 475</span>
             <!-- <span class="mrp">MRP</span> -->
             <span class="mrp-cut mr-2">₹ 950</span>
             <span class="discount">(50% OFF)</span>
          </p>
          </div>
          <div class="img-text">
            <p><span>HAND</span>-PICKED</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<!-- men women view all tabs end -->
<script>
filterSelection("all")
function filterSelection(c) {
var x, i;
x = document.getElementsByClassName("column");
if (c == "all") c = "";
for (i = 0; i < x.length; i++) {
  w3RemoveClass(x[i], "show");
  if (x[i].className.indexOf(c) > -1) w3AddClass(x[i], "show");
}
}
function w3AddClass(element, name) {
var i, arr1, arr2;
arr1 = element.className.split(" ");
arr2 = name.split(" ");
for (i = 0; i < arr2.length; i++) {
  if (arr1.indexOf(arr2[i]) == -1) {element.className += " " + arr2[i];}
}
}
function w3RemoveClass(element, name) {
var i, arr1, arr2;
arr1 = element.className.split(" ");
arr2 = name.split(" ");
for (i = 0; i < arr2.length; i++) {
  while (arr1.indexOf(arr2[i]) > -1) {
    arr1.splice(arr1.indexOf(arr2[i]), 1);
  }
}
element.className = arr1.join(" ");
}

// Add active class to the current button (highlight it)
var btnContainer = document.getElementById("myBtnFilter");
var btns = btnContainer.getElementsByClassName("btn1");
for (var i = 0; i < btns.length; i++) {
btns[i].addEventListener("click", function(){
  var current = document.getElementsByClassName("active");
  current[0].className = current[0].className.replace(" active", "");
  this.className += " active";
});
}
// $(this).addClass('active').siblings().removeClass('active');
//     $('.buttons').click(function(){
// $('.buttons').removeClass('active');
// $(this).addClass('active');
</script>
@endsection
