@extends('backend.layouts.app')
@section('title', 'Special Deals')

@section('content')
<div class="app-content content">
  <div class="content-overlay"></div>
    <div class="content-wrapper">
      <div class="content-header row">
          <div class="content-header-left col-12 mb-2 mt-1">
            <div class="row breadcrumbs-top">
              <div class="col-12">
                <h5 class="content-header-title float-left pr-1 mb-0">Special Deals</h5>
                <div class="breadcrumb-wrapper col-12">
                  <ol class="breadcrumb p-0 mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active">Special Deals
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
        <form method="POST" action="{{url('admin/specialdeals/update')}}" accept-charset="UTF-8" class="form" enctype="multipart/form-data">
          {{ csrf_field() }}
          <input type="hidden" name="deals_id" value="1">
          <input type="hidden" name="category_id" value="{{$category_id}}">
          <div class="card">
                <div class="card-header">
                <a href="{{ url('admin/specialdeals/') }}" class="btn btn-outline-secondary float-right "><i class="bx bx-arrow-back"></i><span class="align-middle ml-25">Back</span></a>
                <input class="btn btn-primary float-right mr-1 mb-1" type="submit" value="Update Selected Products in Special Deals">
                    <h4 class="card-title">Special Deals</h4>
                </div>
                <div class="card-content">
                    <div class="card-body card-dashboard">
                      <div class="col-12 text-right">
                        <code>To add product in special deals, please select the products and click on "Update Selected Products in Special Deals" button</code><br>
                        <code>To add product in prices, change the prices and click on "Update" button of respective product</code>
                      </div>
                        <div class="table-responsive">
                            <table class="table zero-configuration table-responsive" id="tbl-datatable">
                                <thead>
                                    <tr>
                                      <th>
                                        <div class="form-group checkbox checkbox-primary">
                                          <input type="checkbox" class="" id="ckbCheckAll">
                                          <label for="ckbCheckAll"></label>
                                        </div>
                                      </th>
                                      <th>#</th>
                                      <th>Image</th>
                                      <!-- <th>SKU</th> -->
                                      <th>Product Name</th>
                                      <th>M.R.P.</th>
                                      <th>Discount Type</th>
                                      <th>Discount</th>
                                      <th>Discounted Price</th>
                                      <th>Updated M.R.P</th>
                                      <th>Updated Discount Type</th>
                                      <th>Updated Discount</th>
                                      <th>Updated Discounted Price</th>
                                      <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  @if(isset($products) && count($products)>0)
                                    @php $srno = 1; @endphp
                                    @foreach($products as $product)
                                    <tr data-id="{{$product->product_id}}">
                                      <td> 
                                        <div class="form-group checkbox checkbox-primary">
                                          <input type="checkbox" id="select_product_{{$product->product_id}}" class="select_deals" name="product_id[]" value="{{$product->product_id}}" @if(in_array($product->product_id, $deals_product_ids))checked @endif>
                                          <label for="select_product_{{$product->product_id}}"></label>
                                        </div>
                                      </td>
                                      <td>{{ $srno }}</td>
                                      <td><img class="card-img-top img-fluid mb-1" src="{{ asset('backend-assets/uploads/product_thumbs/') }}/{{ $product->product_thumb }}" alt="Product Image"></td>
                                      <!-- <td>{{ $product->product_sku }}</td> -->
                                      <td>{{ $product->product_title }}</td>
                                      <td><span id="set_product_price_{{$product->product_id}}">{{ $product->product_price }}</span></td>
                                      <td><span id="set_product_price_{{$product->product_id}}">{{ $product->product_discount_type }}</span></td>
                                      <td><span id="set_product_price_{{$product->product_id}}">{{ $product->product_discount }}</span></td>
                                      <td><span id="set_product_discounted_price_{{$product->product_id}}">{{ $product->product_discounted_price }}</span></td>
                                      <td><input type="number" name="price" placeholder="Enter Price" class="form-control product_price product_price_{{$product->product_id}}" data-id="{{$product->product_id}}"></td>
                                      <td> 
                                        <select class="select2 form-control product_discount_type product_discount_type_{{$product->product_id}}" id="" name="product_discount_type" data-id="{{$product->product_id}}"><option value="percent">Percent</option><option value="flat">Flat</option></select>    
                                      </td>
                                      <td> <input class="form-control product_discount product_discount_{{$product->product_id}}" placeholder="Enter Product Discount" id="" name="product_discount" type="text" data-id="{{$product->product_id}}"> </td>
                                      <td><input type="number" name="product_discounted_price" placeholder="Enter Price" class="form-control product_discounted_price product_discounted_price_{{$product->product_id}}" readonly data-id="{{$product->product_id}}"></td>
                                      <!-- <td>{{ $product->product_qty }}</td> -->
                                      <!-- <td>{{ ($product->product_type=='configurable')?'Configurable':'Simple' }}</td> -->
                                      <td>

                                        <input type="button" class="btn btn-primary update_product" value="Update" data-id="{{$product->product_id}}">
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
          </form>
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
    checkallcheckbox();
    $('#ckbCheckAll').on('change',function()
    {
      if(($(this).prop('checked')))
      {
        $('.select_deals').prop('checked',true);
      }
      else
      {
        $('.select_deals').prop('checked',false);
      }
    });
    $('.select_deals').on('change',function()
    {
      checkallcheckbox();
    });
    function checkallcheckbox()
    {
      if ( $('.select_deals').length == $('.select_deals:checked').length)  
      {
        $('#ckbCheckAll').prop('checked',true);
      }
      else
      {
        $('#ckbCheckAll').prop('checked',false);
      }
    }
    $('.product_price,.product_discount_type,.product_discount').on('change',function()
    {
      var product_id = $(this).data('id');
      if($(this).val() != "")
      {
        var product_discount_type = $(".product_discount_type_"+product_id).val();
        var product_discount = $(".product_discount_"+product_id).val();
        var product_price = $(".product_price_"+product_id).val();
        if($(".product_discount_type_"+product_id).val() != "" && $(".product_discount_"+product_id).val() != "")
        {
          
          if (product_discount_type=='percent')
          {
            product_discounted_price = product_price - ((product_price*product_discount)/100);
          }
          else
          {
            product_discounted_price = product_price - product_discount;
          }
          console.log(product_discounted_price );
          $(".product_discounted_price_"+product_id).val(product_discounted_price);
        }
        else
        {
          $(".product_discounted_price_"+product_id).val(product_price);
        }
      }
      console.log($(this).val() );
    });
    $('.update_product').on('click',function()
    {
      var product_id = $(this).data('id');
      var product_discount_type = $(".product_discount_type_"+product_id).val();
      var product_discount = $(".product_discount_"+product_id).val();
      var product_price = $(".product_price_"+product_id).val();
      var product_discounted_price = $(".product_discounted_price_"+product_id).val();
      if(product_price !="" && product_discounted_price !="")
      {
        $.ajax({
          url: '{{url("admin/products/updateprice")}}',
          type: 'post',
          data:
          {
            product_id: product_id ,product_discount_type: product_discount_type ,
            product_discount: product_discount ,product_price: product_price ,
            product_discounted_price: product_discounted_price ,_token: "{{ csrf_token() }}",
          },
          success: function (data)
          {
            console.log(data);
            if(data)
            {
              $("#set_product_price_"+product_id).text(data.product_price);
              $("#set_product_discounted_price_"+product_id).text(data.product_discounted_price);
              alert('Product Price Updated');
            }
            // $('#filter_list').html(data);
          }
        });
      }
    });
  });
</script>
@endsection
