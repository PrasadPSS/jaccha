@extends('backend.layouts.app')
@section('title', 'Admin-Dashboard')
@section('content')
    <!-- begin::Body -->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- Dashboard Ecommerce Starts -->
                <section id="dashboard-ecommerce">
                    <div class="row">
                        <!-- Greetings Content Starts -->
                        <div class="col-xl-4 col-md-6 col-12 dashboard-greetings">
                            <div class="card d-none">
                                <div class="card-header">
                                    <h3 class="greeting-text">Congratulations John!</h3>
                                    <p class="mb-0">Best seller of the month</p>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-end">
                                            <div class="dashboard-content-left">
                                                <h1 class="text-primary font-large-2 text-bold-500">$89k</h1>
                                                <p>You have done 57.6% more sales today.</p>
                                                <button type="button" class="btn btn-primary glow">View Sales</button>
                                            </div>
                                            <div class="dashboard-content-right">
                                                <img src="{{ asset('backend-assets/images/icon/cup.png') }}"
                                                    height="220" width="220" class="img-fluid"
                                                    alt="Dashboard Ecommerce" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Multi Radial Chart Starts -->
                        <div class="col-xl-4 col-md-6 col-12 dashboard-visit">
                            <div class="card d-none">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h4 class="card-title">Visits of 2019</h4>
                                    <i class="bx bx-dots-vertical-rounded font-medium-3 cursor-pointer"></i>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <div id="multi-radial-chart"></div>
                                        <ul class="list-inline d-flex justify-content-around mb-0">
                                            <li> <span class="bullet bullet-xs bullet-primary mr-50"></span>Target</li>
                                            <li> <span class="bullet bullet-xs bullet-danger mr-50"></span>Mart</li>
                                            <li> <span class="bullet bullet-xs bullet-warning mr-50"></span>Ebay</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 col-12 dashboard-users">
                            <div class="row  ">
                                <!-- Statistics Cards Starts -->
                                <div class="col-12">
                                    <div class="row">
                                        {{-- <div class="col-sm-6 col-12 dashboard-users-success">
                                            <div class="card text-center">
                                                <div class="card-content">
                                                    <div class="card-body py-1">
                                                        <div
                                                            class="badge-circle badge-circle-lg badge-circle-light-success mx-auto mb-50">
                                                            <i class="bx bx-briefcase-alt font-medium-5"></i>
                                                        </div>
                                                        <div class="text-muted line-ellipsis">New Products</div>
                                                        <h3 class="mb-0">1.2k</h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-12 dashboard-users-danger">
                                            <div class="card text-center">
                                                <div class="card-content">
                                                    <div class="card-body py-1">
                                                        <div
                                                            class="badge-circle badge-circle-lg badge-circle-light-danger mx-auto mb-50">
                                                            <i class="bx bx-user font-medium-5"></i>
                                                        </div>
                                                        <div class="text-muted line-ellipsis">New Users</div>
                                                        <h3 class="mb-0">45.6k</h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> --}}
                                        {{-- on 24-11-22 --}}
                                        <div class="col-12">
                                            <div class="row">
                                                <div class="col-sm-3 col-12 dashboard-users-success">
                                                    <div class="card text-center">
                                                        <div class="card-content">
                                                            <div class="card-body py-1">
                                                                <div
                                                                    class="badge-circle badge-circle-lg badge-circle-light-success mx-auto mb-50">
                                                                    <i class="bx bx-briefcase-alt font-medium-5"></i>
                                                                </div>
                                                                <div class="text-muted line-ellipsis">New Products</div>
                                                                <h3 class="mb-0">{{ $products }}</h3>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3 col-12 dashboard-users-danger">
                                                    <div class="card text-center">
                                                        <div class="card-content">
                                                            <div class="card-body py-1">
                                                                <div
                                                                    class="badge-circle badge-circle-lg badge-circle-light-danger mx-auto mb-50">
                                                                    <i class="bx bx-user font-medium-5"></i>
                                                                </div>
                                                                <div class="text-muted line-ellipsis">Total Customers</div>
                                                                <h3 class="mb-0">{{ $user }}</h3>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3 col-12 dashboard-users-success">
                                                    <div class="card text-center">
                                                        <div class="card-content">
                                                            <div class="card-body py-1">
                                                                <div
                                                                    class="badge-circle badge-circle-lg badge-circle-light-success mx-auto mb-50">
                                                                    <i class="bx bx-briefcase-alt font-medium-5"></i>
                                                                </div>
                                                                <div class="text-muted line-ellipsis">Total Orders</div>
                                                                <h3 class="mb-0">{{ $order }}</h3>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-3 col-12 dashboard-users-danger">
                                                    <div class="card text-center">
                                                        <div class="card-content">
                                                            <div class="card-body py-1">
                                                                <div
                                                                    class="badge-circle badge-circle-lg badge-circle-light-danger mx-auto mb-50">
                                                                    <i class="bx bx-user font-medium-5"></i>
                                                                </div>
                                                                <div class="text-muted line-ellipsis">Today Order</div>
                                                                <h3 class="mb-0">{{ $records }}</h3>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

