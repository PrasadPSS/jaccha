@extends('backend.layouts.app')
@section('title', 'Edit Product')

@section('content')
    @php
$status = ['No' => 'No', 'Yes' => 'Yes'];
$product_types = ['simple' => 'Simple', 'configurable' => 'Configurable'];
$gsts = [];
foreach ($gst as $gs) {
    $gsts[$gs->gst_id] = $gs->gst_name; // Use the same key-value structure as $product_types
}
    @endphp
    <style>

    </style>
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
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i
                                                class="bx bx-home-alt"></i></a>
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
                                <a href="{{ request()->headers->get('referer') }}"
                                    class="btn btn-outline-secondary mr-1 mb-1 float-right"><i
                                        class="bx bx-arrow-back"></i><span class="align-middle ml-25">Back</span></a>
                                <h4 class="card-title">Edit Product</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    @include('backend.includes.errors')
                                    {!! Form::model($products, [
    'method' => 'POST',
    'url' => ['admin/products/update'],
    'class' => 'form',
    'enctype' => 'multipart/form-data',
]) !!}
                                    <div class="form-body">
                                        <!-- <h2>General</h2> -->
                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    {{ Form::label('product_sku', 'Product SKU ') }}
                                                    {{ Form::text('product_sku', null, ['class' => 'form-control', 'placeholder' => 'Enter Product SKU', 'required' => true, 'id' => 'product_sku']) }}
                                                </div>
                                               
                                            </div>
                                            <div class="col-md-6 col-12">
                    
                                                <fieldset class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            {{ Form::label('product_type', 'Type ', ['class' => '']) }}
                                                        </div>
                                                        {{ Form::select('product_type', $product_types, $products->product_type, ['class' => 'select2 form-control ', 'placeholder' => 'Please Select Type', 'id' => 'product_type', 'disabled' => true]) }}
                                                        {{ Form::hidden('product_type', $products->product_type, ['id' => 'product_type']) }}
                                                    </div>
                                                </fieldset>
                                            </div>
                                            <div class="col-md-12 col-12">
                                                <div class="form-group">
                                                    {{ Form::hidden('product_id', $products->product_id, ['id' => 'product_id']) }}
                                                    {{ Form::label('product_title', 'Product Title ') }}
                                                    {{ Form::text('product_title', null, ['class' => 'form-control', 'placeholder' => 'Enter Product Title', 'required' => true]) }}
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-12 mb-1">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    {{ Form::label('gst_id', 'Gst ', ['class' => '']) }}
                                                </div>
                                                {{ Form::select('gst_id', $gsts, null, ['class' => 'select2 form-control ', 'placeholder' => 'Please Select Type', 'id' => 'gst_id', 'value' => $selectedGst->gst_name ?? null]) }}
                                            </div>
                                            </div>
                                            <div class="col-md-12 col-12">
                                                <div class="form-group">
                                                    {{ Form::label('product_sub_title', 'Product Sub Title ') }}
                                                    {{ Form::text('product_sub_title', null, ['class' => 'form-control', 'placeholder' => 'Enter Product Sub Title',]) }}
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <fieldset class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            {{ Form::label('category_id', 'Category ', ['class' => '']) }}
                                                        </div>
                                                        {{ Form::select('category_id', $categories, null, ['class' => 'select2 form-control category', 'placeholder' => 'Please Select Category']) }}
                                                        <!-- $products->category_id -->
                                                    </div>
                                                </fieldset>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <fieldset class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            {{ Form::label('sub_category_id', 'Sub Category ', ['class' => '']) }}
                                                        </div>
                                                        {{ Form::select('sub_category_id', $sub_categories, null, ['class' => 'select2 form-control subcategory', 'placeholder' => 'Please Select Sub Category']) }}
                                                        <!-- $products->sub_category_id -->
                                                    </div>
                                                </fieldset>
                                            </div>
                                             
                                            <div class="col-md-6 col-12">
                                                <fieldset class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            {{ Form::label('material_id', 'Material ', ['class' => '']) }}
                                                        </div>
                                                        {{ Form::select('material_id', $materials, null, ['class' => 'select2 form-control material_id', 'placeholder' => 'Please Select Material']) }}
                                                    </div>
                                                </fieldset>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <fieldset class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            {{ Form::label('hsncode_id', 'HSN Code ', ['class' => '']) }}
                                                        </div>
                                                        {{ Form::select('hsncode_id', $hsncodes, null, ['class' => 'select2 form-control hsncode_id', 'placeholder' => 'Please Select HSN Code']) }}
                                                    </div>
                                                </fieldset>
                                            </div>
                                            @if ($products->product_type == 'simple')
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        {{ Form::label('product_price', 'Product Price ') }}
                                                        {{ Form::text('product_price', null, ['class' => 'form-control', 'placeholder' => 'Enter Product Price', 'required' => true, 'id' => 'product_price']) }}
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <fieldset class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                {{ Form::label('product_discount_type', 'Discount Type ', ['class' => '']) }}
                                                            </div>
                                                            {{ Form::select('product_discount_type', ['percent' => 'Percent', 'flat' => 'Flat'], null, ['class' => 'select2 form-control ', 'id' => 'product_discount_type']) }}
                                                        </div>
                                                    </fieldset>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        {{ Form::label('product_discount', 'Product Discount ') }}
                                                        {{ Form::text('product_discount', null, ['class' => 'form-control', 'placeholder' => 'Enter Product Discount', 'id' => 'product_discount']) }}
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        {{ Form::label('product_discounted_price', 'Product Discounted Price ') }}
                                                        {{ Form::text('product_discounted_price', null, ['class' => 'form-control', 'placeholder' => 'Enter Product Discounted Price', 'id' => 'product_discounted_price']) }}
                                                    </div>
                                                </div>
                                            @else
                                                {{ Form::hidden('product_price', $products->product_price, ['id' => 'product_price']) }}
                                                {{ Form::hidden('product_discount_type', $products->product_discount_type, ['id' => 'product_discount_type']) }}
                                                {{ Form::hidden('product_discount', $products->product_discount, ['id' => 'product_discount']) }}
                                                {{ Form::hidden('product_discounted_price', $products->product_discounted_price, ['id' => 'product_discounted_price']) }}
                                            @endif
                                            <div class="col-md-6 col-12" id="config_product_qty" style="display:none;">
                                                <div class="form-group">
                                                    {{ Form::label('product_qty', 'Product Quantity ') }}
                                                    {{ Form::text('product_qty', null, ['class' => 'form-control', 'placeholder' => 'Enter Product Quantity']) }}
                                                </div>
                                            </div>
                                           
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    {{ Form::label('product_weight', 'Product Weight(gms) *') }}
                                                    {{ Form::number('product_weight', null, ['class' => 'form-control', 'placeholder' => 'Enter Product Weight']) }}
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    {{ Form::label('length', 'Product Length(cm) *') }}
                                                    {{ Form::number('length', null, ['class' => 'form-control', 'placeholder' => 'Enter Product Length']) }}
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    {{ Form::label('width', 'Product Breadth(cm) *') }}
                                                    {{ Form::number('width', null, ['class' => 'form-control', 'placeholder' => 'Enter Product Breadth']) }}
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    {{ Form::label('height', 'Product Height(cm) *') }}
                                                    {{ Form::number('height', null, ['class' => 'form-control', 'placeholder' => 'Enter Product Height']) }}
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12 mt-1 repeater-default" id="variantsdiv"
                                                style="display:none;">
                                                <div class="form-group">
                                                    <div class="col p-0">
                                                        <button class="btn btn-primary" type="button" data-toggle="modal"
                                                            id="onshowbtn" data-target="#onshow"><i class="bx bx-plus"></i>
                                                            Add Variants
                                                        </button>
                                                    </div>
                                                </div>
                                                <table class="table table-responsive table-bordered ">
                                                    <thead>
                                                        <tr>
                                                            <th>SKU</th>
                                                            <th>Name</th>
                                                            
                                                            <th>Weight</th>
                                                            <th>Quantity</th>
                                                            <th>Price</th>
                                                            <th>Status</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="variantstable" data-repeater-list="added_variants">
                                                        @if (isset($product_variants) && count($product_variants) > 0)
                                                            @foreach ($product_variants as $product_variant)
                                                                <tr data-repeater-item>
                                                                    <td>
                                                                        <input type="hidden"
                                                                            name="added_variants[{{ $product_variant->product_variant_id }}][product_variant_id]"
                                                                            value="{{ $product_variant->product_variant_id }}">
                                                                        <input type="text"
                                                                            name="added_variants[{{ $product_variant->product_variant_id }}][product_sku]"
                                                                            class="form-control"
                                                                            value="{{ $product_variant->product_sku }}"
                                                                            required>
                                                                    </td>
                                                                    <td>
                                                                        <input type="text"
                                                                            name="added_variants[{{ $product_variant->product_variant_id }}][product_title]"
                                                                            class="form-control"
                                                                            value="{{ $product_variant->product_title }}"
                                                                            required>
                                                                    </td>
                                                                    
                                                                    <td>
                                                                        <input type="hidden"
                                                                            name="added_variants[{{ $product_variant->product_variant_id }}][size_id]"
                                                                            value="{{ $product_variant->size_id }}">
                                                                        {{ isset($product_variant->size->size_name) ? $product_variant->size->size_name : '-' }}
                                                                    </td>
                                                                    <td>
                                                                        <input type="text"
                                                                            name="added_variants[{{ $product_variant->product_variant_id }}][product_qty]"
                                                                            class="form-control"
                                                                            value="{{ $product_variant->product_qty }}"
                                                                            required>
                                                                    </td>
                                                                    <td>
                                                                        <input type="text"
                                                                            name="added_variants[{{ $product_variant->product_variant_id }}][product_discounted_price]"
                                                                            class="form-control"
                                                                            value="{{ $product_variant->product_discounted_price }}"
                                                                            required>
                                                                    </td>
                                                                    <td>
                                                                        <select class="select2 form-control"
                                                                            name="added_variants[{{ $product_variant->product_variant_id }}][visibility]"
                                                                            required>
                                                                            <option value="1"
                                                                                {{ $product_variant->visibility == 1 ? 'selected' : '' }}>
                                                                                Enabled</option>
                                                                            <option value="0"
                                                                                {{ $product_variant->visibility == 0 ? 'selected' : '' }}>
                                                                                Disabled</option>
                                                                        </select>
                                                                    </td>
                                                                    <td>
                                                                        <button class="btn btn-danger text-nowrap px-1"
                                                                            data-repeater-delete type="button">
                                                                            <i class="bx bx-x"></i>
                                                                        </button>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="modal fade text-left" id="onshow" tabindex="-1"
                                                role="dialog" aria-labelledby="myModalLabel21" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                                                    role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title" id="myModalLabel21">Add Variants</h4>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <i class="bx bx-x"></i>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            
                                                            <div class="col-md-12 col-12" >
                                                                {{ Form::label('variant_size_id', 'Weights ', ['class' => '']) }}
                                                                <fieldset class="form-group">
                                                                    <div class="input-group">
                                                                        <div class="input-group-prepend">
                                                                        </div>
                                                                        {{ Form::select('variant_size_id', $size_list, '', ['class' => 'select2 form-control ', 'id' => 'variant_size_id', 'placeholder' => 'Select']) }}
                                                                    </div>
                                                                </fieldset>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-light-secondary"
                                                                data-dismiss="modal">
                                                                <i class="bx bx-x d-block d-sm-none"></i>
                                                                <span class="d-none d-sm-block">Cancel</span>
                                                            </button>
                                                            <button type="button" class="btn btn-primary ml-1"
                                                                id="modal_add_variants">
                                                                <i class="bx bx-check d-block d-sm-none"></i>
                                                                <span class="d-none d-sm-block">Add</span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal fade text-left" id="variant_toast" tabindex="-1"
                                                role="dialog" aria-labelledby="myModalLabel120" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                                                    role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header bg-danger">
                                                            <h5 class="modal-title white" id="myModalLabel120">Warning
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <i class="bx bx-x"></i>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Variant with same attribute options already exists.
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-light-secondary"
                                                                data-dismiss="modal">
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
                                                    {{ Form::textarea('product_desc', null, ['class' => 'form-control', 'placeholder' => 'Enter Product Description', 'id' => 'editor2']) }}
                                                </div>
                                            </div>


                                            <div class="col-lg-12 col-md-12 mt-1">
                                                <fieldset class="form-group">
                                                    {{ Form::label('product_specification', 'Specifications *') }}
                                                    {{ Form::textarea('product_specification', null, ['class' => 'form-control', 'placeholder' => 'Enter Address', 'id' => 'editor']) }}
                                                </fieldset>
                                            </div>
                                            <div class="col-lg-12 col-md-12 mt-1">
                                                <fieldset class="form-group">
                                                    {{ Form::label('ingredients', 'Ingredients *') }}
                                                    {{ Form::textarea('ingredients', null, ['class' => 'form-control', 'placeholder' => 'Enter Address', 'id' => 'editor1']) }}
                                                </fieldset>
                                            </div>
                                            <div class="col-lg-12 col-md-12 mt-1">
                                                <fieldset class="form-group">
                                                    {{ Form::label('product_disclaimer', 'Disclaimer *') }}
                                                    {{ Form::textarea('product_disclaimer', null, ['class' => 'form-control', 'placeholder' => 'Enter Address', 'id' => 'editor8']) }}
                                                </fieldset>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    {{ Form::label('meta_title', 'Product Meta Title ') }}
                                                    {{ Form::text('meta_title', null, ['class' => 'form-control', 'placeholder' => 'Enter Product Meta Title']) }}
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    {{ Form::label('meta_desc', 'Product Meta Description ') }}
                                                    {{ Form::text('meta_desc', null, ['class' => 'form-control', 'placeholder' => 'Enter Product Meta Description']) }}
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    {{ Form::label('meta_keywords', 'Product Meta Keywords ') }}
                                                    {{ Form::text('meta_keywords', null, ['class' => 'form-control', 'placeholder' => 'Enter Product Meta Keywords']) }}
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    {{ Form::label('og_title', 'Product OG Title ') }}
                                                    {{ Form::text('og_title', null, ['class' => 'form-control', 'placeholder' => 'Enter Product OG Title']) }}
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    {{ Form::label('og_desc', 'Product OG Description ') }}
                                                    {{ Form::text('og_desc', null, ['class' => 'form-control', 'placeholder' => 'Enter Product OG Description']) }}
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <fieldset class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            {{ Form::label('country_id', 'Country of Origin ', ['class' => '']) }}
                                                        </div>
                                                        {{ Form::select('country_id', $countries, $products->country_id, ['class' => 'select2 form-control ', 'placeholder' => 'Please Select Country of Origin']) }}
                                                    </div>
                                                </fieldset>
                                            </div>
                                            
                                            
                                           
                                            
                                           
                                            
                                            <div class="col-md-6 col-6">
                                                {{ Form::label('visibility', 'Show / Hide') }}
                                                <fieldset class="">
                                                    <div class="radio radio-success">
                                                        {{ Form::radio('visibility', '1', true, ['id' => 'radioshow']) }}
                                                        {{ Form::label('radioshow', 'Yes') }}
                                                    </div>
                                                    <!-- </fieldset>
                                              <fieldset> -->
                                                    <div class="radio radio-danger">
                                                        {{ Form::radio('visibility', '0', false, ['id' => 'radiohide']) }}
                                                        {{ Form::label('radiohide', 'No') }}
                                                    </div>
                                                </fieldset>
                                            </div>
                                           

                                            <div class="col-md-3 col-12">
                                                <div class="custom-control custom-switch custom-control-inline mb-1">
                                                    <span>Exclusive</span>
                                                    <input type="checkbox" class="custom-control-input" id="recommended"
                                                        name="recommended" value="1"
                                                        {{ $products->recommended == 1 ? 'checked' : '' }}>
                                                    <label class="custom-control-label ml-1" for="recommended">
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-12">
                                                <div class="custom-control custom-switch custom-control-inline mb-1">
                                                    <span>New Arrival</span>
                                                    <input type="checkbox" class="custom-control-input" id="new_arrival"
                                                        name="new_arrival" value="1"
                                                        {{ $products->new_arrival == 1 ? 'checked' : '' }}>
                                                    <!-- {{ Form::checkbox('new_arrival', null, ['class' => 'custom-control-input', 'id' => 'new_arrival']) }} -->
                                                    <!-- {!! Form::checkbox('new_arrival', '1') !!} -->
                                                    <label class="custom-control-label ml-1" for="new_arrival">
                                                    </label>
                                                    <!-- {{ Form::label('new_arrival', '', ['class' => 'custom-control-label ml-1']) }} -->
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-12">
                                                <div class="custom-control custom-switch custom-control-inline mb-1">
                                                    <span>Popularity</span>
                                                    <input type="checkbox" class="custom-control-input" id="popularity"
                                                        name="popularity" value="1"
                                                        {{ $products->popularity == 1 ? 'checked' : '' }}>
                                                    <label class="custom-control-label ml-1" for="popularity">
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-12">
                                                <div class="form-group">
                                                    {{ Form::label('product_thumb', 'Product Thumbnail *') }}
                                                    <div class="custom-file">
                                                        {{ Form::file('product_thumb', ['class' => 'custom-file-input', 'id' => 'product_thumb']) }}
                                                        <label class="custom-file-label" for="product_thumb">Choose
                                                            file</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- <div class="row mt-1"> -->
                                            @if (isset($products->product_thumb))
                                                <div class="col-xl-3 col-md-3 img-top-card">
                                                    <div class="card widget-img-top">
                                                        <div class="card-content">
                                                            <img class="card-img-top img-fluid mb-1"
                                                                src="{{ asset('backend-assets/uploads/product_thumbs/') }}/{{ $products->product_thumb }}"
                                                                alt="Product Image">
                                                        </div>

                                                    </div>
                                                </div>
                                            @endif
                                            <!-- </div> -->
                                            <div class="col-md-12 col-12">
                                                <div class="form-group">
                                                    {{ Form::label('product_images', 'Product Images *') }}
                                                    @php
