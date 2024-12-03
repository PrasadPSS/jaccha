@extends('backend.layouts.app')
@section('title', 'HSN Codes')

@section('content')
<div class="app-content content">
  <div class="content-overlay"></div>
    <div class="content-wrapper">
      <div class="content-header row">
          <div class="content-header-left col-12 mb-2 mt-1">
            <div class="row breadcrumbs-top">
              <div class="col-12">
                <h5 class="content-header-title float-left pr-1 mb-0">HSN Codes</h5>
                <div class="breadcrumb-wrapper col-12">
                  <ol class="breadcrumb p-0 mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active">HSN Codes
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
                  <!--<a href="{{ route('admin.manufacturers') }}" class="btn btn-outline-secondary mr-1 mb-1 float-right"><i class="bx bx-arrow-back"></i><span class="align-middle ml-25">Back</span></a>-->
                    <h4 class="card-title">HSN Codes</h4>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                      <div class="col-12 text-right">
                        <a href="{{ url('admin/hsncodes/create') }}" class="btn btn-primary"><i class="bx bx-plus"></i> Add </a>
                      </div>
                        <div class="table-responsive">
                            <table class="table zero-configuration" id="tbl-datatable">
                                <thead>
                                    <tr>
                                      <th>#</th>
                                      <th>HSN Code Name</th>
                                      <th>Category</th>
                                      <th>Sub Category</th>
                                      <th>Child Category</th>
                                      <th>Material</th>
                                      <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @if(isset($hsncodes) && count($hsncodes)>0)
                                    @php $srno = 1; @endphp
                                    @foreach($hsncodes as $hsncode)
                                    <tr>
                                      <td>{{ $srno }}</td>
                                      <td>{{ $hsncode->hsncode_name }}</td>
                                      <td>{{ isset($hsncode->category)?$hsncode->category->category_name:'' }}</td>
                                      <td>{{ isset($hsncode->subcategory)?$hsncode->subcategory->subcategory_name:'' }}</td>
                                      <td>{{ isset($hsncode->childcategory)?$hsncode->childcategory->sub_subcategory_name:'' }}</td>
                                      <td>{{ isset($hsncode->childcategory)?$hsncode->material->material_name:'' }}</td>
                                      <td>
                                        <!-- @can('Update') -->
                                        <!-- @endcan -->
                                        <a href="{{ url('admin/hsncodes/edit/'.$hsncode->hsncode_id) }}" class="btn btn-primary"><i class="bx bx-pencil"></i></a>
                                        <!-- @can('Delete') -->
                                        <!-- @endcan -->
                                        {!! Form::open([
                                            'method'=>'GET',
                                            'url' => ['admin/hsncodes/delete', $hsncode->hsncode_id],
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