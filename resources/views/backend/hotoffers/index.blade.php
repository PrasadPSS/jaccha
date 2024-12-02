@extends('backend.layouts.app')
@section('title', 'Hot Offers')

@section('content')
<div class="app-content content">
  <div class="content-overlay"></div>
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-12 mb-2 mt-1">
        <div class="row breadcrumbs-top">
          <div class="col-12">
            <h5 class="content-header-title float-left pr-1 mb-0">Hot Offers</h5>
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb p-0 mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active">Hot Offers
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
              <h4 class="card-title">Hot Offers</h4>
            </div>
            <div class="card-content">
              <div class="card-body card-dashboard">
                <div class="col-12 text-right">
                  <a href="{{ url('admin/hotoffers/create') }}" class="btn btn-primary"><i class="bx bx-plus"></i> Add </a>
                </div>
                <div class="table-responsive">
                    <table class="table zero-configuration" id="tbl-datatable">
                        <thead>
                            <tr>
                              <th>#</th>
                              <th>Action</th>
                              <th>First Image</th>
                              <th>Second Image</th>
                              <th>Third Image</th>
                              <th>Fourth Image</th>
                            </tr>
                        </thead>
                        <tbody>
                          @if(isset($hotoffers) && count($hotoffers)>0)
                            @php $srno = 1; @endphp
                            @foreach($hotoffers as $hotoffer)
                            <tr>
                              <td>{{ $srno }}</td>
                              <td>
                                <a href="{{ url('admin/hotoffers/edit/'.$hotoffer->hotoffers_id) }}" class="btn btn-primary"><i class="bx bx-pencil"></i></a>
                                {!! Form::open([
                                    'method'=>'GET',
                                    'url' => ['admin/hotoffers/delete', $hotoffer->hotoffers_id],
                                    'style' => 'display:inline'
                                ]) !!}
                                    {!! Form::button('<i class="bx bx-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger','onclick'=>"return confirm('Are you sure you want to Delete this Entry ?')"]) !!}
                                {!! Form::close() !!}
                              </td>
                              <td>
                                <img class="img-fluid mb-1 img-thumbnail" src="{{ asset('backend-assets/uploads/hotoffers/') }}/{{ $hotoffer->first_image }}" width="100" alt="Image">
                                <p>{{ $hotoffer->first_image_url }}</p>
                              </td>
                              <td>
                                @if($hotoffer->second_image)
                                  <img class="img-fluid mb-1 img-thumbnail" src="{{ asset('backend-assets/uploads/hotoffers/') }}/{{ $hotoffer->second_image }}" width="100" alt="Image">
                                  <p>{{ $hotoffer->second_image_url }}</p>
                                @endif
                              </td>
                              <td>
                                @if($hotoffer->third_image)
                                  <img class="img-fluid mb-1 img-thumbnail" src="{{ asset('backend-assets/uploads/hotoffers/') }}/{{ $hotoffer->third_image }}" width="100" alt="Image">
                                  <p>{{ $hotoffer->third_image_url }}</p>
                                @endif
                              </td>
                              <td>
                                @if($hotoffer->fourth_image)
                                  <img class="img-fluid mb-1 img-thumbnail" src="{{ asset('backend-assets/uploads/hotoffers/') }}/{{ $hotoffer->fourth_image }}" width="100" alt="Image">
                                  <p>{{ $hotoffer->fourth_image_url }}</p>
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
