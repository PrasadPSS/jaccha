@extends('backend.layouts.app')
@section('title', 'Size Charts')

@section('content')
<div class="app-content content">
  <div class="content-overlay"></div>
    <div class="content-wrapper">
      <div class="content-header row">
          <div class="content-header-left col-12 mb-2 mt-1">
            <div class="row breadcrumbs-top">
              <div class="col-12">
                <h5 class="content-header-title float-left pr-1 mb-0">Size Charts</h5>
                <div class="breadcrumb-wrapper col-12">
                  <ol class="breadcrumb p-0 mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active">Size Charts
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
                    <h4 class="card-title">Size Charts</h4>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                      <div class="col-12 text-right">
                        <a href="{{ url('admin/sizecharts/create/') }}" class="btn btn-primary"><i class="bx bx-plus"></i> Add </a>
                        <!-- <a href="{{ route('admin.filters') }}" class="btn btn-outline-secondary"><i class="bx bx-arrow-back"></i><span class="align-middle ml-25">Back</span></a> -->
                      </div>
                        <div class="table-responsive">
                            <table class="table zero-configuration" id="tbl-datatable">
                                <thead>
                                    <tr>
                                      <th>#</th>
                                      <th>Size Chart Name</th>
                                      <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @if(isset($sizecharts) && count($sizecharts)>0)
                                    @php $srno = 1; @endphp
                                    @foreach($sizecharts as $size_chart)
                                    <tr>
                                      <td>{{ $srno }}</td>
                                      <td>{{ $size_chart->size_chart_name }}</td>
                                      <td>
                                        <!-- @can('Update') -->
                                        <!-- @endcan -->
                                        <a href="{{ url('admin/sizecharts/edit/'.$size_chart->size_chart_id) }}" class="btn btn-primary"><i class="bx bx-pencil"></i></a>
                                        <!-- @can('Delete') -->
                                        <!-- @endcan -->
                                        {!! Form::open([
                                            'method'=>'GET',
                                            'url' => ['admin/sizecharts/delete', $size_chart->size_chart_id],
                                            'style' => 'display:inline'
                                        ]) !!}
                                            {!! Form::button('<i class="bx bx-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger','onclick'=>"return confirm('Are you sure you want to Delete this Entry ?')"]) !!}
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
