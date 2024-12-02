@extends('backend.layouts.app')
@section('title', 'Cancel Order')
@section('content')

<!--order details section start-->
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
                  <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a></li>
                  <li class="breadcrumb-item"><a href="{{ route('admin.orders')}}">Orders</a></li>
                  <li class="breadcrumb-item active">Cancel Order
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
                  <a href="{{ route('admin.orders') }}" class="btn btn-outline-secondary float-right"><i class="bx bx-arrow-back"></i><span class="align-middle ml-25">Back</span></a>
                    <h4 class="card-title">Cancel Order
                    </h4>
                </div>
                <div class="card-content">
                    <div class="card-body">
                      @include('backend.includes.errors')
                      {!! Form::model($orders, [
                          'method' => 'POST',
                          'url' => ['admin/orders/cancelorderstatus'],
                          'class' => 'form'
                      ]) !!}
                        <div class="form-body">
                          <div class="row">
                            <div class="col-md-6 col-12">
                              <fieldset class="form-group">
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    {{ Form::hidden('order_id', $orders->order_id) }}
                                    {{ Form::label('order_cancellation_reason_id', 'Reason ',['class'=>'']) }}
                                  </div>
                                  {{ Form::select('order_cancellation_reason_id', $reasons, null,['class'=>'select2 form-control ', 'placeholder' => 'Please Select Reason',]) }}
                                </div>
                              </fieldset>
                            </div>

                            <div class="col-12 d-flex justify-content-start">
                              {{ Form::submit('Confirm Cancellation', array('class' => 'btn btn-primary mr-1 mb-1')) }}
                            </div>
                          </div>
                        </div>
                      {{ Form::close() }}
                    </div>
                  </div>
              </div>
              
              
              
              

            </div>
            </section>
            </div>
            </div>
        <!--order details section end-->
    <!-- hide show content -->
    <script>
        $('.viewdetails-content').click(function() {
            $('#targetshow').toggle(0);
        });
    </script>
@endsection
