@extends('backend.layouts.app')
@section('title', 'Create Product')

@section('content')
@php
    $product_types = ['simple' => 'Simple', 'configurable' => 'Configurable'];
    $gsts = [];
    foreach ($gst as $gs) {
        $gsts[$gs->gst_id] = $gs->gst_name; // Use the same key-value structure as $product_types
    }
    //dd($product_types1);
@endphp
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-12 mb-2 mt-1">
                <div class="row breadcrumbs-top">
                    <div class="col-12">
                        <h5 class="content-header-title float-left pr-1 mb-0">Create Product</h5>
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb p-0 mb-0">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i
                                            class="bx bx-home-alt"></i></a>
                                </li>
                                <li class="breadcrumb-item active">Create
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
                            <h4 class="card-title">Create Product</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                @include('backend.includes.errors')
                                {{ Form::open(['url' => 'admin/products/store', 'enctype' => 'multipart/form-data']) }}
                                <div class="form-body">
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
                                                    {{ Form::select('product_type', $product_types, null, ['class' => 'select2 form-control ', 'placeholder' => 'Please Select Type', 'id' => 'product_type']) }}
                                                </div>
                                            </fieldset>
                                        </div>
                                        <div class="col-md-12 col-12">
                                            <div class="form-group">

                                                {{ Form::label('product_title', 'Product Title ') }}
                                                {{ Form::text('product_title', null, ['id' => 'product_title', 'class' => 'form-control', 'placeholder' => 'Enter Product Title', 'required' => true]) }}
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-12 mb-1">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    {{ Form::label('gst_id', 'Gst ', ['class' => '']) }}
                                                </div>
                                                {{ Form::select('gst_id', $gsts, null, ['class' => 'select2 form-control ', 'placeholder' => 'Please Select Type', 'id' => 'gst_id']) }}
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
                                                </div>
                                            </fieldset>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <fieldset class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        {{ Form::label('sub_category_id', 'Sub Category ', ['class' => '']) }}
                                                    </div>
                                                    {{ Form::select('sub_category_id', $sub_categories, old('sub_category_id'), ['class' => 'select2 form-control subcategory', 'placeholder' =>  'Please Select Sub Category']) }}
                                                </div>
                                            </fieldset>
                                        </div>
                                        <!-- <div class="col-md-6 col-12">
                                            <fieldset class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        {{ Form::label('sub_sub_category_id', 'Child Category ', ['class' => '']) }}
                                                    </div>
                                                    {{ Form::select('sub_sub_category_id', $sub_sub_categories, null, ['class' => 'select2 form-control subsubcategory', 'placeholder' => 'Please Select Child Category']) }}
                                                </div>
                                            </fieldset>
                                        </div> -->

                                        <div class="col-md-6 col-12">
                                            <fieldset class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        {{ Form::label('hsncode_id', 'HSN Code ', ['class' => '']) }}
                                                    </div>
                                                    {{ Form::select('hsncode_id', [], null, ['class' => 'select2 form-control hsncode_id', 'placeholder' => 'Please Select HSN Code']) }}
                                                </div>
                                            </fieldset>
                                        </div>
                                        <div class="col-md-6 col-12" id="product_price_div">
                                            <div class="form-group">
                                                {{ Form::label('product_price', 'Product Price ') }}
                                                {{ Form::text('product_price', null, ['class' => 'form-control', 'placeholder' => 'Enter Product Price', 'id' => 'product_price']) }}
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12" id="product_discount_div">
                                            <fieldset class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        {{ Form::label('product_discount_type', 'Discount Type ', ['class' => '']) }}
                                                    </div>
                                                    {{ Form::select('product_discount_type', ['percent' => 'Percent', 'flat' => 'Flat'], null, ['class' => 'select2 form-control ', 'id' => 'product_discount_type']) }}
                                                </div>
                                            </fieldset>
                                        </div>
                                        <div class="col-md-6 col-12" id="product_discount_amount_div">
                                            <div class="form-group">
                                                {{ Form::label('product_discount', 'Product Discount ') }}
                                                {{ Form::text('product_discount', null, ['class' => 'form-control', 'placeholder' => 'Enter Product Discount', 'id' => 'product_discount']) }}
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12" id="product_discounted_div">
                                            <div class="form-group">
                                                {{ Form::label('product_discounted_price', 'Product Discounted Price ') }}
                                                {{ Form::text('product_discounted_price', null, ['class' => 'form-control', 'placeholder' => 'Enter Product Discounted Price', 'id' => 'product_discounted_price']) }}
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12" id="config_product_qty">
                                            <div class="form-group">
                                                {{ Form::label('product_qty', 'Product Quantity ') }}
                                                {{ Form::text('product_qty', null, ['class' => 'form-control', 'placeholder' => 'Enter Product Quantity']) }}
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12" id="config_size_div" style="display:none;">
                                            {{ Form::label('size_id', 'Variant Weights ', ['class' => '']) }}
                                            <fieldset class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                    </div>
                                                    {{ Form::select('size_id[]', $size_list, null, ['class' => 'select2 form-control ', 'multiple' => 'multiple', 'id' => 'config_size_id']) }}
                                                </div>
                                            </fieldset>
                                        </div>





                                        <div class="col-md-6 col-12" id="product_weight_div">
                                            <div class="form-group">
                                                {{ Form::label('product_weight', 'Product Weight(gms) *') }}
                                                {{ Form::number('product_weight', null, ['class' => 'form-control', 'placeholder' => 'Enter Product Weight']) }}
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                {{ Form::label('length', 'Product Length(cm) *') }}
                                                {{ Form::number('length', null, ['class' => 'form-control', 'placeholder' => 'Enter Product Length', 'step' => '0.01']) }}
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                {{ Form::label('width', 'Product Breadth(cm) *') }}
                                                {{ Form::number('width', null, ['class' => 'form-control', 'placeholder' => 'Enter Product Breadth', 'step' => '0.01']) }}
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                {{ Form::label('height', 'Product Height(cm) *') }}
                                                {{ Form::number('height', null, ['class' => 'form-control', 'placeholder' => 'Enter Product Height', 'step' => '0.01']) }}
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 mt-1 repeater-default" style="display:none;"
                                            id="variantsdiv">

                                            <h3>Product Variants</h3>
                                            <table class="table table-responsive table-bordered">
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
                                                <tbody id="variantstable" data-repeater-list="variants">

                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="modal fade text-left" id="onshow" tabindex="-1" role="dialog"
                                            aria-labelledby="myModalLabel21" aria-hidden="true">
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

                                                        <div class="col-md-12 col-12">
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
                                        <div class="col-md-12 col-12">
                                            <div class="form-group">
                                                {{ Form::label('product_desc', 'Product Description ') }}
                                                {{ Form::textarea('product_desc', null, ['class' => 'form-control', 'placeholder' => 'Enter Product Description', 'id' => 'editor2']) }}
                                            </div>
                                        </div>



                                        <div class="col-lg-12 col-md-12 mt-1">
                                            <fieldset class="form-group">
                                                {{ Form::label('product_specification', 'Specifications ') }}
                                                {{ Form::textarea('product_specification', null, ['class' => 'form-control', 'placeholder' => 'Enter Address', 'id' => 'editor']) }}
                                            </fieldset>
                                        </div>
                                        <div class="col-lg-12 col-md-12 mt-1">
                                            <fieldset class="form-group">
                                                {{ Form::label('ingredients', 'Ingredients ') }}
                                                {{ Form::textarea('ingredients', null, ['class' => 'form-control', 'placeholder' => 'Enter Address', 'id' => 'editor8']) }}
                                            </fieldset>
                                        </div>
                                        <div class="col-lg-12 col-md-12 mt-1">
                                            <fieldset class="form-group">
                                                {{ Form::label('product_disclaimer', 'Disclaimer ') }}
                                                {{ Form::textarea('product_disclaimer', isset($disclaimer) ? $disclaimer->disclaimer_description : '', ['class' => 'form-control', 'placeholder' => 'Enter Address', 'id' => 'editor1']) }}
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
                                                        {{ Form::label('country_id', 'Country Of Origin ', ['class' => '']) }}
                                                    </div>
                                                    {{ Form::select('country_id', $countries, 101, ['class' => 'select2 form-control ', 'placeholder' => 'Please Select Country Of Origin']) }}
                                                </div>
                                            </fieldset>
                                        </div>


                                        <!-- <div class="col-md-6 col-6">
                                                {{ Form::label('filter_id', 'Filters ', ['class' => '']) }}
                                                <fieldset class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                        </div>
                                                        {{ Form::select('filter_id[]', $filter_list, null, ['class' => 'select2 form-control ', 'multiple' => 'multiple', 'id' => 'filter_list']) }}
                                                    </div>
                                                </fieldset>
                                            </div> -->
                                        <div class="col-md-3 col-12">
                                            <div class="custom-control custom-switch custom-control-inline mb-1">
                                                <span>Exclusive</span>
                                                <input type="checkbox" class="custom-control-input" id="recommended"
                                                    name="recommended" value="1">
                                                <label class="custom-control-label ml-1" for="recommended">
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-12">
                                            <div class="custom-control custom-switch custom-control-inline mb-1">
                                                <span><b>New Arrival</b></span>
                                                <input type="checkbox" class="custom-control-input" id="new_arrival"
                                                    name="new_arrival">
                                                <!-- {{ Form::checkbox('new_arrival', null, ['class' => 'custom-control-input', 'id' => 'new_arrival']) }} -->
                                                <!-- {!! Form::checkbox('new_arrival', '1') !!} -->
                                                <label class="custom-control-label ml-1" for="new_arrival">
                                                </label>
                                                <!-- {{ Form::label('new_arrival', '', ['class' => 'custom-control-label ml-1']) }} -->
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
                                        <div class="col-md-12 col-12">
                                            <div class="form-group">
                                                {{ Form::label('product_images', 'Product Images *') }}
                                                <div class="custom-file">
                                                    {{ Form::file('product_images[]', ['class' => 'custom-file-input', 'id' => 'product_images', 'multiple' => 'multiple']) }}
                                                    <label class="custom-file-label" for="product_images">Choose
                                                        file</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <fieldset class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        {{ Form::label('related_product_list_id', 'You might prefer this ', ['class' => '']) }}
                                                    </div>
                                                    {{ Form::select('related_product_list_id[]', [], null, ['class' => 'select2 form-control ', 'multiple' => 'multiple', 'id' => 'mightprefer_list']) }}
                                                </div>
                                            </fieldset>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <fieldset class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        {{ Form::label('frequently_bought_together_list_id', 'Frequently Bought Together', ['class' => '']) }}
                                                    </div>
                                                    {{ Form::select('frequently_bought_together_list_id[]', [], null, ['class' => 'select2 form-control ', 'multiple' => 'multiple', 'id' => 'frequentlybrought_list']) }}
                                                </div>
                                            </fieldset>
                                        </div>
                                        <div class="col-12 d-flex justify-content-start">
                                            {{ Form::submit('Save', ['class' => 'btn btn-primary mr-1 mb-1']) }}
                                            <button type="reset"
                                                class="btn btn-light-secondary mr-1 mb-1">Reset</button>
                                        </div>
                                    </div>
                                </div>
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
<script>
    $(document).ready(function () {
        if ("{{old('category_id')}}" != "") {
            subcategories(Number("{{old('category_id')}}"));
        }
        var product_type = $("#product_type").val();
        var product_title = $("#product_title").val();
        var product_sku = $("#product_sku").val();
        if (product_type != '' && product_sku != '' && product_title != '') {
            console.log('worked');
            productconfiguration(product_type, product_sku);
          
            var size_id = $("#config_size_id").val();
            var color_id = $("#config_color_id").val();
            var product_type = $("#product_type").val();
            var product_sku = $("#product_sku").val();
            var product_price = $("#product_price").val();
            var product_discounted_price = $("#product_discounted_price").val();
            console.log(size_id);
            getproductvariants(size_id, product_type, product_sku, product_price,
                    product_discounted_price);
        }

        var variants_cnt = 0;
        $('#modal_add_variants').on('click', function () {
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
                    success: function (data) {
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
                    },
                    error: function (data) {
                        console.log(data);
                    }
                });
            } else {
                alert('Please Select Variants');
            }
            $('#onshow').modal('hide');
        });
        // if ($(".category").val() != '')
        // {
        //   subcategories($(".category").val());
        // }
        $(".category").change(function () {
            var category_id = $(this).val();
            subcategories(category_id);
            getfilters(category_id);
            getfrequentlybrought(category_id);
            getmightprefer(category_id);
        });
        $(".subcategory").change(function () {
            var subcategory_id = $(this).val();
            var category_id = $(".category").val();
            hsncodes(category_id, subcategory_id);
            subsubcategories(category_id, subcategory_id);
        });
       
        $(".material_id").change(function () {
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
                success: function (data) {
                    //console.log(data);
                    
                    $('.subcategory').html(data);
                    $('.subcategory').val("{{old('sub_category_id')}}").trigger('change');
                    
                    console.log('hsn_code id', "{{old('hsncode_id')}}");
    
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
                success: function (data) {
                    //console.log(data);
                    $('.subsubcategory').html(data);
                 
                    $('.material_id').trigger('change');
                }
            });
        }

        function hsncodes(category_id, subcategory_id) {
            $.ajax({
                url: '{{ url('admin/products/gethsncodes') }}',
                type: 'post',
                data: {
                    category_id: category_id,
                    subcategory_id: subcategory_id,
                    
                    _token: "{{ csrf_token() }}",
                },
                success: function (data) {
                    //console.log(data);
                    console.log(data);
                    $('.hsncode_id').html(data);
                    $('.hsncode_id').val("{{old('hsncode_id')}}").trigger('change');
                }
            });
        }
        $("#product_type").change(function () {
            var product_type = $(this).val();
            var product_sku = $("#product_sku").val();
            var product_price = $("#product_price").val();
            var product_title = $("#product_title").val();
            // console.log(product_type);
            if (product_type != '' && product_sku != '' && product_title != '') {
                productconfiguration(product_type, product_sku);
            }

            if (product_type == '' || product_sku == '' || product_title == '') {
                $('#config_size_div').hide();
            }
        });
        $("#product_sku").change(function () {
            var product_sku = $(this).val();
            var product_type = $("#product_type").val();
            var product_price = $("#product_price").val();
            var product_title = $("#product_title").val();
            // console.log(product_type);
            if (product_type != '' && product_sku != '' && product_title != '') {
                productconfiguration(product_type, product_sku);
            }
            if (product_type == '' || product_sku == '' || product_title == '') {
                $('#config_size_div').hide();
            }
        });

        $("#product_title").change(function () {
            var product_sku = $("#product_sku").val();
            var product_type = $("#product_type").val();
            var product_price = $("#product_price").val();
            var product_title = $("#product_title").val();
            // console.log(product_type);
            if (product_type != '' && product_sku != '' && product_title != '') {
                productconfiguration(product_type, product_sku);
            }
            if (product_type == '' || product_sku == '' || product_title == '') {

                $('#config_size_div').hide();
            }

        });

        $("#product_price").change(function () {
            var product_sku = $("#product_sku").val();
            var product_type = $("#product_type").val();
            var product_price = $(this).val();
            // console.log(product_type);
            if (product_type != '' && product_sku != '') {
                productconfiguration(product_type, product_sku);
            }
        });
        if ($("#editor8").length != 0) {
            CKEDITOR.replace('editor8', {
                height: 260,

            });
        }
        function productconfiguration(product_type, product_sku) {
            // alert('in');
            if (product_type == 'configurable') {
                $('#config_color_div').show();
                $('#config_size_div').show();
                $('#variantsdiv').show();
                $('#config_product_qty').hide();
                $('#sim_color_div').hide();
                $('#sim_size_div').hide();
                $('#product_price_div').hide();
                $('#product_discount_div').hide();
                $('#product_discounted_div').hide();
                $('#product_discount_amount_div').hide();
                $('#product_weight_div').hide();

            } else {
                $('#config_color_div').hide();
                $('#config_size_div').hide();
                $('#variantsdiv').hide();
                $('#variantstable').html('');
                $('#sim_color_div').show();
                $('#sim_size_div').show();
                $('#config_product_qty').show();
                $('#product_price_div').show();
                $('#product_discount_div').show();
                $('#product_discounted_div').show();
                $('product_discount_amount_div').show();
                $('#product_weight_div').show();
            }
        }

        $("#config_size_id").change(function () {
            var size_id = $(this).val();
            var color_id = $("#config_color_id").val();
            var product_type = $("#product_type").val();
            var product_sku = $("#product_sku").val();
            var product_price = $("#product_price").val();
            var product_discounted_price = $("#product_discounted_price").val();
            // console.log(color_id);
            let product_title = $("#product_title").val();
            if (product_type != '' && product_sku != '' && product_title != '') {
                getproductvariants(size_id, product_type, product_sku, product_price,
                    product_discounted_price);
            }
        });

        function getproductvariants(size_id, product_type, product_sku, product_price, product_discounted_price) {
            let product_title = $("#product_title").val();

            // Step 1: Store existing values in an object
            let existingData = {};
            $("#variantstable tr").each(function () {
                let row = $(this);
                let sku = row.find('input[name*="[product_sku]"]').val();
                let qty = row.find('input[name*="[product_qty]"]').val();
                let price = row.find('input[name*="[product_discounted_price]"]').val();

                if (sku) {
                    existingData[sku] = { qty: qty, price: price };
                }
            });

            if (product_type == 'configurable') {
                $.ajax({
                    url: '{{ url('admin/products/getproductvariants') }}',
                    type: 'post',
                    data: {
                        color_id: 1,
                        size_id: size_id,
                        product_title: product_title,
                        product_type: product_type,
                        product_discounted_price: 0,
                        product_sku: product_sku,
                        product_price: 0,
                        _token: "{{ csrf_token() }}",
                    },
                    success: function (data) {
                        $('#variantsdiv').show();

                        // Step 2: Replace table content
                        $('#variantstable').html(data);

                        // Step 3: Restore saved values after updating the table
                        $("#variantstable tr").each(function () {
                            let row = $(this);
                            let sku = row.find('input[name*="[product_sku]"]').val();

                            if (existingData[sku]) {
                                row.find('input[name*="[product_qty]"]').val(existingData[sku].qty);
                                row.find('input[name*="[product_discounted_price]"]').val(existingData[sku].price);
                            }
                        });

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

        $("#manufacturer_id").change(function () {
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
                success: function (data) {
                    //console.log(data);
                    $('#brand_id').html(data);
                }
            });
        }

        //product discount price calculation
        $("#product_price,#product_discount,#product_discount_type").change(function () {
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

        function getfilters(category_id) {
            $.ajax({
                url: '{{ url('admin/products/getfilters') }}',
                type: 'post',
                data: {
                    category_id: category_id,
                    _token: "{{ csrf_token() }}",
                },
                success: function (data) {
                    //console.log(data);
                    $('#filter_list').html(data);
                }
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
                success: function (data) {
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
                success: function (data) {
                    //console.log(data);
                    $('#frequentlybrought_list').html(data);
                }
            });
        }
    });
</script>
@endsection