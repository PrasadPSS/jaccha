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
                        <div class="table-responsive">
                            <table class="table zero-configuration" id="tbl-datatable">
                                <thead>
                                    <tr>
                                      <th>#</th>
                                        <th>Invoice No.</th>
                                        <th>Transaction ID</th>
                                        <th>Customer Name</th>
                                        <th>Customer Email</th>
                                        <th>Amount</th>
                                        <th>Payment Mode</th>
                                        <th>Status</th>
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
                                        <td>{{ $order->transaction_id }}</td>
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
                                        <td>
                                          @php
                                            $progress = order_status($order);
                                          @endphp
                                          {{$progress}}
                                        </td>
                                        <td>{{date('d-m-Y H:i',strtotime($order->created_at ))}}</td>
                                        <td>
                                            <a href="{{url('admin/orders/viewinvoice/'.$order->order_id)}}" class="btn btn-primary" >View Invoice</a>
                                            <a href="{{url('admin/orders/invoice/'.$order->order_id)}}" class="btn btn-primary mt-1" >Download Invoice</a>
                                            <a href="{{url('admin/orders/details/'.$order->order_id)}}" class="btn btn-primary mt-1" >View Details</a>
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
