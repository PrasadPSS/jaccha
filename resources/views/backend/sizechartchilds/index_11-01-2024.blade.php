@extends('backend.layouts.app')
@section('title', 'Size Chart')

@section('content')
<div class="app-content content">
  <div class="content-overlay"></div>
    <div class="content-wrapper">
      <div class="content-header row">
          <div class="content-header-left col-12 mb-2 mt-1">
            <div class="row breadcrumbs-top">
              <div class="col-12">
                <h5 class="content-header-title float-left pr-1 mb-0">Size Chart</h5>
                <div class="breadcrumb-wrapper col-12">
                  <ol class="breadcrumb p-0 mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.sizecharts')}}">Size Chart</i></a>
                    </li>
                    <li class="breadcrumb-item active">Size Chart
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
                  <a href="{{ route('admin.sizecharts') }}" class="btn btn-outline-secondary mr-1 mb-1 float-right"><i class="bx bx-arrow-back"></i><span class="align-middle ml-25">Back</span></a>
                    <h4 class="card-title">Size Chart - {{ isset($sizecharts)?$sizecharts->size_chart_name:'' }}</h4>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                      <div class="col-12 text-right">

                      </div>
                        <div class="table-responsive">
                            <table class="table zero-configuration" id="tbl-datatable">
                                <thead>
                                  @if(isset($size_chart_types))
                                    </tr>
                                      <th>#</th>
                                      <th>Size</th>
                                      @foreach ($size_chart_types as $size_chart_type)
                                        <th>
                                        {{ $size_chart_type->size_chart_field_name }}
                                        </th>
                                      @endforeach
                                    </tr>
                                  @endif
                                </thead>
                                <tbody>
                                  @if(isset($size_chart_childs) && count($size_chart_childs)>0)
                                    @php $srno = 1; @endphp
                                    @foreach($size_chart_childs as $size_chart_child)
                                    <tr>
                                      <td>{{ $srno }}</td>
                                      @if(isset($size_chart_types))
                                      <td>{{ isset($size_chart_child->size->size_name)?$size_chart_child->size->size_name:'' }}</td>
                                      @foreach ($size_chart_types as $size_chart_type)
                                        <td>{{ $size_chart_child->{$size_chart_type->size_chart_field_code} }}</td>
                                      @endforeach


                                      @elseif($sizecharts->size_type == 'lower')
                                      <td>{{ isset($size_chart_child->size->size_name)?$size_chart_child->size->size_name:'' }}</td>
                                      <td>{{ $size_chart_child->brand_size }}</td>
                                      <td>{{ $size_chart_child->length_in }}</td>
                                      <td>{{ $size_chart_child->waist_in }}</td>
                                      <td>{{ $size_chart_child->inseam_length_in }}</td>
                                      <td>{{ $size_chart_child->hip_in }}</td>

                                      @elseif($sizecharts->size_type == 'shoes')
                                      <td>{{ isset($size_chart_child->size->size_name)?$size_chart_child->size->size_name:'' }}</td>
                                      <td>{{ $size_chart_child->brand_size }}</td>
                                      <td>{{ $size_chart_child->length_in }}</td>
                                      @endif
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
