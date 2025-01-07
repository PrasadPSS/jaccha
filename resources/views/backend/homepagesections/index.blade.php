@extends('backend.layouts.app')
@section('title', 'Home Page Sections')

@section('content')
@php
$size_types = ['upper'=>'Uppers','lower'=>'Lowers','shoes'=>'Shoes'];
@endphp
<div class="app-content content">
  <div class="content-overlay"></div>
    <div class="content-wrapper">
      <div class="content-header row">
          <div class="content-header-left col-12 mb-2 mt-1">
            <div class="row breadcrumbs-top">
              <div class="col-12">
                <h5 class="content-header-title float-left pr-1 mb-0">Home Page Sections</h5>
                <div class="breadcrumb-wrapper col-12">
                  <ol class="breadcrumb p-0 mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active">Home Page Sections
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
            <div class="card ">
                <div class="card-header">
                    <h4 class="card-title">Home Page Sections</h4>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                      <div class="col-12 text-right">
                        <a href="{{ route('admin.homepagesections.create') }}" class="btn btn-primary"><i class="bx bx-plus"></i> Add </a>
                      </div>
                        <div class="table-responsive">
                            <table class="table " id="tbl-datatable">
                              <!-- zero-configuration -->
                                <thead>
                                    <tr>
                                      <th>#</th>
                                      <th>Section Name</th>
                                      <th>Type</th>
                                      <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="sort">
                                  @if(isset($homepagesections) && count($homepagesections)>0)
                                    @php $srno = 1; @endphp
                                    @foreach($homepagesections as $home_page_section)
                                    <tr class="" data-section-id="{{ $home_page_section->home_page_section_id }}">
                                      <td>{{ $srno }}</td>
                                      <td>{{ $home_page_section->home_page_section_name }}</td>
                                      <td>{{ isset($home_page_section->home_page_section_type)?$home_page_section->home_page_section_type->home_page_section_type_name:'' }}</td>
                                      <td>

                                        <a href="{{ url('admin/homepagesections/edit/'.$home_page_section->home_page_section_id) }}" class="btn btn-primary"><i class="bx bx-pencil"></i></a>
                                        @if(isset($home_page_section->home_page_section_type->home_page_section_type_code) && $home_page_section->home_page_section_type->home_page_section_type_code == 'featured_products')
                                          <a href="{{ url('admin/homepagefeaturedproducts/') }}" class="btn btn-primary"><i class="bx bx-eye"></i>Content</a>
                                        @else
                                          <a href="{{ url('admin/homepagesectionchilds/index/'.$home_page_section->home_page_section_id) }}" class="btn btn-primary"><i class="bx bx-eye"></i>Content</a>
                                        @endif
                                        @if(!isset($home_page_section->home_page_section_type->home_page_section_type_code) && $home_page_section->home_page_section_type->home_page_section_type_code != 'featured_products')
                                        {!! Form::open([
                                            'method'=>'GET',
                                            'url' => ['admin/homepagesections/delete', $home_page_section->home_page_section_id],
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
    $("#widget-todo-list").sortable({
        handle: ".cursor-move",
        update: function(event, ui)
        {
            var orderIds = new Array();
            $("#widget-todo-list li").each(function() {
                orderIds.push($(this).data("home-page-section-id"));
            });

            axios.post(`{{url("admin/homepagesectionchilds/getproductvariants")}}`, {
                orderIds: orderIds
            })
            .catch(function (error) {
                console.log(error);
            });

        }
      });

      $('#sort').sortable({
          cursor: 'move',
          axis:   'y',
          update: function(e, ui) {
              href = '{{url("admin/homepagesections/setsectionorder")}}';
              $(this).sortable("refresh");
              sorted = $(this).sortable("serialize", {key:'id'});
              var orderIds = new Array();
              $("#sort tr").each(function() {
                  orderIds.push($(this).data("section-id"));
              });
              // var enw = sorted.split('&');
              // console.log(sorted);
              $.ajax({
                  type:   'POST',
                  url:    href,
                  data:   {sorted:orderIds, _token: "{{ csrf_token() }}",},
                  // dataType: 'json',
                  success: function(msg)
                  {
                    alert(msg);
                  }
              });
          }
      });
  });
</script>
@endsection
