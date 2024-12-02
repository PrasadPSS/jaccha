@extends('backend.layouts.app')
@section('title', 'Report')

@section('content')

    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-12 mb-2 mt-1">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h5 class="content-header-title float-left pr-1 mb-0">Report</h5>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb p-0 mb-0">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                                    </li>
                                    <li class="breadcrumb-item active">Report
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <section id="multiple-column-form">
                <div class="row match-height">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">View Report</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">

                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <form action="{{route('admin.reports.details')}}" method="get" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="form-body">
                                                        <div class="row">
                                                            @if(isset($start_date))
                                                                <div class="col-md-4">
                                                                    <h5>Start Date</h5>
                                                                    <input type="date" name="start_date" class="form-control" id="start_date" value="{{$start_date}}" required>
                                                                </div>
                                                            @else
                                                                <div class="col-md-4">
                                                                    <h5>Start Date</h5>
                                                                    <input type="date" name="start_date" class="form-control" id="start_date" required>
                                                                </div>
                                                            @endif

                                                                @if(isset($end_date))
                                                                    <div class="col-md-4">
                                                                        <h5>End Date</h5>
                                                                        <input type="date" name="end_date" class="form-control" id="end_date" value="{{$end_date}}" required>
                                                                    </div>
                                                                @else
                                                                    <div class="col-md-4">
                                                                        <h5>End Date</h5>
                                                                        <input type="date" name="end_date" class="form-control" id="end_date"  required>
                                                                    </div>
                                                                @endif
                                                                @if(isset($fileupload))
                                                                    <div class="col-md-4">
                                                                        <h5>Report Type</h5>
                                                                        <select class="form-control" name="fileuploadtype" id="filetype" required>
                                                                            <option value="Orders" {{$fileupload =='Orders' ? 'selected' : ''}}>Orders</option>
                                                                            <option value="Users" {{$fileupload =='Users' ? 'selected' : ''}}>Users</option>
                                                                            <option value="Payments" {{$fileupload =='Payments' ? 'selected' : ''}}>Payments</option>
                                                                        </select>
                                                                    </div>
                                                                @else
                                                                <div class="col-md-4">
                                                                    <h5>Report Type</h5>
                                                                    <select class="form-control" name="fileuploadtype" id="filetype" required>
                                                                        <option selected="selected" disabled="disabled">
                                                                            Please Select
                                                                        </option>
                                                                        <option value="Orders" id="subscriber">Orders</option>
                                                                        <option value="Users" id="user">Users</option>
                                                                        <option value="Payments" id="payment">Payments</option>
                                                                    </select>
                                                                </div>
                                                                @endif

                                                            <div class="col-md-3 mt-1">
                                                                <input type="submit" class="btn btn-primary px-1" value="Submit" id="button">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            {{--            Order Details--}}
            @if(isset($fileupload) && $fileupload=='Orders')
                <section id="basic-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Orders
                                    </h4>
                                </div>
                                <div class="col-12  text-right">
                                    <a href="{{url('admin/report/orders/excel/'.$start_date. '/'. $end_date)}} " class="btn btn-primary">Export</a>
                                </div>
                                <div class="card-content">
                                    <div class="card-body card-dashboard">
                                        <div class="table-responsive">
                                            <table class="table zero-configuration" id="tbl-datatable">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Invoice No.</th>
                                                    <th>Customer Name</th>
                                                    <th>Customer Email</th>
                                                    <th>Amount</th>
                                                    <th>Payment Tracking Code</th>
                                                    <th>Order Date</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @if(isset($orders) && count($orders)>0)
                                                    @php $srno = 1; @endphp
                                                    @foreach($orders as $order)
                                                        <tr>
                                                            <td>{{ $srno }}</td>
                                                            <td>{{ $order->orders_counter_id }}</td>
                                                            <td>{{ $order->name }}</td>
                                                            <td>{{ $order->email }}</td>
                                                            <td>{{ $order->total }}</td>
                                                            <td>{{ $order->payment_tracking_code }}</td>
                                                            <td>{{date('d-m-Y H:i',strtotime($order->created_at ))}}</td>
                                                        </tr>
                                                        @php $srno++; @endphp
                                                    @endforeach
                                                @endif
                                                </tbody>
                                            </table>
                                            <h4>Grand Total Amount:{{$totorderamount}}</h4>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                @endif
{{-- Users Details--}}
            @if(isset($fileupload) && $fileupload=='Users')
                <section id="basic-datatable">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Users
                                </h4>
                            </div>
                            <div class="col-12  text-right">
                                <a href="{{url('admin/report/users/excel/'.$start_date. '/'. $end_date)}} " class="btn btn-primary">Export</a>
                            </div>
                            <div class="card-content">
                                <div class="card-body card-dashboard">
                                    <div class="table-responsive">
                                        <table class="table zero-configuration" id="tbl-datatable">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Mobile No</th>
                                                <th>Registered Date</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if(isset($users) && count($users)>0)
                                                @php $srno = 1; @endphp
                                                @foreach($users as $user)
                                                    <tr>
                                                        <td>{{ $srno }}</td>
                                                        <td>{{ $user->name }}</td>
                                                        <td>{{ $user->email }}</td>
                                                        <td>{{ $user->mobile_no }}</td>
                                                        <td>{{date('d-m-Y H:i',strtotime($user->created_at ))}}</td>
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
                @endif

            {{-- Payments --}}
            @if(isset($fileupload) && $fileupload=='Payments')
                <section id="basic-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Payments
                                    </h4>
                                </div>
                                <div class="col-12  text-right">
                                    <a href="{{url('admin/report/payments/excel/'.$start_date. '/'. $end_date)}} " class="btn btn-primary">Export</a>
                                </div>
                                <div class="card-content">
                                    <div class="card-body card-dashboard">
                                        <div class="table-responsive">
                                            <table class="table zero-configuration" id="tbl-datatable">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Customer Name</th>
                                                    <th>Email</th>
                                                    <th>Transaction Id</th>
                                                    <th>Amount</th>
                                                    <th>Payment Tracking Code</th>
                                                    <th>Payment Date</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @if(isset($payments) && count($payments)>0)
                                                    @php $srno = 1; @endphp
                                                    @foreach($payments as $payment)
                                                        <tr>
                                                            <td>{{ $srno }}</td>
                                                            <td>{{ $payment->customer_name }}</td>
                                                            <td>{{ $payment->email }}</td>
                                                            <td>{{ $payment->transaction_id }}</td>
                                                            <td>{{ $payment->amount }}</td>
                                                            <td>{{ $payment->payment_tracking_code }}</td>
                                                            <td>{{date('d-m-Y H:i',strtotime($payment->payment_date ))}}</td>
                                                        </tr>
                                                        @php $srno++; @endphp
                                                    @endforeach
                                                @endif
                                                </tbody>
                                            </table>
                                            <h4>Grand Total Amount:{{$totpaymentamount}}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            @endif
        </div>
    </div>
@endsection
