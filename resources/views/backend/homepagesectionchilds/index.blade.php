@extends('backend.layouts.app')
@section('title', 'Home Page Section Childs')

@section('content')
<div class="app-content content">
  <div class="content-overlay"></div>
    <div class="content-wrapper">
      <div class="content-header row">
          <div class="content-header-left col-12 mb-2 mt-1">
            <div class="row breadcrumbs-top">
              <div class="col-12">
                <h5 class="content-header-title float-left pr-1 mb-0">Home Page Section Childs</h5>
                <div class="breadcrumb-wrapper col-12">
                  <ol class="breadcrumb p-0 mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.homepagesections')}}">Home Page Section Childs</i></a>
                    </li>
                    <li class="breadcrumb-item active">Home Page Section Childs
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
                  <a href="{{ route('admin.homepagesections') }}" class="btn btn-outline-secondary mr-1 mb-1 float-right"><i class="bx bx-arrow-back"></i><span class="align-middle ml-25">Back</span></a>
                  @if(isset($homepagesections) && ($homepagesections->home_page_section_no_prod > count($home_page_section_childs) ))<a href="{{ url('admin/homepagesectionchilds/create') }}/{{ isset($homepagesections)?$homepagesections->home_page_section_id:'' }}" class="btn btn-primary mr-1 mb-1 float-right"><i class="bx bx-plus"></i> Add </a>@endif
                    <h4 class="card-title">Home Page Section Childs - {{ isset($homepagesections)?$homepagesections->home_page_section_name:'' }}</h4>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                      <div class="col-12 text-right">

                      </div>
                        <div class="table-responsive">
                            <table class="table zero-configuration" id="tbl-datatable">
                                <thead>
                                  @if(isset($home_page_section_types))
                                    </tr>
                                      <th>#</th>
                                      @foreach ($home_page_section_types as $home_page_section_type)
                                        <th>
                                        {{ $home_page_section_type->home_page_section_field_name }}
                                        </th>
                                      @endforeach
                                      <th>Action</th>
                                    </tr>
                                  @endif
                                </thead>
                                <tbody>
                                   
                                  @if(isset($home_page_section_childs) && count($home_page_section_childs)>0)
                                    @php $srno = 1; @endphp
                                    @foreach($home_page_section_childs as $home_page_section_child)

                                    <tr>
                                      <td>{{ $srno }}</td>
                                      <td>
                                        <a href="{{ url('admin/homepagesectionchilds/edit/'.$home_page_section_child->home_page_section_child_id) }}" class="btn btn-primary"><i class="bx bx-pencil"></i></a>

                                        {!! Form::open([
                                            'method'=>'GET',
                                            'url' => ['admin/homepagesectionchilds/delete', $home_page_section_child->home_page_section_child_id],
                                            'style' => 'display:inline'
                                        ]) !!}
                                            {!! Form::button('<i class="bx bx-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger','onclick'=>"return confirm('Are you sure you want to Delete this Entry ?')"]) !!}
                                        {!! Form::close() !!}
                                      </td>
                                      @if(isset($home_page_section_types))
                                      @foreach ($home_page_section_types as $home_page_section_type)
                                      @if($home_page_section_type->home_page_section_field_code == 'images' && isset($home_page_section_child->home_page_section_child_images))
                                        <td><img class="img-fluid" height="100" width="100" src="{{ asset('backend-assets/uploads/home_page_section_child_images/'.$home_page_section_child->home_page_section_child_images) }}" alt="Img"></td>
                                      @elseif($home_page_section_type->home_page_section_field_code == 'video_url' && isset($home_page_section_child->home_page_section_child_video_url))
                                        @php 
                                            $path = parse_url($home_page_section_child->home_page_section_child_video_url, PHP_URL_PATH);
    
                                            // Get the video ID, which is the basename of the URL path
                                            $videoId = basename($path);
                                            //$home_page_section_child->home_page_section_child_video_url
                                        @endphp
                                        <td><iframe class=" youtube w-100" src="https://www.youtube.com/embed/{{ $videoId }}" title="Dadreeios" allowfullscreen></iframe></td>
                                      @else
                                        <td>{{ $home_page_section_child->{'home_page_section_child_'.$home_page_section_type->home_page_section_field_code} }}</td>
                                      @endif
                                      @endforeach
                                     

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
