<div class="ac-over-form  h-100">
  <div class="ac-overview-head">
    <h1>OVERVIEW</h1>
  </div>
  <div class="ac-overview-list">
    <div class="overview-list">
      <p class="overview-list-head">Your Orders</p>
      <p class="overview-list-subhead"><a href="{{ route('myaccount.orders') }}">Track your order</a></p>
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
      <p class="overview-list-subhead"><a href="{{ route('addresses') }}">Edit, add or remove your addresses</a></p>
    </div>
    <div class="overview-list">
  <p class="overview-list-head">Manage Coupons</p>
  <p class="overview-list-subhead"><a href="#">Dadreeios Coupons</a></p>
</div>
<div class="overview-list">
  <p class="overview-list-logout"><a href="{{ url('/logout') }}">Logout</a></p>
</div>
  </div>
</div>
