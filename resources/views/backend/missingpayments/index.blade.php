@extends('backend.layouts.app')
@section('title', 'Missing Payments')

@section('content')
<div class="app-content content">
  <div class="content-overlay"></div>
    <div class="content-wrapper">
      <div class="content-header row">
          <div class="content-header-left col-12 mb-2 mt-1">
            <div class="row breadcrumbs-top">
              <div class="col-12">
                <h5 class="content-header-title float-left pr-1 mb-0">Missing Payments</h5>
                <div class="breadcrumb-wrapper col-12">
                  <ol class="breadcrumb p-0 mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active">Missing Payments
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
                    <h4 class="card-title">Missing Payments</h4>
                </div>
{{--                @if ($message = Session::get('success'))--}}
{{--                    <div class="alert alert-success">--}}
{{--                        <p>{{ $message }}</p>--}}
{{--                    </div>--}}
{{--                @endif--}}
               @include('frontend.includes.errors')
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <div class="table-responsive">
                            <table class="table zero-configuration" id="tbl-datatable">
                                <thead>
                                    <tr>
                                      <th>#</th>
                                        <th>Customer Name</th>
                                        <th>Customer Email</th>
                                        <th>Transaction ID</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Payment Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @if(isset($missingpayments) && count($missingpayments)>0)
                                    @php $srno = 1; @endphp
                                    @foreach($missingpayments as $missingpayment)
                                    <tr>
                                      <td>{{ $srno }}</td>
                                        <td>{{ $missingpayment->customer_name }}</td>
                                        <td>{{ $missingpayment->email }}</td>
                                        <td>{{ $missingpayment->transaction_id }}</td>
                                        <td>{{ $missingpayment->amount }}</td>
                                        <td>{{ $missingpayment->status }}</td>
                                        <td>{{date('d-m-Y H:i',strtotime($missingpayment->payment_date ))}}</td>
                                        <td>
                                            <a href="{{url('admin/missingpayments/convert/'.$missingpayment->payment_id)}}" class="btn btn-primary" onclick="return confirm('Are you sure you want to Convert This Entry to Success ?')"><i class="bx bx-money"></i></a>
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
