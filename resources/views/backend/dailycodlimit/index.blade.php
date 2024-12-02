@extends('backend.layouts.app')
@section('title', 'Daily COD Limit')

@section('content')
<div class="app-content content">
  <div class="content-overlay"></div>
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-12 mb-2 mt-1">
        <div class="row breadcrumbs-top">
          <div class="col-12">
            <h5 class="content-header-title float-left pr-1 mb-0">Daily COD  Limit</h5>
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb p-0 mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active">Daily COD  Limit
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
              <h4 class="card-title">Daily COD  Limit</h4>
            </div>
            <div class="card-content">
              <div class="card-body card-dashboard">
                <div class="col-12 text-right">
                  {{-- <a href="{{ route('admin.dailycodlimit.create') }}" class="btn btn-primary"><i
                      class="bx bx-plus"></i> Add </a> --}}
                </div>
                <div class="table-responsive">
                  <table class="table zero-configuration" id="tbl-datatable">
                    <thead>
                      <tr>
                        <th>#</th>
                        {{-- <th>User ID</th> --}}
                        {{-- <th>UserEmail</th> --}}
                        <th>Status</th>
                        {{-- <th>Date</th> --}}
                        <th>Limit</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @if(isset($order_cancels) && count($order_cancels)>0)
                      @php $srno = 1; @endphp
                      @foreach($order_cancels as $order_cancel)
                      <tr>
                        <td>{{ $srno }}</td>
                        {{-- <td>{{ $order_cancel->user_id }}</td> --}}
                        {{-- <td>
                          @foreach($users as $user)
                          @if($user->id == $order_cancel->user_id)
                          {{$user->email }}
                          @endif
                          @endforeach
                        </td> --}}
                        <td>{{ $order_cancel->status }}</td>
                        {{-- <td>{{ $order_cancel->order_date }}</td> --}}
                        <td>{{ $order_cancel->count }}</td>
                        <td>
                          <!-- @can('Update') -->
                          <!-- @endcan -->
                          <a href="{{ url('admin/dailycodlimit/edit/'.$order_cancel->id ) }}"
                            class="btn btn-primary"><i class="bx bx-pencil"></i></a>
                          <!-- @can('Delete') -->
                          <!-- @endcan -->
                          {!! Form::open([
                          'method'=>'GET',
                          'url' => ['admin/dailycodlimit/delete', $order_cancel->id ],
                          'style' => 'display:inline'
                          ]) !!}
                          {!! Form::button('<i class="bx bx-trash"></i>', ['type' => 'submit', 'class' => 'btn
                          btn-danger','onclick'=>"return confirm('Are you sure you want to Delete this Entry ?')"]) !!}
                          {!! Form::close() !!}
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