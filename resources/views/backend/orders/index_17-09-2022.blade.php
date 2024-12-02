@extends('backend.layouts.app')
@section('title', 'Orders')
@section('content')
<div class="app-content content">
  <div class="content-overlay"></div>
    <div class="content-wrapper">
      <div class="content-header row">
          <div class="content-header-left col-12 mb-2 mt-1">
            <div class="row breadcrumbs-top">
              <div class="col-12">
                <h5 class="content-header-title float-left pr-1 mb-0">Orders</h5>
                <div class="breadcrumb-wrapper col-12">
                  <ol class="breadcrumb p-0 mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active">Orders
                    </li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
        </div>
<section id="basic-datatable">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Orders
                    </h4>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <div class="col-12 text-right">
                            <a href="{{route('admin.orders.delhiverylist')}} " target="_blank" class="btn btn-primary">Delhivery List</a>
                        </div>
                        <div class="table-responsive">
                            <table class="table zero-configuration table-responsive" id="tbl-datatable">
                                <thead>
                                    <tr>
                                      <th>#</th>
                                        <th>Invoice No.</th>
                                        <th>Status</th>
                                        <th>Customer Name</th>
                                        <th>Customer Email</th>
                                        <th>Amount</th>
                                        <th>Payment Mode</th>
                                        <th>Order Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @if(isset($orders) && count($orders)>0)
                                    @php $srno = 1; @endphp
                                    @foreach($orders as $order)
                                    <tr>
                                      <td>{{ $srno }}</td>
                                        <td>{{ $order->orders_counter_id }}</td>
                                        <td>
                                          @php
                                            $progress = order_status($order);
                                            $status_color = order_status_color($order);
                                          @endphp
                                          <span class="{{$status_color}}">{{$progress}}</span>
                                        </td>
                                        <td>{{ $order->customer_name }}</td>
                                        <td>{{ $order->email }}</td>
                                        <td>{{ $order->total }}</td>
                                        <td>
                                          @if($order->payment_mode=='payumoney')
                                          PayuMoney
                                          @elseif($order->payment_mode=='cod')
                                          COD
                                          @else
                                          Online
                                          @endif
                                        </td>
                                        <td>{{date('d-m-Y H:i',strtotime($order->created_at ))}}</td>
                                        <td>
                                            <a href="{{url('admin/orders/details/'.$order->order_id)}}" class="btn btn-primary btn-sm" >View Details</a>
                                            <a href="{{url('admin/orders/viewinvoice/'.$order->order_id)}}" class="btn btn-primary btn-sm" >View Invoice</a>
                                            <a href="{{url('admin/orders/invoice/'.$order->order_id)}}" class="btn btn-primary btn-sm" >Download Invoice</a>
                                            @if($order->package_order_status==0)
                                              <a href="{{url('admin/orders/createpackageorder/'.$order->order_id)}}" class="btn btn-primary btn-sm" >Create Package Order</a>
                                            @endif
                                            @if($order->package_order_status==1)
                                              <a href="{{url('admin/orders/generatepacakgeslips/'.$order->order_id)}}" class="btn btn-primary btn-sm" >Generate Package Slips</a>
                                            @endif
                                            @if($order->preparing_order_stage==1)
                                              <a href="{{url('admin/orders/generateproductlabels/'.$order->order_id)}}" class="btn btn-primary btn-sm" >Generate Product Labels</a>
                                            @endif
                                            <!-- && $order->shipped_stage==0  -->
                                            @if($order->cancel_order_flag==0  && $order->delivered_stage==0 && $order->order_return_flag==0)
                                              <a href="{{url('admin/orders/cancelorder/'.$order->order_id)}}" class="btn btn-primary btn-sm" >Cancel Order</a>
                                            @endif
                                            
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
</section>
</div>
</div>

@endsection
@section('scripts')
<script src="{{ asset('backend-assets/vendors/js/tables/datatable/datatables.min.js') }}"></script>
<script src="{{ asset('backend-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('backend-assets/vendors/js/tables/datatable/dataTables.buttons.min.js') }}"></script>

<script>
  $(document).ready(function()
  {

  });
</script>
@endsection
