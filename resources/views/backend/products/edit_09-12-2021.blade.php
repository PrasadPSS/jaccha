@extends('backend.layouts.app')
@section('title', 'Edit Product')

@section('content')
@php
$status = ['No'=>'No','Yes'=>'Yes'];
$product_types = ['simple'=>'Simple','configurable'=>'Configurable'];

@endphp
<div class="app-content content">
  <div class="content-overlay"></div>
    <div class="content-wrapper">
      <div class="content-header row">
          <div class="content-header-left col-12 mb-2 mt-1">
            <div class="row breadcrumbs-top">
              <div class="col-12">
                <h5 class="content-header-title float-left pr-1 mb-0">Edit Product</h5>
                <div class="breadcrumb-wrapper col-12">
                  <ol class="breadcrumb p-0 mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active">Edit
                    </li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
        </div>
        <section id="multiple-column-form">
          <div class="row match-height">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <a href="{{ request()->headers->get('referer') }}" class="btn btn-outline-secondary mr-1 mb-1 float-right"><i class="bx bx-arrow-back"></i><span class="align-middle ml-25">Back</span></a>
                  <h4 class="card-title">Edit Product</h4>
                </div>
                <div class="card-content">
                  <div class="card-body">
                    @include('backend.includes.errors')
                    {!! Form::model($products, [
                        'method' => 'POST',
                        'url' => ['admin/products/update'],
                        'class' => 'form',
                        'enctype' => 'multipart/form-data'
                    ]) !!}
                      <div class="form-body">
                        <!-- <h2>General</h2> -->
                        <div class="row">
                          <div class="col-md-6 col-12">
                            <div class="form-group">
                              {{ Form::label('product_sku', 'Product SKU ') }}
                              {{ Form::text('product_sku', null, ['class' => 'form-control', 'placeholder' => 'Enter Product SKU', 'required' => true,'id'=>'product_sku']) }}
                            </div>
                          </div>
                          <div class="col-md-6 col-12">
                            <fieldset class="form-group">
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  {{ Form::label('product_type', 'Type ',['class'=>'']) }}
                                </div>
                                {{ Form::select('product_type', $product_types ,  $products->product_type,['class'=>'select2 form-control ', 'placeholder' => 'Please Select Type','id'=>'product_type','disabled' => true]) }}
                                {{ Form::hidden('product_type', $products->product_type,['id'=>'product_type']) }}
                              </div>
                            </fieldset>
                          </div>
                          <div class="col-md-12 col-12">
                            <div class="form-group">
                              {{ Form::hidden('product_id', $products->product_id,['id'=>'product_id']) }}
                              {{ Form::label('product_title', 'Product Title ') }}
                              {{ Form::text('product_title', null, ['class' => 'form-control', 'placeholder' => 'Enter Product Title', 'required' => true]) }}
                              </div>
                            </div>
                            {{-- <div class="col-md-12 col-12">
                              <div class="form-group">
                                {{ Form::label('product_sub_title', 'Product Sub Title ') }}
                                {{ Form::text('product_sub_title', null, ['class' => 'form-control', 'placeholder' => 'Enter Product Sub Title', ]) }}
                              </div>
                            </div> --}}
                            <div class="col-md-6 col-12">
                              <fieldset class="form-group">
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    {{ Form::label('hsncode_id', 'HSN Code ',['class'=>'']) }}
                                  </div>
                                  {{ Form::select('hsncode_id', $hsncodes , null,['class'=>'select2 form-control ', 'placeholder' => 'Please Select HSN Code']) }}
                                </div>
                              </fieldset>
                            </div>
                            <div class="col-md-6 col-12">
                              <div class="form-group">
                                {{ Form::label('product_price', 'Product Price ') }}
                                {{ Form::text('product_price', null, ['class' => 'form-control', 'placeholder' => 'Enter Product Price', 'required' => true,'id'=>'product_price', ]) }}
                              </div>
                            </div>
                            <div class="col-md-6 col-12">
                              <fieldset class="form-group">
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    {{ Form::label('product_discount_type', 'Discount Type ',['class'=>'']) }}
                                  </div>
                                  {{ Form::select('product_discount_type', ['percent'=>'Percent','flat'=>'Flat'] , null,['class'=>'select2 form-control ','id'=>'product_discount_type']) }}
                                </div>
                              </fieldset>
                            </div>
                            <div class="col-md-6 col-12">
                              <div class="form-group">
                                {{ Form::label('product_discount', 'Product Discount ') }}
                                {{ Form::text('product_discount', null, ['class' => 'form-control', 'placeholder' => 'Enter Product Discount','id'=>'product_discount', ]) }}
                              </div>
                            </div>
                            <div class="col-md-6 col-12">
                              <div class="form-group">
                                {{ Form::label('product_discounted_price', 'Product Discounted Price ') }}
                                {{ Form::text('product_discounted_price', null, ['class' => 'form-control', 'placeholder' => 'Enter Product Discounted Price','id'=>'product_discounted_price', ]) }}
                              </div>
                            </div>
                            <div class="col-md-6 col-12" id="config_product_qty" style="display:none;">
                              <div class="form-group">
                                {{ Form::label('product_qty', 'Product Quantity ') }}
                                {{ Form::text('product_qty', null, ['class' => 'form-control', 'placeholder' => 'Enter Product Quantity', ]) }}
                              </div>
                            </div>
                            <div class="col-md-6 col-12" id="sim_color_div_edit" style="display:none;">
                              {{ Form::label('color_id', 'Colors ',['class'=>'']) }}
                              <fieldset class="form-group">
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                  </div>
                                  {{ Form::select('color_id', $color_list, $products->color_id,['class'=>'select2 form-control ','id'=>'sim_color_id','placeholder'=>'Please Select']) }}
                                </div>
                              </fieldset>
                            </div>
                            <div class="col-md-6 col-12" id="sim_size_div_edit" style="display:none;">
                              {{ Form::label('size_id', 'Sizes ',['class'=>'']) }}
                              <fieldset class="form-group">
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                  </div>
                                  {{ Form::select('size_id', $size_list, $products->size_id,['class'=>'select2 form-control ', 'id'=>'sim_size_id','placeholder'=>'Please Select']) }}
                                </div>
                              </fieldset>
                            </div>

                            <div class="col-lg-12 col-md-12 mt-1 repeater-default"  id="variantsdiv" style="display:none;">
                              <div class="form-group">
                                <div class="col p-0">
                                  <button class="btn btn-primary"  type="button" data-toggle="modal" id="onshowbtn" data-target="#onshow"><i class="bx bx-plus"></i>
                                    Add Variants
                                  </button>
                                </div>
                              </div>
                              <table class="table table-responsive table-bordered ">
                                <thead>
                                  <tr>
                                    <th>SKU</th>
                                    <th>Name</th>
                                    <th>Color</th>
                                    <th>Size</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                  </tr>
                                </thead>
                                <tbody id="variantstable" data-repeater-list="added_variants">
                                  @if(isset($product_variants) && count($product_variants)>0)
                                    @foreach($product_variants as $product_variant)
                                      <tr data-repeater-item>
                                        <td>
                                          <input type="hidden" name="added_variants[{{ $product_variant->product_variant_id }}][product_variant_id]" value="{{ $product_variant->product_variant_id }}">
                                          <input type="text" name="added_variants[{{ $product_variant->product_variant_id }}][product_sku]" class="form-control" value="{{ $product_variant->product_sku }}" required>
                                        </td>
                                        <td>
                                          <input type="text" name="added_variants[{{ $product_variant->product_variant_id }}][product_title]" class="form-control" value="{{ $product_variant->product_title }}" required>
                                        </td>
                                        <td>
                                          <input type="hidden" name="added_variants[{{ $product_variant->product_variant_id }}][color_id]" value="{{ $product_variant->color_id }}">
                                          {{ isset( $product_variant->color)?$product_variant->color->color_name:'-' }}
                                        </td>
                                        <td>
                                          <input type="hidden" name="added_variants[{{ $product_variant->product_variant_id }}][size_id]" value="{{ $product_variant->size_id }}">
                                          {{ isset($product_variant->size->size_name)?$product_variant->size->size_name:'-' }}
                                        </td>
                                        <td>
                                          <input type="text" name="added_variants[{{ $product_variant->product_variant_id }}][product_qty]" class="form-control" value="{{ $product_variant->product_qty }}" required>
                                        </td>
                                        <td>
                                          <input type="text" name="added_variants[{{ $product_variant->product_variant_id }}][product_price]" class="form-control" value="{{ $product_variant->product_price }}" required>
                                        </td>
                                        <td>
                                          <select class="select2 form-control" name="added_variants[{{ $product_variant->product_variant_id }}][visibility]" required>
                                            <option value="1" {{ ($product_variant->visibility==1)?'selected':'' }}>Enabled</option>
                                            <option value="0" {{ ($product_variant->visibility==0)?'selected':'' }}>Disabled</option>
                                          </select>
                                        </td>
                                        <td>
                                          <button class="btn btn-danger text-nowrap px-1" data-repeater-delete type="button">
                                            <i class="bx bx-x"></i>
                                          </button>
                                        </td>
                                      </tr>
                                    @endforeach
                                  @endif
                                </tbody>
                              </table>
                            </div>
                            <div class="modal fade text-left" id="onshow" tabindex="-1" role="dialog" aria-labelledby="myModalLabel21"
                              aria-hidden="true">
                              <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel21">Add Variants</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <i class="bx bx-x"></i>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <div class="col-md-12 col-12" id="sim_color_div_edit" >
                                      {{ Form::label('variant_color_id', 'Colors ',['class'=>'']) }}
                                      <fieldset class="form-group">
                                        <div class="input-group">
                                          <div class="input-group-prepend">
                                          </div>
                                          {{ Form::select('variant_color_id', $color_list, '',['class'=>'select2 form-control ','id'=>'variant_color_id', 'placeholder' => 'Select']) }}
                                        </div>
                                      </fieldset>
                                    </div>
                                    <div class="col-md-12 col-12" id="sim_size_div_edit" >
                                      {{ Form::label('variant_size_id', 'Sizes ',['class'=>'']) }}
                                      <fieldset class="form-group">
                                        <div class="input-group">
                                          <div class="input-group-prepend">
                                          </div>
                                          {{ Form::select('variant_size_id', $size_list, '',['class'=>'select2 form-control ', 'id'=>'variant_size_id', 'placeholder' => 'Select']) }}
                                        </div>
                                      </fieldset>
                                    </div>
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-light-secondary" data-dismiss="modal">
                                      <i class="bx bx-x d-block d-sm-none"></i>
                                      <span class="d-none d-sm-block">Cancel</span>
                                    </button>
                                    <button type="button" class="btn btn-primary ml-1"  id="modal_add_variants">
                                      <i class="bx bx-check d-block d-sm-none"></i>
                                      <span class="d-none d-sm-block">Add</span>
                                    </button>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="modal fade text-left" id="variant_toast" tabindex="-1" role="dialog"
                              aria-labelledby="myModalLabel120" aria-hidden="true">
                              <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                <div class="modal-content">
                                  <div class="modal-header bg-danger">
                                    <h5 class="modal-title white" id="myModalLabel120">Warning</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <i class="bx bx-x"></i>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    Variant with same attribute options already exists.
                                  </div>
                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-light-secondary" data-dismiss="modal">
                                      <i class="bx bx-x d-block d-sm-none"></i>
                                      <span class="d-none d-sm-block">Close</span>
                                    </button>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div class="col-md-12 col-12">
                              <div class="form-group">
                                {{ Form::label('product_desc', 'Product Description ') }}
                                {{ Form::textarea('product_desc', null, ['class' => 'form-control', 'placeholder' => 'Enter Product Description', 'id'=>'editor2']) }}
                              </div>
                            </div>
                            <div class="col-md-6 col-12">
                            <fieldset class="form-group">
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  {{ Form::label('category_id', 'Category ',['class'=>'']) }}
                                </div>
                                {{ Form::select('category_id', $categories, $products->category_id,['class'=>'select2 form-control category', 'placeholder' => 'Please Select Category',]) }}
                              </div>
                            </fieldset>
                          </div>
                          <div class="col-md-6 col-12">
                            <fieldset class="form-group">
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  {{ Form::label('sub_category_id', 'Sub Category ',['class'=>'']) }}
                                </div>
                                {{ Form::select('sub_category_id', $sub_categories, $products->sub_category_id,['class'=>'select2 form-control subcategory', 'placeholder' => 'Please Select Sub Category',]) }}
                              </div>
                            </fieldset>
                          </div>
                          <div class="col-md-6 col-12">
                            <fieldset class="form-group">
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  {{ Form::label('sub_sub_category_id', 'Child Category ',['class'=>'']) }}
                                </div>
                                {{ Form::select('sub_sub_category_id', $sub_sub_categories, $products->sub_sub_category_id,['class'=>'select2 form-control subsubcategory', 'placeholder' => 'Please Select Child Category',]) }}
                              </div>
                            </fieldset>
                          </div>
                          <div class="col-md-6 col-12">
                            <div class="form-group">
                              {{ Form::label('product_generic_name', 'Product Generic Name ') }}
                              {{ Form::text('product_generic_name', null, ['class' => 'form-control', 'placeholder' => 'Enter Product Generic Name', ]) }}
                            </div>
                          </div>

                          <div class="col-md-6 col-12">
                            <div class="form-group">
                              {{ Form::label('product_weight', 'Product Weight(gms) *') }}
                              {{ Form::number('product_weight', null, ['class' => 'form-control', 'placeholder' => 'Enter Product Weight', ]) }}
                            </div>
                          </div>

                          <div class="col-lg-12 col-md-12 mt-1">
                            <fieldset class="form-group">
                              {{ Form::label('product_specification', 'Specifications *') }}
                                {{ Form::textarea('product_specification', null, ['class' => 'form-control', 'placeholder' => 'Enter Address', 'id'=>'editor']) }}
                            </fieldset>
                          </div>
                          <div class="col-lg-12 col-md-12 mt-1">
                            <fieldset class="form-group">
                              {{ Form::label('product_disclaimer', 'Disclaimer *') }}
                                {{ Form::textarea('product_disclaimer', null, ['class' => 'form-control', 'placeholder' => 'Enter Address', 'id'=>'editor1']) }}
                            </fieldset>
                          </div>
                          <div class="col-md-6 col-12">
                            <div class="form-group">
                              {{ Form::label('meta_title', 'Product Meta Title ') }}
                              {{ Form::text('meta_title', null, ['class' => 'form-control', 'placeholder' => 'Enter Product Meta Title', ]) }}
                            </div>
                          </div>
                          <div class="col-md-6 col-12">
                            <div class="form-group">
                              {{ Form::label('meta_desc', 'Product Meta Description ') }}
                              {{ Form::text('meta_desc', null, ['class' => 'form-control', 'placeholder' => 'Enter Product Meta Description', ]) }}
                            </div>
                          </div>
                          <div class="col-md-6 col-12">
                            <div class="form-group">
                              {{ Form::label('meta_keywords', 'Product Meta Keywords ') }}
                              {{ Form::text('meta_keywords', null, ['class' => 'form-control', 'placeholder' => 'Enter Product Meta Keywords', ]) }}
                            </div>
                          </div>
                          <div class="col-md-6 col-12">
                            <div class="form-group">
                              {{ Form::label('og_title', 'Product OG Title ') }}
                              {{ Form::text('og_title', null, ['class' => 'form-control', 'placeholder' => 'Enter Product OG Title', ]) }}
                            </div>
                          </div>
                          <div class="col-md-6 col-12">
                            <div class="form-group">
                              {{ Form::label('og_desc', 'Product OG Description ') }}
                              {{ Form::text('og_desc', null, ['class' => 'form-control', 'placeholder' => 'Enter Product OG Description', ]) }}
                            </div>
                          </div>
                            <div class="col-md-6 col-12">
                              <fieldset class="form-group">
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    {{ Form::label('country_id', 'Country of Origin ',['class'=>'']) }}
                                  </div>
                                  {{ Form::select('country_id', $countries, $products->country_id,['class'=>'select2 form-control ', 'placeholder' => 'Please Select Country of Origin',]) }}
                                </div>
                              </fieldset>
                            </div>
                            <div class="col-md-6 col-12">
                              <fieldset class="form-group">
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    {{ Form::label('seller_id', 'Seller ',['class'=>'']) }}
                                  </div>
                                  {{ Form::select('seller_id', $sellers, $products->seller_id,['class'=>'select2 form-control ', 'placeholder' => 'Please Select Seller',]) }}
                                </div>
                              </fieldset>
                            </div>
                            <div class="col-md-6 col-12">
                              <fieldset class="form-group">
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    {{ Form::label('manufacturer_id', 'Manufacturer ',['class'=>'']) }}
                                  </div>
                                  {{ Form::select('manufacturer_id', $manufacturers, $products->manufacturer_id,['class'=>'select2 form-control ','id'=>'manufacturer_id', 'placeholder' => 'Please Select Manufacturer',]) }}
                                </div>
                              </fieldset>
                            </div>

                            <div class="col-md-6 col-12">
                              <fieldset class="form-group">
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    {{ Form::label('brand_id', 'Brand ',['class'=>'']) }}
                                  </div>
                                  {{ Form::select('brand_id', $brand_list, $products->brand_id,['class'=>'select2 form-control ', 'placeholder' => 'Please Select Brand','id'=>'brand_id',]) }}
                                </div>
                              </fieldset>
                            </div>
                            <div class="col-md-6 col-12">
                              <fieldset class="form-group">
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    {{ Form::label('packer_id', 'Packer ',['class'=>'']) }}
                                  </div>
                                  {{ Form::select('packer_id', $packers, $products->packer_id,['class'=>'select2 form-control ', 'placeholder' => 'Please Select Packer',]) }}
                                </div>
                              </fieldset>
                            </div>
                            <div class="col-md-6 col-12">
                              <fieldset class="form-group">
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    {{ Form::label('importer_id', 'Importer ',['class'=>'']) }}
                                  </div>
                                  {{ Form::select('importer_id', $importers, $products->importer_id,['class'=>'select2 form-control ', 'placeholder' => 'Please Select Importer',]) }}
                                </div>
                              </fieldset>
                            </div>
                            <div class="col-md-6 col-12">
                              <fieldset class="form-group">
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                    {{ Form::label('size_chart_id', 'Size Chart ',['class'=>'']) }}
                                  </div>
                                  {{ Form::select('size_chart_id', $size_chart_list, $products->size_chart_id,['class'=>'select2 form-control ', 'placeholder' => 'Please Select Size Chart',]) }}
                                </div>
                              </fieldset>
                            </div>
                            <div class="col-md-6 col-6">
                              {{ Form::label('visibility', 'Show / Hide') }}
                              <fieldset class="">
                                <div class="radio radio-success">
                                  {{ Form::radio('visibility','1',true,['id'=>'radioshow']) }}
                                  {{ Form::label('radioshow', 'Yes') }}
                                </div>
                              <!-- </fieldset>
                              <fieldset> -->
                                <div class="radio radio-danger">
                                  {{ Form::radio('visibility','0',false,['id'=>'radiohide']) }}
                                  {{ Form::label('radiohide', 'No') }}
                                </div>
                              </fieldset>
                            </div>
                            <div class="col-md-6 col-6">
                              {{ Form::label('filter_id', 'Filters ',['class'=>'']) }}
                              <fieldset class="form-group">
                                <div class="input-group">
                                  <div class="input-group-prepend">
                                  </div>
                                  {{ Form::select('filter_id[]', $filter_list, $filter_values,['class'=>'select2 form-control ', 'multiple'=>'multiple']) }}
                                </div>
                              </fieldset>
                            </div>

                            <div class="col-md-12 col-12">
                              <div class="custom-control custom-switch custom-control-inline mb-1">
                                <span>New Arrival</span>
                                <input type="checkbox" class="custom-control-input" id="new_arrival" name="new_arrival" value="1" {{ ($products->new_arrival==1)?'checked':'' }}>
                                <!-- {{ Form::checkbox('new_arrival', null, ['class' => 'custom-control-input', 'id' => 'new_arrival', ]) }} -->
                                <!-- {!! Form::checkbox('new_arrival', '1') !!} -->
                                <label class="custom-control-label ml-1" for="new_arrival">
                                </label>
                                <!-- {{ Form::label('new_arrival', '',['class'=>'custom-control-label ml-1']) }} -->
                              </div>
                            </div>
                            <div class="col-md-12 col-12">
                              <div class="form-group">
                                {{ Form::label('product_thumb', 'Product Thumbnail *') }}
                                <div class="custom-file">
                                  {{ Form::file('product_thumb', ['class' => 'custom-file-input','id'=>'product_thumb']) }}
                                  <label class="custom-file-label" for="product_thumb">Choose file</label>
                                </div>
                              </div>
                            </div>
                            <div class="row mt-1">
                              @if(isset($products->product_thumb))
                                <div class="col-xl-3 col-md-3 img-top-card">
                                    <div class="card widget-img-top">
                                      <div class="card-content">
                                        <img class="card-img-top img-fluid mb-1" src="{{ asset('backend-assets/uploads/product_thumbs/') }}/{{ $products->product_thumb }}" alt="Product Image">
                                      </div>

                                    </div>
                                  </div>
                              @endif
                            </div>
                            <div class="col-md-12 col-12">
                              <div class="form-group">
                                {{ Form::label('product_images', 'Product Images *') }}
                                <div class="custom-file">
                                  {{ Form::file('product_images[]', ['class' => 'custom-file-input','id'=>'product_images','multiple'=>'multiple']) }}
                                  <label class="custom-file-label" for="product_images">Choose file</label>
                                </div>
                              </div>
                            </div>
                          <div class="col-md-6 col-12">
                            <fieldset class="form-group">
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  {{ Form::label('related_product_list_id[]', 'Related Products ',['class'=>'']) }}
                                </div>
                                {{ Form::select('related_product_list_id[]', $related_product,$related_product_list,['class'=>'select2 form-control ', 'multiple'=>'multiple']) }}
                              </div>
                            </fieldset>
                          </div>
                          <div class="col-md-6 col-12">
                            <fieldset class="form-group">
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  {{ Form::label('frequently_bought_together_list_id[]', 'Frequently Bought Together',['class'=>'']) }}
                                </div>
                                {{ Form::select('frequently_bought_together_list_id[]', $frequently_bought,$frequently_bought_together__list,['class'=>'select2 form-control ', 'multiple'=>'multiple']) }}
                              </div>
                            </fieldset>
                          </div>
                          <div class="col-12 d-flex justify-content-start">
                            {{ Form::submit('Update', array('class' => 'btn btn-primary mr-1 mb-1')) }}
                          </div>
                        </div>
                      </div>
                    {{ Form::close() }}
                    <h4>Product Images</h4>
                    <div class="row mt-1">
                      @if(isset($product_images) && count($product_images)>0)
                        @foreach($product_images as $product_image_id => $image_name)
                          <div class="col-xl-3 col-md-3 img-top-card">
                            <div class="card widget-img-top">
                              <div class="card-content">
                                <img class="card-img-top img-fluid mb-1" src="{{ asset('backend-assets/uploads/product_images/') }}/{{ $image_name }}" alt="Product Image">
                              </div>
                              <div class="card-footer text-center">
                                <!-- {{$product_image_id}} -->
                                {!! Form::open([
                                    'method'=>'GET',
                                    'url' => ['admin/products/deleteimage', $product_image_id],
                                    'style' => 'display:inline'
                                ]) !!}
                                    {!! Form::button('<i class="bx bx-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger','onclick'=>"return confirm('Are you sure you want to Delete this Entry ?')"]) !!}
                                {!! Form::close() !!}
                                <!-- <button type="button" class="btn btn-primary glow px-4">Delete</button> -->
                              </div>
                            </div>
                          </div>
                        @endforeach
                      @endif
                    </div>
                  </div>

                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>

    <script>
      $(document).ready(function()
      {
        // if ($(".category").val() != '')
        // {
        //   subcategories($(".category").val());
        // }
        $(".category").change(function(){
          var category_id = $(this).val();
          subcategories(category_id);
        });
        $(".subcategory").change(function(){
          var subcategory_id = $(this).val();
          var category_id = $(".category").val();
          console.log(subcategory_id);
          subsubcategories(category_id,subcategory_id);
        });
        function subcategories(category_id)
        {
          $.ajax({
              url: '{{url("admin/products/getsubcategory")}}',
              type: 'post',
              data:
              {
                category_id: category_id ,_token: "{{ csrf_token() }}",
              },
              success: function (data)
              {
                //console.log(data);
                $('.subcategory').html(data);
                $('.subsubcategory').html('');
              }
           });
        }
        function subsubcategories(category_id,subcategory_id)
        {
          $.ajax({
              url: '{{url("admin/products/getsubsubcategory")}}',
              type: 'post',
              data:
              {
                category_id: category_id, subcategory_id: subcategory_id, _token: "{{ csrf_token() }}",
              },
              success: function (data)
              {
                //console.log(data);
                $('.subsubcategory').html(data);
              }
           });
        }

        var load_size_id = $("#config_size_id").val();
        var load_color_id = $("#config_color_id").val();

        var load_product_sku = $("#product_sku").val();
        var load_product_type = $("#product_type").val();
        var load_product_price = $("#product_price").val();
        if(load_product_type !='' && load_product_sku !='' && load_product_price !='')
        {
          // alert('tet');
          productconfiguration(load_product_type,load_product_sku);
        }

        $("#product_type").change(function()
        {
          var product_type = $(this).val();
          var product_sku = $("#product_sku").val();
          var product_price = $("#product_price").val();
          // console.log(product_type);
          if(product_type !='' && product_sku !='' && product_price !='')
          {
            productconfiguration(product_type,product_sku);
          }
        });
        $("#product_sku").change(function()
        {
          var product_sku = $(this).val();
          var product_type = $("#product_type").val();
          var product_price = $("#product_price").val();
          // console.log(product_type);
          if(product_type !='' && product_sku !='' && product_price !='')
          {
            productconfiguration(product_type,product_sku);
          }
        });

        $("#product_price").change(function()
        {
          var product_sku = $("#product_sku").val();
          var product_type = $("#product_type").val();
          var product_price = $(this).val();
          // console.log(product_type);
          if(product_type !='' && product_sku !='' && product_price !='')
          {
            productconfiguration(product_type,product_sku);
          }
        });
        function productconfiguration(product_type,product_sku)
        {
          // alert('in');
          if (product_type == 'configurable')
          {
            $('#config_color_div').show();
            $('#config_size_div').show();
            $('#variantsdiv').show();
            $('#config_product_qty').hide();
            $('#sim_color_div_edit').hide();
            $('#sim_size_div_edit').hide();
          }
          else
          {
            $('#config_color_div').hide();
            $('#config_size_div').hide();
            $('#variantsdiv').hide();
            $('#variantstable').html('');
            $('#sim_color_div_edit').show();
            $('#sim_size_div_edit').show();
            $('#config_product_qty').show();
          }
        }

        $("#config_color_id").change(function()
        {
          var color_id = $(this).val();
          var size_id = $("#config_size_id").val();
          var product_type = $("#product_type").val();
          var product_sku = $("#product_sku").val();
          var product_price = $("#product_price").val();
          // console.log(color_id);
          if(color_id !='' && size_id !='' && product_type !='' && product_sku !='' && product_price !='')
          {
            getproductvariants(color_id,size_id,product_type,product_sku,product_price);
          }
        });
        $("#config_size_id").change(function()
        {
          var size_id = $(this).val();
          var color_id = $("#config_color_id").val();
          var product_type = $("#product_type").val();
          var product_sku = $("#product_sku").val();
          var product_price = $("#product_price").val();
          // console.log(color_id);
          if(color_id !='' && size_id !='' && product_type !='' && product_sku !='' && product_price !='')
          {
            getproductvariants(color_id,size_id,product_type,product_sku,product_price);
          }
        });
        function getproductvariants(color_id,size_id,product_type,product_sku,product_price)
        {
          if (product_type == 'configurable')
          {
            $.ajax({
                url: '{{url("admin/products/getproductvariants")}}',
                type: 'post',
                data:
                {
                  color_id: color_id, size_id: size_id,product_type: product_type,
                  product_sku: product_sku,product_price: product_price, _token: "{{ csrf_token() }}",
                },
                success: function (data)
                {
                  //console.log(data);
                  $('#variantsdiv').show();
                  $('#variantstable').html(data);
                  $('#sim_color_div').hide();
                  $('#sim_size_div').hide();
                  $('#config_product_qty').hide();
                }
             });
          }
          else
          {
            $('#variantsdiv').hide();
            $('#variantstable').html('');
            $('#config_color_div').hide();
            $('#config_size_div').hide();
            $('#sim_color_div').show();
            $('#sim_size_div').show();
            $('#config_product_qty').show();

          }
        }
        // $('#onshowbtn').on('click',function(){
        //   // console.log('done');
        //   // $('#onshow').removeData();
        //   // $("#onshow").val(null).trigger("change");
        // });
        var variants_cnt = 0 ;
        $('#modal_add_variants').on('click',function(){
          // $('#onshow').removeData();
          var color_id = $("#variant_color_id").val();
          var size_id = $("#variant_size_id").val();
          var product_type = $("#product_type").val();
          var product_sku = $("#product_sku").val();
          var product_id = $("#product_id").val();
          var product_price = $("#product_price").val();
          var added_variants = $('input[name^="variants"]').serialize();
          // var added_variants1 = $('input[name^="variants"]').toArray();
          // $("input[name^='variants']").each(function() {
          //   console.log('test'+$(this).product_sku+'-'+$(this).val());
          // });
          console.log(added_variants);
          // for (key in added_variants1) {
          //   // console.log(key);
          // }
          if (color_id !='' && size_id !='')
          {
            $.ajax({
                url: '{{url("admin/products/addproductvariants")}}',
                type: 'post',
                data:
                {
                  id: product_id, color_id: color_id, size_id: size_id,
                  variants_cnt: variants_cnt, product_sku: product_sku,
                  added_variants: added_variants,product_price: product_price, _token: "{{ csrf_token() }}",
                },
                dataType: 'json',
                success: function (data)
                {
                  console.log(data['flag']);
                  // $('#variantsdiv').show();
                  // $('#variantstable').html(data);
                  // $('#sim_color_div').hide();
                  // $('#sim_size_div').hide();
                  if (data.flag == "new")
                  {

                    console.log(data);
                    $('#variantstable').append(data['table']);
                    variants_cnt++;
                  }
                  else
                  {
                    console.log(data);
                    // $('#variant_toast').toast("show");
                    // toastr.warning("Variant with same attribute options already exists.");
                    $('#variant_toast').modal('show');

                  }
                }
             });
          }
          else
          {
            alert('Please Select Variants');
          }
          $('#onshow').modal('hide');
        });

        $("#manufacturer_id").change(function(){
          var manufacturer_id = $(this).val();
          brands(manufacturer_id);
        });

        function brands(manufacturer_id)
        {
          $.ajax({
              url: '{{url("admin/products/getbrands")}}',
              type: 'post',
              data:
              {
                manufacturer_id: manufacturer_id ,_token: "{{ csrf_token() }}",
              },
              success: function (data)
              {
                //console.log(data);
                $('#brand_id').html(data);
              }
           });
        }

        //product discount price calculation
        $("#product_price,#product_discount,#product_discount_type").change(function()
        {
          var product_price = $("#product_price").val();
          var product_discount = $("#product_discount").val();
          var product_discount_type = $("#product_discount_type").val();
          // console.log(product_discount);
          var product_discounted_price = 0;
          if(product_price !='' && product_discount !='')
          {
            if (product_discount_type=='percent')
            {
              product_discounted_price = product_price - ((product_price*product_discount)/100);
            }
            else
            {
              product_discounted_price = product_price - product_discount;
            }

            if (product_discounted_price <= 0)
            {
              alert('Product Discount cannot be greater than or equals to Product Price');
              // alert('Product Discount Price cannot be less than or equals to Zero');
              $("#product_discounted_price").val('');
            }
            else
            {
              product_discounted_price = Math.round(product_discounted_price);
              $("#product_discounted_price").val(product_discounted_price);
            }
          }
          else if(product_price !='' && product_discount =='')
          {
            $("#product_discounted_price").val(product_price);
          }
          else
          {

          }
        });

      });
    </script>
@endsection
