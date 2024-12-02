@extends('backend.layouts.app')
@section('title', 'Assign Contents to First Level Categories')

@section('content')
<div class="app-content content">
  <div class="content-overlay"></div>
    <div class="content-wrapper">
      <div class="content-header row">
          <div class="content-header-left col-12 mb-2 mt-1">
            <div class="row breadcrumbs-top">
              <div class="col-12">
                <h5 class="content-header-title float-left pr-1 mb-0">Assign Contents to First Level Categories</h5>
                <div class="breadcrumb-wrapper col-12">
                  <ol class="breadcrumb p-0 mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active">Assign Contents to First Level Categories
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
                    <h4 class="card-title">Assign Contents to First Level Categories</h4>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                      <!-- <div class="col-12 text-right">
                        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary"><i class="bx bx-plus"></i> Add </a>
                      </div> -->
                        <div class="table-responsive">
                            <table class="table zero-configuration" id="tbl-datatable">
                                <thead>
                                    <tr>
                                      <th>#</th>
                                      <th>First Level Category Name</th>
                                      <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @if(isset($categories) && count($categories)>0)
                                    @php $srno = 1; @endphp
                                    @foreach($categories as $category)
                                    <tr>
                                      <td>{{ $srno }}</td>
                                      <td>{{ $category->category_name }}</td>
                                      <td>
                                        @php
                                          if($category->has_subcategories)
                                          {
                                        @endphp
                                            <a href="{{ url('admin/productlisting/secondlevel/' . $category->category_id) }}" class="btn btn-primary btn-xs">Assign Second Level Contents</a>
                                        @php
                                          }
                                        @endphp
                                    
                                        <a href="{{ url('admin/productlisting/firstlevel/edit/'.$category->category_id) }}" class="btn btn-primary"><i class="bx bx-pencil"></i></a>

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
