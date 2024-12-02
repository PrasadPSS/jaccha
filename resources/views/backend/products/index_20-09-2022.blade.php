@extends('backend.layouts.app')
@section('title', 'Products')

@section('content')
<div class="app-content content">
  <div class="content-overlay"></div>
    <div class="content-wrapper">
      <div class="content-header row">
          <div class="content-header-left col-12 mb-2 mt-1">
            <div class="row breadcrumbs-top">
              <div class="col-12">
                <h5 class="content-header-title float-left pr-1 mb-0">Products</h5>
                <div class="breadcrumb-wrapper col-12">
                  <ol class="breadcrumb p-0 mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active">Products
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
                    <h4 class="card-title">Products</h4>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                      <div class="col-12 text-right">
                        <a href="{{ route('admin.products.create') }}" class="btn btn-primary"><i class="bx bx-plus"></i> Add </a>
                        <a href="{{route('admin.products.excel')}} " class="btn btn-primary">Export</a>
                      </div>
                        <div class="table-responsive">
                            <table class="table zero-configuration" id="tbl-datatable">
                                <thead>
                                    <tr>
                                      <th>#</th>
                                      <th>Image</th>
                                      <th>SKU</th>
                                      <th>Brand</th>
                                      <th>Product Name</th>
                                      <th>Price</th>
                                      <th>Discounted Price</th>
                                      <th>Quantity</th>
                                      <th>Type</th>
                                      <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @if(isset($products) && count($products)>0)
                                    @php $srno = 1; @endphp
                                    @foreach($products as $product)
                                    <tr>
                                      <td>{{ $srno }}</td>
                                      <td><img class="card-img-top img-fluid mb-1" src="{{ asset('backend-assets/uploads/product_thumbs/') }}/{{ $product->product_thumb }}" alt="Product Image"></td>
                                      <td>{{ $product->product_sku }}</td>
                                      <td>{{ isset($product->brands)?$product->brands->brand_name:'' }}</td>
                                      <td>{{ $product->product_title }}</td>
                                      <td>{{ $product->product_price }}</td>
                                      <td>{{ $product->product_discounted_price }}</td>
                                      <td>{{ $product->product_qty }}</td>
                                      <td>{{ ($product->product_type=='configurable')?'Configurable':'Simple' }}</td>
                                      <td>

                                        <a href="{{ url('admin/products/edit/'.$product->product_id) }}" class="btn btn-primary"><i class="bx bx-pencil"></i></a>
                                        @if($product->product_type == 'configurable')
                                          <a href="{{ url('admin/productvariants/index/'.$product->product_id) }}" class="btn btn-primary"><i class="bx bx-eye"></i>Variants</a>
                                        @endif
                                        {!! Form::open([
                                            'method'=>'GET',
                                            'url' => ['admin/products/delete', $product->product_id],
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
