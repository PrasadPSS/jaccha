@extends('backend.layouts.app')
@section('title', 'External User Details')
@section('content')

    <!--order details section start-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
          <div class="content-header row">
              <div class="content-header-left col-12 mb-2 mt-1">
                <div class="row breadcrumbs-top">
                  <div class="col-12">
                    <h5 class="content-header-title float-left pr-1 mb-0">External Users</h5>
                    <div class="breadcrumb-wrapper col-12">
                      <ol class="breadcrumb p-0 mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.externalusers')}}">External Users</a></li>
                        <li class="breadcrumb-item active">External User Details
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
                              <a href="{{ route('admin.externalusers') }}" class="btn btn-outline-secondary float-right"><i class="bx bx-arrow-back"></i><span class="align-middle ml-25">Back</span></a>
                                <h4 class="card-title">External User Details
                                </h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body card-dashboard">
    @if(isset($externaluser))
        <div class="container" id="targetshow">
            <div class="row delivery-details-row">
                <div class="col-lg-8 col-md-12 col-sm-12 col-12">
                    <div class="order-details-box">
                        <div class="table-responsive">
                          @if(isset($externaluser))
                            <table class="table table-bordered table-striped">
                              <tr>
                                <th>Name :</th><td>{{$externaluser->name}}</td>
                              </tr>
                              <tr>
                                <th>Email :</th><td>{{$externaluser->email}}</td>
                              </tr>
                              <tr>
                                <th>Mobile No :</th><td>{{$externaluser->mobile_no}}</td>
                              </tr>
                              <tr>
                                <th>Alternate Mobile No :</th><td>{{$externaluser->alt_mobile_no}}</td>
                              </tr>
                              <tr>
                                <th>Date of Birth :</th><td>{{$externaluser->dob}}</td>
                              </tr>
                              <tr>
                                <th>Gender :</th>
                                <td>
                                  @if($externaluser->gender=='male')
                                  Male
                                  @elseif($externaluser->gender=='female')
                                  Female
                                  @else
                                  Other
                                  @endif
                                </td>
                              </tr>
                            </table>
                          @endif


                        </div>
                    </div>

                </div>

            </div>
        </div>
        @endif
        </div>
      </div>
    </div>
  </div>

  @if(isset($externaluser))
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">Update User Status</h4>
      </div>
      <div class="card-content">
        <div class="card-body">
          @include('backend.includes.errors')
          {!! Form::model($externaluser, [
              'method' => 'POST',
              'url' => ['admin/externalusers/updatestatus'],
              'class' => 'form'
          ]) !!}
            <div class="form-body">
              <div class="row">

                <div class="col-md-4 col-12">
                  <fieldset class="form-group">
                    <div class="input-group">
                      <div class="input-group-prepend">
                        {{ Form::hidden('id', $externaluser->id) }}
                        {{ Form::label('account_status', 'User Status ',['class'=>'']) }}
                      </div>
                      {{ Form::select('account_status', ['1'=>'Activate','0'=>'Deactivate'], null,['class'=>'select2 form-control ', 'placeholder' => 'Please Select Status',]) }}
                    </div>
                  </fieldset>
                </div>

                <div class="col-12 d-flex justify-content-start">
                  {{ Form::submit('Update', array('class' => 'btn btn-primary mr-1 mb-1')) }}
                </div>
              </div>
            </div>
          {{ Form::close() }}
        </div>
      </div>
    </div>
  </div>
  @endif

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
