@extends('backend.layouts.app')
@section('title', 'Custom Page Title')

@section('content')
<div class="app-content content">
  <div class="content-overlay"></div>
    <div class="content-wrapper">
      <div class="content-header row">
          <div class="content-header-left col-12 mb-2 mt-1">
            <div class="row breadcrumbs-top">
              <div class="col-12">
                <h5 class="content-header-title float-left pr-1 mb-0">Custom Page Title</h5>
                <div class="breadcrumb-wrapper col-12">
                  <ol class="breadcrumb p-0 mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active">Custom Page Title
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
                    <h4 class="card-title">Custom Page Title</h4>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                      <div class="col-12 text-right">
                        <!-- @if(isset($homepagesections) && $homepagesections->home_page_section_no_prod > count($custompagetitles))<a href="{{ route('admin.custompagetitles.create') }}" class="btn btn-primary"><i class="bx bx-plus"></i> Add </a>@endif -->
                        <a href="{{ route('admin.homepagesections') }}" class="btn btn-outline-secondary "><i class="bx bx-arrow-back"></i><span class="align-middle ml-25">Back</span></a>
                      </div>
                        <div class="table-responsive">
                            <table class="table zero-configuration" id="tbl-datatable">
                                <thead>
                                    <tr>
                                      <th>#</th>
                                      <th>Page</th>
                                      <th>Title</th>
                                      <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @if(isset($custompagetitles) && count($custompagetitles)>0)
                                    @php 
                                    $srno = 1; 
                                    $pages = ['home'=>'Home','list1'=>'Category','list2'=>'Sub Category','list3'=>'Child Category','product'=>'Product','cms'=>'CMS'];
                                    @endphp
                                    @foreach($custompagetitles as $custom_page_title)
                                    <tr>
                                      <td>{{ $srno }}</td>
                                      <td>{{ isset($pages[$custom_page_title->custom_page_title_code])?$pages[$custom_page_title->custom_page_title_code]:'' }}</td>
                                      <td>{{ $custom_page_title->custom_page_title_name }}</td>
                                      <td>
                                        <!-- @can('Update') -->
                                        <!-- @endcan -->
                                        <a href="{{ url('admin/custompagetitles/edit/'.$custom_page_title->custom_page_title_id) }}" class="btn btn-primary"><i class="bx bx-pencil"></i></a>
                                        
                                        <!-- @can('Delete') -->
                                        <!-- @endcan -->
                                        @if(false)
                                        {!! Form::open([
                                            'method'=>'GET',
                                            'url' => ['admin/custompagetitles/delete', $custom_page_title->custom_page_title_id],
                                            'style' => 'display:inline'
                                        ]) !!}
                                            {!! Form::button('<i class="bx bx-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger','onclick'=>"return confirm('Are you sure you want to Delete this Entry ?')"]) !!}
                                        {!! Form::close() !!}
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
