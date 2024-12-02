@extends('backend.layouts.app')
@section('title', 'Frontend Images')

@section('content')
<div class="app-content content">
  <div class="content-overlay"></div>
  <div class="content-wrapper">
    <div class="content-header row">
      <div class="content-header-left col-12 mb-2 mt-1">
        <div class="row breadcrumbs-top">
          <div class="col-12">
            <h5 class="content-header-title float-left pr-1 mb-0">Frontend Images</h5>
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb p-0 mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                </li>
                <li class="breadcrumb-item active">Frontend Images
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
              <h4 class="card-title">Frontend Images</h4>
            </div>
            <div class="card-content">
              <div class="card-body card-dashboard">
                <div class="table-responsive">
                    <table class="table zero-configuration" id="tbl-datatable">
                        <thead>
                            <tr>
                              <th>#</th>
                              <th>Name</th>
                              <th>Image</th>
                              <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                          @if(isset($frontendimages) && count($frontendimages)>0)
                            @php $srno = 1; @endphp
                            @foreach($frontendimages as $frontendimage)
                            <tr>
                              <td>{{ $srno }}</td>
                              <td>{{ $frontendimage->image_name }}</td>
                              <td>
                                <img class="img-fluid mb-1 img-thumbnail" src="{{ asset('backend-assets/uploads/frontend_images/') }}/{{ $frontendimage->image_url }}" width="100" alt="Image">
                              </td>
                              <td>
                                <a href="{{ url('admin/frontendimages/edit/'.$frontendimage->frontend_image_id) }}" class="btn btn-primary"><i class="bx bx-pencil"></i></a>
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
