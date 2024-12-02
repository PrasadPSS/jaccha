@extends('frontend.layouts.app')
@section('title','MyAccount')
@section('content')


<!--Account panel section start-->
<div class="container top-padding ">
  <div class="row ">
		<div class="col-lg-12 col-md-12 col-sm-12 col-12">
			<div class="account-panel">
				<div class="row">
					<div class="col-md-4 col-sm-4 col-6">
						<div class="">
							<img src="{{ asset('frontend-assets/images/user.jpg') }}" class="ac-user img-fluid" alt="">
						</div>
					</div>
					<div class="col-md-8 col-sm-8 col-6">
						<div class="ac-panel-edit">
							<button type="submit" name="button">EDIT</button>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4 col-sm-4 col-6">
						<div class="ac-name-edit">
							<p>ACCOUNT:  DILIP PARWANI</p>
						</div>
					</div>
					<div class="col-md-8 col-sm-8 col-6">
						<div class="ac-name-edit ac-panel-edit">
							<p>Edit your profile details and change password</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row ac-over-form-row">
		<div class="col-md-4 col-sm-12 col-12">
			<div class="ac-over-form  h-100">
				<div class="ac-overview-head">
					<h1>OVERVIEW</h1>
				</div>
				<div class="ac-overview-list">
					<div class="overview-list">
						<p class="overview-list-head">Your Orders</p>
						<p class="overview-list-subhead"><a href="{{ url('/track') }}">Track your order</a></p>
						<p class="overview-list-subhead"><a href="#">Cancel your order</a></p>
						<p class="overview-list-subhead"><a href="#">Return your order</a></p>
						<p class="overview-list-subhead"><a href="#">Browse your order history</a></p>
					</div>
					<div class="overview-list">
						<p class="overview-list-head">Your Wishlist</p>
						<p class="overview-list-subhead"><a href="#">See your wishlist</a></p>
					</div>
					<div class="overview-list">
						<p class="overview-list-head">Manage Your Addresses</p>
						<p class="overview-list-subhead"><a href="#">Edit, add or remove your addresses</a></p>
					</div>
					<div class="overview-list">
				<p class="overview-list-head">Manage Coupons</p>
				<p class="overview-list-subhead"><a href="#">Dadreeios Coupons</a></p>
			</div>
			<div class="overview-list">
				<p class="overview-list-logout"><a href="#">Logout</a></p>
			</div>
				</div>
			</div>
		</div>
		<div class="col-md-8 col-sm-12 col-12 margin-ac-over-form">
			<div class="ac-over-form ">
					<div class="ac-form">
						<form class="account-form" action="" method="post" onsubmit="return myRegistration()">
							<div class="form-row">
							<div class="form-group col-md-12">
							<div class="input-wrapper">
								<input class="form-control form-control-h" type="text" required="">
								<label class="" for="user">Full Name <span class="star">*</span></label>
							</div>
							</div>
							<div class="form-group col-md-12">
							<div class="input-wrapper">
							<input class="form-control form-control-h" type="email" required="">
							<label for="user">Email ID <span class="star">*</span></label>
							</div>
							</div>
							<div class="form-group col-md-12 remove-margin">
								<div class="form-row">
									<div class="col-md-8 col-12  ">
										<div class="input-wrapper">
											<input class="password form-control form-control-h" name="login[password]" type="password" required="">
										<label for="user">Enter Password <span class="star">*</span></label>
										<div class="hide-show" style="display: block;">
											<span class="show">Show</span>
										</div>
										</div>
									</div>
									<div class="col-md-4 col-12 ">
										<button class="w-100 ac-password-btn" type="submit" name="button">CHANGE PASSWORD</button>
									</div>
								</div>

								</div>
								<div class="form-group col-md-12">
								<div class="input-wrapper">
								<input class="form-control form-control-h" type="text" id="mobnumber" required="">
								<label for="user">Mobile Phone Number <span class="star">*</span></label>
								<span class="number-msg" id="messages"></span>
								<span class="number-verified">Verified</span>
								</div>
								</div>
								<div class="form-group col-md-12">
								<div class="input-wrapper">
								<input class="form-control form-control-h" type="text" id="mobnumber" required="">
								<label for="user">Alternate Mobile Phone Number</label>
								<span class="number-msg" id="messages"></span>
								</div>
								</div>
								<div class="form-group col-md-12">
								<div class="input-wrapper icon-calendar">
									<input class="form-control form-control-h" type="text" data-date-format="dd/mm/yyyy" id="datepicker" required="">
									<label for="user">Date Of Birth</label>
									<!-- <span class="calendar"><i class="fa fa-calendar" aria-hidden="true"></i></span> -->
								</div>
								</div>
								<div class="form-group col-md-12">
									<div class="form-row">
										<div class="col-md-4 col-4 my-auto">
											<label class="select-gender" for="user">Select Gender</label>
										</div>
										<div class="col-md-4 col-4 male-col gender-mf">
											<div class="regi-radio-btn active ">
												<!-- <input type="radio" name='gender' checked ><label for="radioBanana">Female</label> -->
												<input type="radio" id="male" name="radiogender" value="">
												<label class="float-right" for="male">Male</label>
											</div>
												</div>
										<div class="col-md-4 col-4 female-col gender-mf">
											<div class="regi-radio-btn">
												<!-- <input type="radio" name='gender' ><label for="radioBanana">male</label> -->
												<input type="radio" id="female" name="radiogender" value="">
												<label class="float-right" for="female">Female</label>
											</div>
												</div>
									</div>
								</div>
								<div class="form-group col-md-12  terms-conditions-size">
											<button type="submit" class="ac-save-btn btn-block  text-center " href="#">SAVE CHANGES</button>
								</div>
								</div>
						</form>
					</div>
			</div>
		</div>
	</div>
</div>
<!--Account panel section end-->

@endsection