$image_status = false;
$image_status_title = '';
if (isset($product_images) && count($product_images) >= 6) {
    $image_status = true;
    $image_status_title = 'You are only allowed to upload a maximum of 6 files';
}
                                                    @endphp
                                                    <div class="custom-file">
                                                        {{ Form::file('product_images[]', ['class' => 'custom-file-input', 'id' => 'product_images', 'multiple' => 'multiple', 'disabled' => $image_status, 'title' => $image_status_title]) }}
                                                        <label class="custom-file-label" for="product_images">Choose
                                                            file</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <fieldset class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            {{ Form::label('related_product_list_id[]', 'You might prefer this ', ['class' => '']) }}
                                                        </div>
                                                        {{ Form::select('related_product_list_id[]', $related_product, $related_product_list, ['class' => 'select2 form-control ', 'multiple' => 'multiple']) }}
                                                    </div>
                                                </fieldset>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <fieldset class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            {{ Form::label('frequently_bought_together_list_id[]', 'Frequently Bought Together', ['class' => '']) }}
                                                        </div>
                                                        {{ Form::select('frequently_bought_together_list_id[]', $frequently_bought, $frequently_bought_together__list, ['class' => 'select2 form-control ', 'multiple' => 'multiple']) }}
                                                    </div>
                                                </fieldset>
                                            </div>
                                            <div class="col-12 d-flex justify-content-start">
                                                {{ Form::submit('Update', ['class' => 'btn btn-primary mr-1 mb-1']) }}
                                            </div>
                                        </div>
                                    </div>
                                    {{ Form::close() }}
                                    <div class="row mt-1">
                                        <div class="col-md-12">
                                            <h4>Product Images</h4>
                                            @if (isset($product_images) && count($product_images) > 0)
                                                <button class="btn btn-danger float-right mb-2"
                                                    id="delete_selected_images">Delete Selected <i
                                                        class="bx bx-trash"></i></button>
                                            @endif
                                        </div>
                                        @if (isset($product_images) && count($product_images) > 0)
                                            @foreach ($product_images as $product_image_id => $image_name)
                                                <div class="col-xl-3 col-md-3 img-top-card"
                                                    id="remove_image_card_{{ $product_image_id }}">
                                                    <div class="form-group checkbox checkbox-primary">
                                                        <input type="checkbox"
                                                            id="select_product_image_{{ $product_image_id }}"
                                                            class="delete_product_images" name="product_image_id"
                                                            value="{{ $product_image_id }}">
                                                        <label
                                                            for="select_product_image_{{ $product_image_id }}"></label>
                                                    </div>
                                                    <div class="card widget-img-top">
                                                        <div class="card-content">
                                                            <img class="card-img-top img-fluid mb-1"
                                                                src="{{ asset('backend-assets/uploads/product_images/') }}/{{ $image_name }}"
                                                                alt="Product Image">
                                                        </div>
                                                        <div class="card-footer text-center">
                                                            <!-- {{ $product_image_id }} -->
                                                            {!! Form::open([
            'method' => 'GET',
            'url' => ['admin/products/deleteimage', $product_image_id],
            'style' => 'display:inline',
        ]) !!}
                                                            {!! Form::button('<i class="bx bx-trash"></i>', [
            'type' => 'submit',
            'class' => 'btn btn-danger',
            'onclick' => "return confirm('Are you sure you want to Delete this Entry ?')",
        ]) !!}
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
    <div class="modal fade text-left" id="image_delete_toast" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel120" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title white" id="myModalLabel120">Warning</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i class="bx bx-x"></i>
                    </button>
                </div>
                <div class="modal-body" id="delete_image_toast_content">
                    Please Select Product Images To Delete.
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
    <script>
        $(document).ready(function() {
            // if ($(".category").val() != '')
            // {
            //   subcategories($(".category").val());
            // }
            $(".category").change(function() {
                var category_id = $(this).val();
                subcategories(category_id);
                getfilters(category_id);
                getfrequentlybrought(category_id);
                getmightprefer(category_id);
            });
            $(".subcategory").change(function() {
                var subcategory_id = $(this).val();
                var category_id = $(".category").val();
                console.log(subcategory_id);
                subsubcategories(category_id, subcategory_id);
            });
            $(".subsubcategory").change(function() {

                $('.hsncode_id').html('');
                $('.material_id').trigger('change');
            });
            $(".material_id").change(function() {
                var material_id = $(this).val();
                var sub_subcategory_id = $(".subsubcategory").val();
                var subcategory_id = $(".subcategory").val();
                var category_id = $(".category").val();
                // console.log(subcategory_id);
                if (material_id && sub_subcategory_id && subcategory_id && category_id) {
                    hsncodes(category_id, subcategory_id, sub_subcategory_id, material_id);
                }

            });

            function subcategories(category_id) {
                $.ajax({
                    url: '{{ url('admin/products/getsubcategory') }}',
                    type: 'post',
                    data: {
                        category_id: category_id,
                        _token: "{{ csrf_token() }}",
                    },
                    success: function(data) {
                        //console.log(data);
                        $('.subcategory').html(data);
                        $('.subsubcategory').html('');
                        $('.hsncode_id').html('');
                    }
                });
            }

            function getfilters(category_id) {
                $.ajax({
                    url: '{{ url('admin/products/getfilters') }}',
                    type: 'post',
                    data: {
                        category_id: category_id,
                        _token: "{{ csrf_token() }}",
                    },
                    success: function(data) {
                        //console.log(data);
                        $('#filter_list').html(data);
                    }
                });
            }
            if ($("#editor8").length != 0) {
                CKEDITOR.replace('editor8', {
                    height: 260,

                });
            }
            function getmightprefer(category_id) {
                $.ajax({
                    url: '{{ url('admin/products/getmightprefer') }}',
                    type: 'post',
                    data: {
                        category_id: category_id,
                        _token: "{{ csrf_token() }}",
                    },
                    success: function(data) {
                        //console.log(data);
                        $('#mightprefer_list').html(data);
                    }
                });
            }

            function getfrequentlybrought(category_id) {
                $.ajax({
                    url: '{{ url('admin/products/getfrequentlybrought') }}',
                    type: 'post',
                    data: {
                        category_id: category_id,
                        _token: "{{ csrf_token() }}",
                    },
                    success: function(data) {
                        //console.log(data);
                        $('#frequentlybrought_list').html(data);
                    }
                });
            }

            function subsubcategories(category_id, subcategory_id) {
                $.ajax({
                    url: '{{ url('admin/products/getsubsubcategory') }}',
                    type: 'post',
                    data: {
                        category_id: category_id,
                        subcategory_id: subcategory_id,
                        _token: "{{ csrf_token() }}",
                    },
                    success: function(data) {
                        //console.log(data);
                        $('.subsubcategory').html(data);
                        $('.hsncode_id').html('');
                        $('.material_id').trigger('change');

                    }
                });
            }

            function hsncodes(category_id, subcategory_id, sub_subcategory_id, material_id) {
                $.ajax({
                    url: '{{ url('admin/products/gethsncodes') }}',
                    type: 'post',
                    data: {
                        category_id: category_id,
                        subcategory_id: subcategory_id,
                        sub_subcategory_id: sub_subcategory_id,
                        material_id: material_id,
                        _token: "{{ csrf_token() }}",
                    },
                    success: function(data) {
                        //console.log(data);
                        $('.hsncode_id').html(data);
                    }
                });
            }
            var load_size_id = $("#config_size_id").val();
            var load_color_id = $("#config_color_id").val();

            var load_product_sku = $("#product_sku").val();
            var load_product_type = $("#product_type").val();
            var load_product_price = $("#product_price").val();
            if (load_product_type != '' && load_product_sku != '') {
                // alert('tet');
                productconfiguration(load_product_type, load_product_sku);
            }

            $("#product_type").change(function() {
                var product_type = $(this).val();
                var product_sku = $("#product_sku").val();
                var product_price = $("#product_price").val();
                // console.log(product_type);
                if (product_type != '' && product_sku != '' && product_price != '') {
                    productconfiguration(product_type, product_sku);
                }
            });
            $("#product_sku").change(function() {
                var product_sku = $(this).val();
                var product_type = $("#product_type").val();
                var product_discounted_price = $("#product_discounted_price").val();
                // console.log(product_type);
                if (product_type != '' && product_sku != '' && product_discounted_price != '') {
                    productconfiguration(product_type, product_sku);
                }
            });

            $("#product_discounted_price").change(function() {
                var product_sku = $("#product_sku").val();
                var product_type = $("#product_type").val();
                var product_discounted_price = $(this).val();
                // console.log(product_type);
                if (product_type != '' && product_sku != '' && product_discounted_price != '') {
                    productconfiguration(product_type, product_sku);
                }
            });
            
            function productconfiguration(product_type, product_sku) {
                // alert('in');
                if (product_type == 'configurable') {
                    $('#config_color_div').show();
                    $('#config_size_div').show();
                    $('#variantsdiv').show();
                    $('#config_product_qty').hide();
                    $('#sim_color_div_edit').hide();
                    $('#sim_size_div_edit').hide();
                } else {
                    $('#config_color_div').hide();
                    $('#config_size_div').hide();
                    $('#variantsdiv').hide();
                    $('#variantstable').html('');
                    $('#sim_color_div_edit').show();
                    $('#sim_size_div_edit').show();
                    $('#config_product_qty').show();
                }
            }

            $("#config_color_id").change(function() {
                var color_id = 1;
                var size_id = $("#config_size_id").val();
                var product_type = $("#product_type").val();
                var product_sku = $("#product_sku").val();
                var product_discounted_price = $("#product_discounted_price").val();
                // console.log(color_id);
                if (color_id != '' && size_id != '' && product_type != '' && product_sku != '' &&
                    product_discounted_price != '') {
                    getproductvariants(color_id, size_id, product_type, product_sku,
                        product_discounted_price);
                }
            });
            $("#config_size_id").change(function() {
                var size_id = $(this).val();
                var color_id = $("#config_color_id").val();
                var product_type = $("#product_type").val();
                var product_sku = $("#product_sku").val();
                var product_discounted_price = $("#product_discounted_price").val();
                // console.log(color_id);
                if (color_id != '' && size_id != '' && product_type != '' && product_sku != '' &&
                    product_discounted_price != '') {
                    getproductvariants(color_id, size_id, product_type, product_sku,
                        product_discounted_price);
                }
            });

            function getproductvariants(color_id, size_id, product_type, product_sku, product_discounted_price) {
                if (product_type == 'configurable') {
                    $.ajax({
                        url: '{{ url('admin/products/getproductvariants') }}',
                        type: 'post',
                        data: {
                            color_id: color_id,
                            size_id: size_id,
                            product_type: product_type,
                            product_sku: product_sku,
                            product_discounted_price: product_discounted_price,
                            _token: "{{ csrf_token() }}",
                        },
                        success: function(data) {
                            //console.log(data);
                            $('#variantsdiv').show();
                            $('#variantstable').html(data);
                            $('#sim_color_div').hide();
                            $('#sim_size_div').hide();
                            $('#config_product_qty').hide();
                        }
                    });
                } else {
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
            var variants_cnt = 0;
            $('#modal_add_variants').on('click', function() {
                // $('#onshow').removeData();
                var color_id = 1;
                var size_id = $("#variant_size_id").val();
                var product_type = $("#product_type").val();
                var product_sku = $("#product_sku").val();
                var product_id = $("#product_id").val();
                var product_discounted_price = $("#product_discounted_price").val();
                var added_variants = $('input[name^="variants"]').serialize();
                // var added_variants1 = $('input[name^="variants"]').toArray();
                // $("input[name^='variants']").each(function() {
                //   console.log('test'+$(this).product_sku+'-'+$(this).val());
                // });
                console.log(added_variants);
                // for (key in added_variants1) {
                //   // console.log(key);
                // }
                if (color_id != '' && size_id != '') {
                    $.ajax({
                        url: '{{ url('admin/products/addproductvariants') }}',
                        type: 'post',
                        data: {
                            id: product_id,
                            color_id: color_id,
                            size_id: size_id,
                            variants_cnt: variants_cnt,
                            product_sku: product_sku,
                            added_variants: added_variants,
                            product_discounted_price: product_discounted_price,
                            _token: "{{ csrf_token() }}",
                        },
                        dataType: 'json',
                        success: function(data) {
                            console.log(data['flag']);
                            // $('#variantsdiv').show();
                            // $('#variantstable').html(data);
                            // $('#sim_color_div').hide();
                            // $('#sim_size_div').hide();
                            if (data.flag == "new") {

                                console.log(data);
                                $('#variantstable').append(data['table']);
                                variants_cnt++;
                            } else {
                                console.log(data);
                                // $('#variant_toast').toast("show");
                                // toastr.warning("Variant with same attribute options already exists.");
                                $('#variant_toast').modal('show');

                            }
                        }
                    });
                } else {
                    alert('Please Select Variants');
                }
                $('#onshow').modal('hide');
            });

            $("#manufacturer_id").change(function() {
                var manufacturer_id = $(this).val();
                brands(manufacturer_id);
            });

            function brands(manufacturer_id) {
                $.ajax({
                    url: '{{ url('admin/products/getbrands') }}',
                    type: 'post',
                    data: {
                        manufacturer_id: manufacturer_id,
                        _token: "{{ csrf_token() }}",
                    },
                    success: function(data) {
                        //console.log(data);
                        $('#brand_id').html(data);
                    }
                });
            }

            //product discount price calculation
            $("#product_price,#product_discount,#product_discount_type").change(function() {
                var product_price = $("#product_price").val();
                var product_discount = $("#product_discount").val();
                var product_discount_type = $("#product_discount_type").val();
                // console.log(product_discount);
                var product_discounted_price = 0;
                if (product_price != '' && product_discount != '') {
                    if (product_discount_type == 'percent') {
                        product_discounted_price = product_price - ((product_price * product_discount) /
                            100);
                    } else {
                        product_discounted_price = product_price - product_discount;
                    }

                    if (product_discounted_price <= 0) {
                        alert('Product Discount cannot be greater than or equals to Product Price');
                        // alert('Product Discount Price cannot be less than or equals to Zero');
                        $("#product_discounted_price").val('');
                    } else {
                        product_discounted_price = Math.round(product_discounted_price);
                        $("#product_discounted_price").val(product_discounted_price);
                    }
                } else if (product_price != '' && product_discount == '') {
                    $("#product_discounted_price").val(product_price);
                } else {

                }
            });

            $('#delete_selected_images').on('click', function() {
                // $('#onshow').removeData();
                var product_id = $("#product_id").val();
                var product_image_ids = []; //$('input[name^="product_image_id"]').serialize();
                // var product_image_ids = $('input[name^="product_image_id"]:checked').val();
                $('input[name="product_image_id"]:checked').each(function(index) {
                    product_image_ids[index] = this.value;
                });
                console.log(product_image_ids);

                if (product_image_ids != '') {
                    var confirm_result = confirm('Are you sure you want to Delete this Entry ?');
                    if (!confirm_result) {
                        return true;
                    }
                    $.ajax({
                        url: '{{ url('admin/products/delete_product_images') }}',
                        type: 'post',
                        data: {
                            id: product_id,
                            product_image_ids: product_image_ids,
                            _token: "{{ csrf_token() }}",
                        },
                        dataType: 'json',
                        success: function(data) {
                            console.log(data['flag']);
                            if (data.flag == true) {
                                $.each(product_image_ids, function(key, val_ids) {
                                    $("#remove_image_card_" + val_ids).remove();
                                });
                                $('#delete_image_toast_content').text(
                                    'Images Deleted Successfully');
                                $('#image_delete_toast').modal('show');
                            } else {
                                console.log(data);
                                $('#delete_image_toast_content').text('Something went wrong!');
                                $('#image_delete_toast').modal('show');

                            }
                        }
                    });
                } else {
                    // alert('Please Select Product Images To Delete');
                    $('#delete_image_toast_content').text('Please Select Product Images To Delete');
                    $('#image_delete_toast').modal('show');
                }
                $('#image_delete_toast').modal('hide');
            });


        });
    </script>
@endsection
