@extends('backend.layouts.app')
@section('title', 'Assign Contents to Third Level Categories')

@section('content')
<div class="app-content content">
  <div class="content-overlay"></div>
    <div class="content-wrapper">
      <div class="content-header row">
          <div class="content-header-left col-12 mb-2 mt-1">
            <div class="row breadcrumbs-top">
              <div class="col-12">
                <h5 class="content-header-title float-left pr-1 mb-0">Assign Contents to Third Level Categories</h5>
                <div class="breadcrumb-wrapper col-12">
                  <ol class="breadcrumb p-0 mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active">Assign Contents to Third Level Categories
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
                    <h4 class="card-title">@if(isset($subcategory)){{ $subcategory->subcategory_name }} :@endif Assign Contents to Third Level Categories</h4>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                      <div class="col-12 text-right">
                        <!-- <a href="{{ route('admin.subsubcategories.create') }}/{{ isset(request()->category_id)?request()->category_id.'/'.request()->subcategory_id:'' }}" class="btn btn-primary"><i class="bx bx-plus"></i> Add </a> -->
                        <a href="{{ route('admin.productlisting') }}/@if(isset($subcategory_id)){{ 'secondlevel/'.$subcategory->category_id }}@endif" class="btn btn-outline-secondary"><i class="bx bx-arrow-back"></i><span class="align-middle ml-25">Back</span></a>
                      </div>
                        <div class="table-responsive">
                            <table class="table zero-configuration" id="tbl-datatable">
                                <thead>
                                    <tr>
                                      <th>#</th>
                                      <th>Third Level Category Name</th>
                                      <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @if(isset($subsubcategories) && count($subsubcategories)>0)
                                    @php $srno = 1; @endphp
                                    @foreach($subsubcategories as $subsubcategorie)
                                    <tr>
                                      <td>{{ $srno }}</td>
                                      <td>{{ $subsubcategorie->sub_subcategory_name }}</td>
                                      <td>
                                        <a href="{{ url('admin/productlisting/thirdlevel/edit/'.$subsubcategorie->category_id.'/'.$subsubcategorie->subcategory_id.'/'.$subsubcategorie->sub_subcategory_id) }}" class="btn btn-primary"><i class="bx bx-pencil"></i></a>

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
