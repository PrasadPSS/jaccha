@extends('backend.layouts.app')
@section('title', 'Product Variants')

@section('content')
<div class="app-content content">
  <div class="content-overlay"></div>
    <div class="content-wrapper">
      <div class="content-header row">
          <div class="content-header-left col-12 mb-2 mt-1">
            <div class="row breadcrumbs-top">
              <div class="col-12">
                <h5 class="content-header-title float-left pr-1 mb-0">Product Variants</h5>
                <div class="breadcrumb-wrapper col-12">
                  <ol class="breadcrumb p-0 mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.products')}}">Products</i></a>
                    </li>
                    <li class="breadcrumb-item active">Product Variants
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
                  <a href="{{ route('admin.products') }}" class="btn btn-outline-secondary mr-1 mb-1 float-right"><i class="bx bx-arrow-back"></i><span class="align-middle ml-25">Back</span></a>
                    <h4 class="card-title">Product Variants</h4>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                      <div class="col-12 text-right">

                      </div>
                        <div class="table-responsive">
                            <table class="table zero-configuration" id="tbl-datatable">
                                <thead>
                                    <tr>
                                      <th>#</th>
                                      <th>Product Name</th>
                                      <th>Price</th>
                                      <th>Quantity</th>
                                      <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @if(isset($products) && count($products)>0)
                                    @php $srno = 1; @endphp
                                    @foreach($products as $product)
                                    <tr>
                                      <td>{{ $srno }}</td>
                                      <td>{{ $product->product_title }}</td>
                                      <td>{{ $product->product_price }}</td>
                                      <td>{{ $product->product_qty }}</td>
                                      <!-- <td>{{ ($product->has_subproducts==1)?'Yes':'No' }}</td> -->
                                      <td>

                                        <a href="{{ url('admin/productvariants/edit/'.$product->product_variant_id) }}" class="btn btn-primary"><i class="bx bx-pencil"></i></a>

                                        {!! Form::open([
                                            'method'=>'GET',
                                            'url' => ['admin/productvariants/delete', $product->product_variant_id],
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