{{-- on 15-12-22 --}}
<div class="col-12">
    <div class="row">
        <div class="col-sm-3 col-12 dashboard-users-success">
            <div class="card text-center">
                <div class="card-content">
                    <div class="card-body py-1">
                        <div
                            class="badge-circle badge-circle-lg badge-circle-light-success mx-auto mb-50">
                            <i class="bx bx-briefcase-alt font-medium-5"></i>
                        </div>
                        <div class="text-muted line-ellipsis">Order Panding</div>
                        <h3 class="mb-0">{{ $orderpanding }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3 col-12 dashboard-users-danger">
            <div class="card text-center">
                <div class="card-content">
                    <div class="card-body py-1">
                        <div
                            class="badge-circle badge-circle-lg badge-circle-light-danger mx-auto mb-50">
                            <i class="bx bx-user font-medium-5"></i>
                        </div>
                        <div class="text-muted line-ellipsis">Orders Processing</div>
                        <h3 class="mb-0">{{ $orderproccesing }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3 col-12 dashboard-users-success">
            <div class="card text-center">
                <div class="card-content">
                    <div class="card-body py-1">
                        <div
                            class="badge-circle badge-circle-lg badge-circle-light-success mx-auto mb-50">
                            <i class="bx bx-briefcase-alt font-medium-5"></i>
                        </div>
                        <div class="text-muted line-ellipsis">Orders Delivered</div>
                        <h3 class="mb-0">{{ $orderdeliverd }}</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3 col-12 dashboard-users-danger">
            <div class="card text-center">
                <div class="card-content">
                    <div class="card-body py-1">
                        <div
                            class="badge-circle badge-circle-lg badge-circle-light-danger mx-auto mb-50">
                            <i class="bx bx-user font-medium-5"></i>
                        </div>
                        <div class="text-muted line-ellipsis">Orders Cancelled</div>
                        <h3 class="mb-0">{{ $ordercancel }}</h3>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3 col-12 dashboard-users-danger">
            <div class="card text-center">
                <div class="card-content">
                    <div class="card-body py-1">
                        <div
                            class="badge-circle badge-circle-lg badge-circle-light-danger mx-auto mb-50">
                            <i class="bx bx-user font-medium-5"></i>
                        </div>
                        <div class="text-muted line-ellipsis">Orders Return</div>
                        <h3 class="mb-0">{{ $orderreturn }}</h3>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3 col-12 dashboard-users-danger">
            <div class="card text-center">
                <div class="card-content">
                    <div class="card-body py-1">
                        <div
                            class="badge-circle badge-circle-lg badge-circle-light-danger mx-auto mb-50">
                            <i class="bx bx-user font-medium-5"></i>
                        </div>
                        <div class="text-muted line-ellipsis">Total Sales</div>
                        <h3 class="mb-0">{{ $totalsales }}</h3>

                    </div>
                </div>
            </div>
        </div>


        <div class="col-sm-3 col-12 dashboard-users-danger">
            <div class="card text-center">
                <div class="card-content">
                    <div class="card-body py-1">
                        <div
                            class="badge-circle badge-circle-lg badge-circle-light-danger mx-auto mb-50">
                            <i class="bx bx-user font-medium-5"></i>
                        </div>
                        <div class="text-muted line-ellipsis">Prepaid Orders</div>
                        <h3 class="mb-0">{{ $pre_paid_orders }}</h3>

                    </div>
                </div>
            </div>
        </div>


        <div class="col-sm-3 col-12 dashboard-users-danger">
            <div class="card text-center">
                <div class="card-content">
                    <div class="card-body py-1">
                        <div
                            class="badge-circle badge-circle-lg badge-circle-light-danger mx-auto mb-50">
                            <i class="bx bx-user font-medium-5"></i>
                        </div>
                        <div class="text-muted line-ellipsis">Cod Orders</div>
                        <h3 class="mb-0">{{ $cod }}</h3>

                    </div>
                </div>
            </div>
        </div>

{{--         
        <div class="col-sm-3 col-12 dashboard-users-danger">
            <div class="card text-center">
                <div class="card-content">
                    <div class="card-body py-1">
                        <div
                            class="badge-circle badge-circle-lg badge-circle-light-danger mx-auto mb-50">
                            <i class="bx bx-user font-medium-5"></i>
                        </div>
                        <div class="text-muted line-ellipsis">Total Cod Orders</div>
                        <h3 class="mb-0">{{ $total_cod }}</h3>

                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-3 col-12 dashboard-users-danger">
            <div class="card text-center">
                <div class="card-content">
                    <div class="card-body py-1">
                        <div
                            class="badge-circle badge-circle-lg badge-circle-light-danger mx-auto mb-50">
                            <i class="bx bx-user font-medium-5"></i>
                        </div>
                        <div class="text-muted line-ellipsis">Total Prepaid Orders</div>
                        <h3 class="mb-0">{{ $total_prepaid_orders }}</h3>

                    </div>
                </div>
            </div>
        </div> --}}
{{--  --}}






                                                {{-- end --}}
                                                {{-- <div class="col-xl-12 col-lg-6 col-12 dashboard-revenue-growth">
                                                    <div class="card d-none">
                                                        <div
                                                            class="card-header d-flex justify-content-between align-items-center pb-0">
                                                            <h4 class="card-title">Revenue Growth</h4>
                                                            <div class="d-flex align-items-end justify-content-end">
                                                                <span class="mr-25">$25,980</span>
                                                                <i
                                                                    class="bx bx-dots-vertical-rounded font-medium-3 cursor-pointer"></i>
                                                            </div>
                                                        </div>
                                                        <div class="card-content">
                                                            <div class="card-body pb-0">
                                                                <div id="revenue-growth-chart"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> --}}
                                            </div>
                                        </div>
                                        <!-- Revenue Growth Chart Starts -->
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-12 col-12 dashboard-order-summary">
                                    <div class="card">
                                        <div class="row">
                                            <!-- Order Summary Starts -->
                                            <div class="col-md-8 col-12 order-summary border-right pr-md-0">
                                                <div class="card mb-0">
                                                    <div
                                                        class="card-header d-flex justify-content-between align-items-center">
                                                        <h4 class="card-title">Order Summary</h4>
                                                        <div class="d-flex">
                                                            <button type="button"
                                                                class="btn btn-sm btn-light-primary mr-1">Month</button>
                                                            <button type="button"
                                                                class="btn btn-sm btn-primary glow">Week</button>
                                                        </div>
                                                    </div>
                                                    <div class="card-content">
                                                        <div class="card-body p-0">
                                                            <div id="order-summary-chart"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Sales History Starts -->
                                            <div class="col-md-4 col-12 pl-md-0">
                                                <div class="card mb-0">
                                                    <div class="card-header pb-50">
                                                        <h4 class="card-title">Sales History</h4>
                                                    </div>
                                                    <div class="card-content">
                                                        <div class="card-body py-1">
                                                            @foreach ($order_id as $ord)
                                                                <div
                                                                    class="d-flex justify-content-between align-items-center mb-2">
                                                                    <div class="sales-item-name">
                                                                        <p class="mb-0">{{ $ord->product_title }}</p>
                                                                        {{-- printing date --}}
                                                                        <small class="text-muted">

                                                                            {{ date('d-m-Y', strtotime($ord->created_at)) }}

                                                                        </small>

                                                                    </div>
                                                                    {{-- <div class="sales-item-amount">
                                                                        <h6 class="mb-0"><span
                                                                                class="text-success">+</span>
                                                                            $50</h6>
                                                                    </div> --}}
                                                                </div>
                                                            @endforeach

                                                        </div>
                                                        <div class="card-footer border-top pb-0">
                                                            <h5>Total Sales</h5>
                                                            <span
                                                                class="text-primary text-bold-500">{{ $order }}</span>
                                                            <div class="progress progress-bar-primary progress-sm my-50">
                                                                <div class="progress-bar" role="progressbar"
                                                                    aria-valuenow="78" style="width:78%">

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Latest Update Starts -->
                                    <div class="col-xl-4 col-md-6 col-12 dashboard-latest-update">
                                        <div class="card">
                                            <div
                                                class="card-header d-flex justify-content-between align-items-center pb-50">
                                                <h4 class="card-title">Latest Update</h4>
                                                <div class="dropdown">
                                                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle"
                                                        type="button" id="dropdownMenuButtonSec" data-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false">
                                                        2019
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButtonSec">
                                                        <a class="dropdown-item" href="#">2019</a>
                                                        <a class="dropdown-item" href="#">2018</a>
                                                        <a class="dropdown-item" href="#">2017</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-content">
                                                <div class="card-body p-0 pb-1">
                                                    <ul class="list-group list-group-flush">
                                                        <li
                                                            class="list-group-item list-group-item-action border-0 d-flex align-items-center justify-content-between">
                                                            <div class="list-left d-flex">
                                                                <div class="list-icon mr-1">
                                                                    <div class="avatar bg-rgba-primary m-0">
                                                                        <div class="avatar-content">
                                                                            <i
                                                                                class="bx bxs-zap text-primary font-size-base"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="list-content">
                                                                    <span class="list-title">Total Products</span>
                                                                    <small class="text-muted d-block">New
                                                                        Products</small>
                                                                </div>
                                                            </div>
                                                            <span>{{ $products }}</span>
                                                        </li>
                                                        {{-- <li
                                                            class="list-group-item list-group-item-action border-0 d-flex align-items-center justify-content-between">
                                                            <div class="list-left d-flex">
                                                                <div class="list-icon mr-1">
                                                                    <div class="avatar bg-rgba-info m-0">
                                                                        <div class="avatar-content">
                                                                            <i
                                                                                class="bx bx-stats text-info font-size-base"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="list-content d -none">
                                                                    <span class="list-title">Total Sales</span>
                                                                    <small class="text-muted d-block">39.4k New
                                                                        Sales</small>
                                                                </div>
                                                            </div>
                                                            <span>26M</span>
                                                        </li> --}}
                                                        {{-- <li
                                                            class="list-group-item list-group-item-action border-0 d-flex align-items-center justify-content-between">
                                                            <div class="list-left d-flex">
                                                                <div class="list-icon mr-1">
                                                                    <div class="avatar bg-rgba-danger m-0">
                                                                        <div class="avatar-content">
                                                                            <i
                                                                                class="bx bx-credit-card text-danger font-size-base"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="list-content">
                                                                    <span class="list-title">Total Revenue</span>
                                                                    <small class="text-muted d-block">43.5k New
                                                                        Revenue</small>
                                                                </div>
                                                            </div>
                                                            <span>15.89M</span>
                                                        </li>
                                                        <li
                                                            class="list-group-item list-group-item-action border-0 d-flex align-items-center justify-content-between">
                                                            <div class="list-left d-flex">
                                                                <div class="list-icon mr-1">
                                                                    <div class="avatar bg-rgba-success m-0">
                                                                        <div class="avatar-content">
                                                                            <i
                                                                                class="bx bx-dollar text-success font-size-base"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="list-content">
                                                                    <span class="list-title">Total Cost</span>
                                                                    <small class="text-muted d-block">Total
                                                                        Expenses</small>
                                                                </div>
                                                            </div>
                                                            <span>1.25B</span>
                                                        </li> --}}
                                                        <li
                                                            class="list-group-item list-group-item-action border-0 d-flex align-items-center justify-content-between">
                                                            <div class="list-left d-flex">
                                                                <div class="list-icon mr-1">
                                                                    <div class="avatar bg-rgba-primary m-0">
                                                                        <div class="avatar-content">
                                                                            <i
                                                                                class="bx bx-user text-primary font-size-base"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="list-content">
                                                                    <span class="list-title">Total Users</span>
                                                                    <small class="text-muted d-block">New Users</small>
                                                                </div>
                                                            </div>
                                                            <span>{{ $user }}</span>
                                                        </li>
                                                        <li
                                                            class="list-group-item list-group-item-action border-0 d-flex align-items-center justify-content-between">
                                                            <div class="list-left d-flex">
                                                                <div class="list-icon mr-1">
                                                                    <div class="avatar bg-rgba-danger m-0">
                                                                        <div class="avatar-content">
                                                                            <i
                                                                                class="bx bx-edit-alt text-danger font-size-base"></i>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="list-content">
                                                                    <span class="list-title">Total Order</span>
                                                                    <small class="text-muted d-block">New Order</small>
                                                                </div>
                                                            </div>
                                                            <span>{{ $order }}</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- resent order table start --}}


                                                {{-- <div id="basic-datatable"> --}}
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="card">
                                                                <div class="card-header">
                                                                    <h4 class="card-title">Orders
                                                                    </h4>
                                                                </div>
                                                                <div class="card-content">
                                                                    <div class="card-body card-dashboard">
                                                                    
                                                                        <div class="table-responsive">
                                                                            <table class="table  table-responsive" id="">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>#</th>
                                                                                        <th>Order Date</th>
                                                                                        <th>Order No.</th>
                                                                                        <th>Order Details</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    @if (isset($orderlist) && count($orderlist) > 0)
                                                                                        @php $srno = 1; @endphp
                                                                                        @foreach ($orderlist as $orders)

                                                                                            <tr>
                                                                                                <td>{{ $srno }}</td>
                                                                                            
                                                                                                <td>{{ date('d-m-Y H:i', strtotime($orders->created_at)) }}</td>
                                                                                                <td>{{ $orders->order_id }}</td>
                                                                                                <td>
                                                                                                    <a href="{{ url('admin/orders/details/' . $orders->order_id) }}"
                                                                                                        class="dropdown-item">View Details</a>
                                                                                                </td>
                                                                                            </tr>
                                                                                            @php $srno++; @endphp
                                                                                        @endforeach
                                                                                    @endif
                                                                                </tbody>

                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="card">
                                                                <div class="card-header">
                                                                    <h4 class="card-title">Recent Customers
                                                                    </h4>
                                                                </div>
                                                                <div class="card-content">
                                                                    <div class="card-body card-dashboard">
                                                                    
                                                                        <div class="table-responsive">
                                                                            <table class="table  table-responsive" id="">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>#</th>
                                                                                        <th>Customer Email</th>
                                                                                        <th>Date</th>
                                                                                        <th>Details</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    @if (isset($customerlist) && count($customerlist) > 0)
                                                                                                @php $srno = 1; @endphp
                                                                                                @foreach ($customerlist as $customer)
                    
                                                                                                                    <tr>
                                                                                                                        <td>{{ $srno }}</td>
                                                                                                                        <td>{{ $customer->email }}</td>
                                                                                                                        <td>{{ date('d-m-Y H:i', strtotime($customer->created_at)) }}</td>
                                                                                                                        <td>
                                                                                                                            <a href="{{ url('admin/externalusers/editstatus/'.$customer->id) }}" class="btn btn-primary"><i class="bx bx-lock"></i></a>
                                                                                                                               
                                                                                                                        </td>
                                                                                                                    </tr>
                                                                                                                    @php $srno++; @endphp
                                                                                                                @endforeach
                                                                                    @endif
                                                                                </tbody>
            
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                {{-- </div> --}}
                                        


                                    {{-- resent order table end --}}



                                    {{-- recent customer --}}
                                    {{-- <div id="basic-datatable">
                                        <div class="row"> --}}
                                         
                                        {{-- </div>
                                    </div> --}}
                                    {{-- end recent customer --}}









                                    <!-- Earning Swiper Starts -->
                                    <div class="col-xl-4 col-md-6 col-12 dashboard-earning-swiper" id="widget-earnings">
                                        <div class="card d-none">
                                            <div
                                                class="card-header border-bottom d-flex justify-content-between align-items-center">
                                                <h5 class="card-title"><i
                                                        class="bx bx-dollar font-medium-5 align-middle"></i>
                                                    <span class="align-middle">Earnings</span>
                                                </h5>
                                                <i class="bx bx-dots-vertical-rounded font-medium-3 cursor-pointer"></i>
                                            </div>
                                            <div class="card-content">
                                                <div class="card-body py-1 px-0">
                                                    <!-- earnings swiper starts -->
                                                    <div class="widget-earnings-swiper swiper-container p-1">
                                                        <div class="swiper-wrapper">
                                                            <div class="swiper-slide rounded swiper-shadow py-50 px-2 d-flex align-items-center"
                                                                id="repo-design">
                                                                <i
                                                                    class="bx bx-pyramid mr-1 font-weight-normal font-medium-4"></i>
                                                                <div class="swiper-text">
                                                                    <div class="swiper-heading">Repo Design</div>
                                                                    <small class="d-block">Gitlab</small>
                                                                </div>
                                                            </div>
                                                            <div class="swiper-slide rounded swiper-shadow py-50 px-2 d-flex align-items-center"
                                                                id="laravel-temp">
                                                                <i class="bx bx-sitemap mr-50 font-large-1"></i>
                                                                <div class="swiper-text">
                                                                    <div class="swiper-heading">Designer</div>
                                                                    <small class="d-block">Women Clothes</small>
                                                                </div>
                                                            </div>
                                                            <div class="swiper-slide rounded swiper-shadow py-50 px-2 d-flex align-items-center"
                                                                id="admin-theme">
                                                                <i class="bx bx-check-shield mr-50 font-large-1"></i>
                                                                <div class="swiper-text">
                                                                    <div class="swiper-heading">Best Sellers</div>
                                                                    <small class="d-block">Clothing</small>
                                                                </div>
                                                            </div>
                                                            <div class="swiper-slide rounded swiper-shadow py-50 px-2 d-flex align-items-center"
                                                                id="ux-devloper">
                                                                <i class="bx bx-devices mr-50 font-large-1"></i>
                                                                <div class="swiper-text">
                                                                    <div class="swiper-heading">Admin Template</div>
                                                                    <small class="d-block">Global Network</small>
                                                                </div>
                                                            </div>
                                                            <div class="swiper-slide rounded swiper-shadow py-50 px-2 d-flex align-items-center"
                                                                id="marketing-guide">
                                                                <i class="bx bx-book-bookmark mr-50 font-large-1"></i>
                                                                <div class="swiper-text">
                                                                    <div class="swiper-heading">Marketing Guide</div>
                                                                    <small class="d-block">Books</small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- earnings swiper ends -->
                                                </div>
                                            </div>
                                            <div class="main-wrapper-content">
                                                <div class="wrapper-content" data-earnings="repo-design">
                                                    <div class="widget-earnings-scroll table-responsive">
                                                        <table class="table table-borderless widget-earnings-width mb-0">
                                                            <tbody>
                                                                <tr>
                                                                    <td class="pr-75">
                                                                        <div class="media align-items-center">
                                                                            <a class="media-left mr-50" href="#">
                                                                                <img src="{{ asset('backend-assets/images/portrait/small/avatar-s-10.jpg') }}"
                                                                                    alt="avatar" class="rounded-circle"
                                                                                    height="30" width="30">
                                                                            </a>
                                                                            <div class="media-body">
                                                                                <h6 class="media-heading mb-0">Jerry Lter
                                                                                </h6>
                                                                                <span class="font-small-2">Designer</span>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td class="px-0 w-25">
                                                                        <div
                                                                            class="progress progress-bar-info progress-sm mb-0">
                                                                            <div class="progress-bar" role="progressbar"
                                                                                aria-valuenow="33" aria-valuemin="80"
                                                                                aria-valuemax="100" style="width:33%;">
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td class="text-center"><span
                                                                            class="badge badge-light-warning">-
                                                                            $280</span>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="pr-75">
                                                                        <div class="media align-items-center">
                                                                            <a class="media-left mr-50" href="#">
                                                                                <img src="{{ asset('backend-assets/images/portrait/small/avatar-s-11.jpg') }}"
                                                                                    alt="avatar" class="rounded-circle"
                                                                                    height="30" width="30">
                                                                            </a>
                                                                            <div class="media-body">
                                                                                <h6 class="media-heading mb-0">Pauly uez
                                                                                </h6>
                                                                                <span class="font-small-2">Devloper</span>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td class="px-0 w-25">
                                                                        <div
                                                                            class="progress progress-bar-success progress-sm mb-0">
                                                                            <div class="progress-bar" role="progressbar"
                                                                                aria-valuenow="10" aria-valuemin="80"
                                                                                aria-valuemax="100" style="width:10%;">
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td class="text-center"><span
                                                                            class="badge badge-light-success">+
                                                                            $853</span>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="pr-75">
                                                                        <div class="media align-items-center">
                                                                            <a class="media-left mr-50" href="#">
                                                                                <img src="{{ asset('backend-assets/images/portrait/small/avatar-s-11.jpg') }}"
                                                                                    alt="avatar" class="rounded-circle"
                                                                                    height="30" width="30">
                                                                            </a>
                                                                            <div class="media-body">
                                                                                <h6 class="media-heading mb-0">Lary Masey
                                                                                </h6>
                                                                                <span class="font-small-2">Marketing</span>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td class="px-0 w-25">
                                                                        <div
                                                                            class="progress progress-bar-primary progress-sm mb-0">
                                                                            <div class="progress-bar" role="progressbar"
                                                                                aria-valuenow="15" aria-valuemin="80"
                                                                                aria-valuemax="100" style="width:15%;">
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td class="text-center"><span
                                                                            class="badge badge-light-primary">+
                                                                            $125</span>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="pr-75">
                                                                        <div class="media align-items-center">
                                                                            <a class="media-left mr-50" href="#">
                                                                                <img src="{{ asset('backend-assets/images/portrait/small/avatar-s-12.jpg') }}"
                                                                                    alt="avatar" class="rounded-circle"
                                                                                    height="30" width="30">
                                                                            </a>
                                                                            <div class="media-body">
                                                                                <h6 class="media-heading mb-0">Lula Taylor
                                                                                </h6>
                                                                                <span class="font-small-2">Degigner</span>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td class="px-0 w-25">
                                                                        <div
                                                                            class="progress progress-bar-danger progress-sm mb-0">
                                                                            <div class="progress-bar" role="progressbar"
                                                                                aria-valuenow="35" aria-valuemin="80"
                                                                                aria-valuemax="100" style="width:35%;">
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td class="text-center"><span
                                                                            class="badge badge-light-danger">-
                                                                            $310</span>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="wrapper-content" data-earnings="laravel-temp">
                                                    <div class="widget-earnings-scroll table-responsive">
                                                        <table class="table table-borderless widget-earnings-width mb-0">
                                                            <tbody>
                                                                <tr>
                                                                    <td class="pr-75">
                                                                        <div class="media align-items-center">
                                                                            <a class="media-left mr-50" href="#">
                                                                                <img src="{{ asset('backend-assets/images/portrait/small/avatar-s-9.jpg') }}"
                                                                                    alt="avatar" class="rounded-circle"
                                                                                    height="30" width="30">
                                                                            </a>
                                                                            <div class="media-body">
                                                                                <h6 class="media-heading mb-0">Jesus Lter
                                                                                </h6>
                                                                                <span class="font-small-2">Designer</span>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td class="px-0 w-25">
                                                                        <div
                                                                            class="progress progress-bar-info progress-sm mb-0">
                                                                            <div class="progress-bar" role="progressbar"
                                                                                aria-valuenow="28" aria-valuemin="80"
                                                                                aria-valuemax="100" style="width:28%;">
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td class="text-center"><span
                                                                            class="badge badge-light-info">-
                                                                            $280</span></td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="pr-75">
                                                                        <div class="media align-items-center">
                                                                            <a class="media-left mr-50" href="#">
                                                                                <img src="{{ asset('backend-assets/images/portrait/small/avatar-s-10.jpg') }}"
                                                                                    alt="avatar" class="rounded-circle"
                                                                                    height="30" width="30">
                                                                            </a>
                                                                            <div class="media-body">
                                                                                <h6 class="media-heading mb-0">Pauly Dez
                                                                                </h6>
                                                                                <span class="font-small-2">Devloper</span>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td class="px-0 w-25">
                                                                        <div
                                                                            class="progress progress-bar-success progress-sm mb-0">
                                                                            <div class="progress-bar" role="progressbar"
                                                                                aria-valuenow="90" aria-valuemin="80"
                                                                                aria-valuemax="100" style="width:90%;">
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td class="text-center"><span
                                                                            class="badge badge-light-success">+
                                                                            $83</span>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="pr-75">
                                                                        <div class="media align-items-center">
                                                                            <a class="media-left mr-50" href="#">
                                                                                <img src="{{ asset('backend-assets/images/portrait/small/avatar-s-11.jpg') }}"
                                                                                    alt="avatar" class="rounded-circle"
                                                                                    height="30" width="30">
                                                                            </a>
                                                                            <div class="media-body">
                                                                                <h6 class="media-heading mb-0">Lary Masey
                                                                                </h6>
                                                                                <span class="font-small-2">Marketing</span>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td class="px-0 w-25">
                                                                        <div
                                                                            class="progress progress-bar-primary progress-sm mb-0">
                                                                            <div class="progress-bar" role="progressbar"
                                                                                aria-valuenow="15" aria-valuemin="80"
                                                                                aria-valuemax="100" style="width:15%;">
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td class="text-center"><span
                                                                            class="badge badge-light-primary">+
                                                                            $125</span>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="pr-75">
                                                                        <div class="media align-items-center">
                                                                            <a class="media-left mr-50" href="#">
                                                                                <img src="{{ asset('backend-assets/images/portrait/small/avatar-s-12.jpg') }}"
                                                                                    alt="avatar" class="rounded-circle"
                                                                                    height="30" width="30">
                                                                            </a>
                                                                            <div class="media-body">
                                                                                <h6 class="media-heading mb-0">Lula Taylor
                                                                                </h6>
                                                                                <span class="font-small-2">Devloper</span>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td class="px-0 w-25">
                                                                        <div
                                                                            class="progress progress-bar-danger progress-sm mb-0">
                                                                            <div class="progress-bar" role="progressbar"
                                                                                aria-valuenow="35" aria-valuemin="80"
                                                                                aria-valuemax="100" style="width:35%;">
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td class="text-center"><span
                                                                            class="badge badge-light-danger">-
                                                                            $310</span>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="wrapper-content" data-earnings="admin-theme">
                                                    <div class="widget-earnings-scroll table-responsive">
                                                        <table class="table table-borderless widget-earnings-width mb-0">
                                                            <tbody>
                                                                <tr>
                                                                    <td class="pr-75">
                                                                        <div class="media align-items-center">
                                                                            <a class="media-left mr-50" href="#">
                                                                                <img src="{{ asset('backend-assets/images/portrait/small/avatar-s-25.jpg') }}"
                                                                                    alt="avatar" class="rounded-circle"
                                                                                    height="30" width="30">
                                                                            </a>
                                                                            <div class="media-body">
                                                                                <h6 class="media-heading mb-0">Mera Lter
                                                                                </h6>
                                                                                <span class="font-small-2">Designer</span>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td class="px-0 w-25">
                                                                        <div
                                                                            class="progress progress-bar-info progress-sm mb-0">
                                                                            <div class="progress-bar" role="progressbar"
                                                                                aria-valuenow="52" aria-valuemin="80"
                                                                                aria-valuemax="100" style="width:52%;">
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td class="text-center"><span
                                                                            class="badge badge-light-info">-
                                                                            $180</span></td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="pr-75">
                                                                        <div class="media align-items-center">
                                                                            <a class="media-left mr-50" href="#">
                                                                                <img src="{{ asset('backend-assets/images/portrait/small/avatar-s-15.jpg') }}"
                                                                                    alt="avatar" class="rounded-circle"
                                                                                    height="30" width="30">
                                                                            </a>
                                                                            <div class="media-body">
                                                                                <h6 class="media-heading mb-0">Pauly Dez
                                                                                </h6>
                                                                                <span class="font-small-2">Devloper</span>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td class="px-0 w-25">
                                                                        <div
                                                                            class="progress progress-bar-success progress-sm mb-0">
                                                                            <div class="progress-bar" role="progressbar"
                                                                                aria-valuenow="90" aria-valuemin="80"
                                                                                aria-valuemax="100" style="width:90%;">
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td class="text-center"><span
                                                                            class="badge badge-light-success">+
                                                                            $553</span>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="pr-75">
                                                                        <div class="media align-items-center">
                                                                            <a class="media-left mr-50" href="#">
                                                                                <img src="{{ asset('backend-assets/images/portrait/small/avatar-s-11.jpg') }}"
                                                                                    alt="avatar" class="rounded-circle"
                                                                                    height="30" width="30">
                                                                            </a>
                                                                            <div class="media-body">
                                                                                <h6 class="media-heading mb-0">jini mara
                                                                                </h6>
                                                                                <span class="font-small-2">Marketing</span>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td class="px-0 w-25">
                                                                        <div
                                                                            class="progress progress-bar-primary progress-sm mb-0">
                                                                            <div class="progress-bar" role="progressbar"
                                                                                aria-valuenow="15" aria-valuemin="80"
                                                                                aria-valuemax="100" style="width:15%;">
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td class="text-center"><span
                                                                            class="badge badge-light-primary">+
                                                                            $125</span>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="pr-75">
                                                                        <div class="media align-items-center">
                                                                            <a class="media-left mr-50" href="#">
                                                                                <img src="{{ asset('backend-assets/images/portrait/small/avatar-s-12.jpg') }}"
                                                                                    alt="avatar" class="rounded-circle"
                                                                                    height="30" width="30">
                                                                            </a>
                                                                            <div class="media-body">
                                                                                <h6 class="media-heading mb-0">Lula Taylor
                                                                                </h6>
                                                                                <span class="font-small-2">UX</span>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td class="px-0 w-25">
                                                                        <div
                                                                            class="progress progress-bar-danger progress-sm mb-0">
                                                                            <div class="progress-bar" role="progressbar"
                                                                                aria-valuenow="35" aria-valuemin="80"
                                                                                aria-valuemax="100" style="width:35%;">
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td class="text-center"><span
                                                                            class="badge badge-light-danger">-
                                                                            $150</span>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="wrapper-content" data-earnings="ux-devloper">
                                                    <div class="widget-earnings-scroll table-responsive">
                                                        <table class="table table-borderless widget-earnings-width mb-0">
                                                            <tbody>
                                                                <tr>
                                                                    <td class="pr-75">
                                                                        <div class="media align-items-center">
                                                                            <a class="media-left mr-50" href="#">
                                                                                <img src="{{ asset('backend-assets/images/portrait/small/avatar-s-16.jpg') }}"
                                                                                    alt="avatar" class="rounded-circle"
                                                                                    height="30" width="30">
                                                                            </a>
                                                                            <div class="media-body">
                                                                                <h6 class="media-heading mb-0">Drako Lter
                                                                                </h6>
                                                                                <span class="font-small-2">Designer</span>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td class="px-0 w-25">
                                                                        <div
                                                                            class="progress progress-bar-info progress-sm mb-0">
                                                                            <div class="progress-bar" role="progressbar"
                                                                                aria-valuenow="38" aria-valuemin="80"
                                                                                aria-valuemax="100" style="width:38%;">
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td class="text-center"><span
                                                                            class="badge badge-light-danger">-
                                                                            $280</span>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="pr-75">
                                                                        <div class="media align-items-center">
                                                                            <a class="media-left mr-50" href="#">
                                                                                <img src="{{ asset('backend-assets/images/portrait/small/avatar-s-1.jpg') }}"
                                                                                    alt="avatar" class="rounded-circle"
                                                                                    height="30" width="30">
                                                                            </a>
                                                                            <div class="media-body">
                                                                                <h6 class="media-heading mb-0">Pauly Dez
                                                                                </h6>
                                                                                <span class="font-small-2">Devloper</span>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td class="px-0 w-25">
                                                                        <div
                                                                            class="progress progress-bar-success progress-sm mb-0">
                                                                            <div class="progress-bar" role="progressbar"
                                                                                aria-valuenow="90" aria-valuemin="80"
                                                                                aria-valuemax="100" style="width:90%;">
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td class="text-center"><span
                                                                            class="badge badge-light-success">+
                                                                            $853</span>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="pr-75">
                                                                        <div class="media align-items-center">
                                                                            <a class="media-left mr-50" href="#">
                                                                                <img src="{{ asset('backend-assets/images/portrait/small/avatar-s-11.jpg') }}"
                                                                                    alt="avatar" class="rounded-circle"
                                                                                    height="30" width="30">
                                                                            </a>
                                                                            <div class="media-body">
                                                                                <h6 class="media-heading mb-0">Lary Masey
                                                                                </h6>
                                                                                <span class="font-small-2">Marketing</span>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td class="px-0 w-25">
                                                                        <div
                                                                            class="progress progress-bar-primary progress-sm mb-0">
                                                                            <div class="progress-bar" role="progressbar"
                                                                                aria-valuenow="15" aria-valuemin="80"
                                                                                aria-valuemax="100" style="width:15%;">
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td class="text-center"><span
                                                                            class="badge badge-light-primary">+
                                                                            $125</span>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="pr-75">
                                                                        <div class="media align-items-center">
                                                                            <a class="media-left mr-50" href="#">
                                                                                <img src="{{ asset('backend-assets/images/portrait/small/avatar-s-2.jpg') }}"
                                                                                    alt="avatar" class="rounded-circle"
                                                                                    height="30" width="30">
                                                                            </a>
                                                                            <div class="media-body">
                                                                                <h6 class="media-heading mb-0">Lvia Taylor
                                                                                </h6>
                                                                                <span class="font-small-2">Devloper</span>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td class="px-0 w-25">
                                                                        <div
                                                                            class="progress progress-bar-danger progress-sm mb-0">
                                                                            <div class="progress-bar" role="progressbar"
                                                                                aria-valuenow="75" aria-valuemin="80"
                                                                                aria-valuemax="100" style="width:75%;">
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td class="text-center"><span
                                                                            class="badge badge-light-danger">-
                                                                            $360</span>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="wrapper-content" data-earnings="marketing-guide">
                                                    <div class="widget-earnings-scroll table-responsive">
                                                        <table class="table table-borderless widget-earnings-width mb-0">
                                                            <tbody>
                                                                <tr>
                                                                    <td class="pr-75">
                                                                        <div class="media align-items-center">
                                                                            <a class="media-left mr-50" href="#">
                                                                                <img src="{{ asset('backend-assets/images/portrait/small/avatar-s-19.jpg') }}"
                                                                                    alt="avatar" class="rounded-circle"
                                                                                    height="30" width="30">
                                                                            </a>
                                                                            <div class="media-body">
                                                                                <h6 class="media-heading mb-0">yono Lter
                                                                                </h6>
                                                                                <span class="font-small-2">Designer</span>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td class="px-0 w-25">
                                                                        <div
                                                                            class="progress progress-bar-info progress-sm mb-0">
                                                                            <div class="progress-bar" role="progressbar"
                                                                                aria-valuenow="28" aria-valuemin="80"
                                                                                aria-valuemax="100" style="width:28%;">
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td class="text-center"><span
                                                                            class="badge badge-light-primary">-
                                                                            $270</span>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="pr-75">
                                                                        <div class="media align-items-center">
                                                                            <a class="media-left mr-50" href="#">
                                                                                <img src="{{ asset('backend-assets/images/portrait/small/avatar-s-11.jpg') }}"
                                                                                    alt="avatar" class="rounded-circle"
                                                                                    height="30" width="30">
                                                                            </a>
                                                                            <div class="media-body">
                                                                                <h6 class="media-heading mb-0">Pauly Dez
                                                                                </h6>
                                                                                <span class="font-small-2">Devloper</span>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td class="px-0 w-25">
                                                                        <div
                                                                            class="progress progress-bar-success progress-sm mb-0">
                                                                            <div class="progress-bar" role="progressbar"
                                                                                aria-valuenow="90" aria-valuemin="80"
                                                                                aria-valuemax="100" style="width:90%;">
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td class="text-center"><span
                                                                            class="badge badge-light-success">+
                                                                            $853</span>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="pr-75">
                                                                        <div class="media align-items-center">
                                                                            <a class="media-left mr-50" href="#">
                                                                                <img src="{{ asset('backend-assets/images/portrait/small/avatar-s-12.jpg') }}"
                                                                                    alt="avatar" class="rounded-circle"
                                                                                    height="30" width="30">
                                                                            </a>
                                                                            <div class="media-body">
                                                                                <h6 class="media-heading mb-0">Lary Masey
                                                                                </h6>
                                                                                <span class="font-small-2">Marketing</span>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td class="px-0 w-25">
                                                                        <div
                                                                            class="progress progress-bar-primary progress-sm mb-0">
                                                                            <div class="progress-bar" role="progressbar"
                                                                                aria-valuenow="15" aria-valuemin="80"
                                                                                aria-valuemax="100" style="width:15%;">
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td class="text-center"><span
                                                                            class="badge badge-light-primary">+
                                                                            $225</span>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="pr-75">
                                                                        <div class="media align-items-center">
                                                                            <a class="media-left mr-50" href="#">
                                                                                <img src="{{ asset('backend-assets/images/portrait/small/avatar-s-25.jpg') }}"
                                                                                    alt="avatar" class="rounded-circle"
                                                                                    height="30" width="30">
                                                                            </a>
                                                                            <div class="media-body">
                                                                                <h6 class="media-heading mb-0">Lula Taylor
                                                                                </h6>
                                                                                <span class="font-small-2">Devloper</span>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td class="px-0 w-25">
                                                                        <div
                                                                            class="progress progress-bar-danger progress-sm mb-0">
                                                                            <div class="progress-bar" role="progressbar"
                                                                                aria-valuenow="35" aria-valuemin="80"
                                                                                aria-valuemax="100" style="width:35%;">
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td class="text-center"><span
                                                                            class="badge badge-light-danger">-
                                                                            $350</span>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- </div> -->
                                            <!-- </div> -->
                                            <!-- Marketing Campaigns Starts -->

                                        </div>
                </section>
                <!-- Dashboard Ecommerce ends -->

            </div>
        </div>
    </div>
    <!-- end:: Body -->

