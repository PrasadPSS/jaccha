@extends('backend.layouts.app')
@section('title', 'Best Seller')

@section('content')
<div class="app-content content">
  <div class="content-overlay"></div>
    <div class="content-wrapper">
      <div class="content-header row">
          <div class="content-header-left col-12 mb-2 mt-1">
            <div class="row breadcrumbs-top">
              <div class="col-12">
                <h5 class="content-header-title float-left pr-1 mb-0">Best Seller</h5>
                <div class="breadcrumb-wrapper col-12">
                  <ol class="breadcrumb p-0 mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active">Best Seller
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
                    <h4 class="card-title">Best Seller</h4>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                      <div class="col-12 text-right">
                        <!-- @if(isset($homepagesections) && $homepagesections->home_page_section_no_prod > count($homepagefeaturedproducts))<a href="{{ route('admin.homepagefeaturedproducts.create') }}" class="btn btn-primary"><i class="bx bx-plus"></i> Add </a>@endif -->
                        <a href="{{ route('admin.homepagesections') }}" class="btn btn-outline-secondary "><i class="bx bx-arrow-back"></i><span class="align-middle ml-25">Back</span></a>
                      </div>
                        <div class="table-responsive">
                            <table class="table zero-configuration" id="tbl-datatable">
                                <thead>
                                    <tr>
                                      <th>#</th>
                                      <th>Feature Name</th>
                                      <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @if(isset($homepagefeaturedproducts) && count($homepagefeaturedproducts)>0)
                                    @php $srno = 1; @endphp
                                    @foreach($homepagefeaturedproducts as $home_page_featured_product)
                                    <tr>
                                      <td>{{ $srno }}</td>
                                      <td>{{ $home_page_featured_product->home_page_featured_product_name }}</td>
                                      <td>
                                        <!-- @can('Update') -->
                                        <!-- @endcan -->
                                        <a href="{{ url('admin/homepagefeaturedproducts/edit/'.$home_page_featured_product->home_page_featured_product_id) }}" class="btn btn-primary"><i class="bx bx-pencil"></i></a>
                                        <!-- <a href="{{ url('admin/faquestions/index/'.$home_page_featured_product->home_page_featured_product_id) }}" class="btn btn-primary"><i class="bx bx-bullseye"></i></a> -->
                                        <!-- @can('Delete') -->
                                        <!-- @endcan -->
                                        @if(false)
                                        {!! Form::open([
                                            'method'=>'GET',
                                            'url' => ['admin/homepagefeaturedproducts/delete', $home_page_featured_product->home_page_featured_product_id],
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