@endsection




@section('scripts')
    <script src="{{ asset('backend-assets/vendors/js/tables/datatable/pdfmake.min.js') }}"></script>
    <script src="{{ asset('backend-assets/vendors/js/tables/datatable/vfs_fonts.js') }}"></script>
    <script src="{{ asset('backend-assets/vendors/js/tables/datatable/datatables.min.js') }}"></script>
    <script src="{{ asset('backend-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('backend-assets/vendors/js/tables/datatable/dataTables.buttons.min.js') }}"></script>
    <script src="https://cdn.datatables.net/buttons/1.4.0/js/buttons.flash.min.js"></script>
    <script src="{{ asset('backend-assets/vendors/js/tables/datatable/buttons.bootstrap.min.js') }}"></script>
    <script src="{{ asset('backend-assets/vendors/js/tables/datatable/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('backend-assets/vendors/js/tables/datatable/buttons.print.min.js') }}"></script>


    <script>
        $(document).ready(function() {
            $('#tbl-datatable').DataTable().destroy();
            // $.extend(true, $.fn.dataTable.defaults, {
            //     "pageLength": 20,
            //     "lengthMenu": [[20, 50, 100, 200, 400,-1], [20, 50, 100, 200,  400, "- All -"]],
            // });
            $('#tbl-datatable').DataTable({
                // dom: 'Bfrtip',//lBfrtip
                pageLength: 20,
                lengthMenu: [
                    [20, 50, 100, 200, 400, -1],
                    [20, 50, 100, 200, 400, "- All -"]
                ],
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'excel',
                        footer: false,
                        exportOptions: {
                            columns: [0, 2, 3, 4, 5, 6, 7, 8]
                        }
                    },
                    {
                        extend: 'csv',
                        footer: false,
                        exportOptions: {
                            columns: [0, 2, 3, 4, 5, 6, 7, 8]
                        }
                    },
                ]
            });
        });
    </script>
@endsection