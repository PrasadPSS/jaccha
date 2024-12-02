@extends('backend.layouts.app')
@section('title', 'Update Footer')

@section('content')

    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-12 mb-2 mt-1">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h5 class="content-header-title float-left pr-1 mb-0">Update Footer</h5>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb p-0 mb-0">
                                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}"><i
                                                    class="bx bx-home-alt"></i></a>
                                    </li>
                                    <li class="breadcrumb-item active">Update
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
                                <a href="{{ route('admin.footer') }}" class="btn btn-outline-secondary float-right"><i
                                            class="bx bx-arrow-back"></i><span
                                            class="align-middle ml-25">Back</span></a>
                                <h4 class="card-title">Update Footer</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    @include('backend.includes.errors')
                                    {!! Form::model($footer, [
                                        'method' => 'POST',
                                        'url' => ['admin/footer/update'],
                                        'class' => 'form',
                                        'enctype' => 'multipart/form-data'
                                    ]) !!}
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-12 col-12">
                                                <div class="form-label-group">
                                                    {{ Form::hidden('footer_id', $footer->id) }}
                                                    {{ Form::label('footer_description', 'Footer Description *') }}
                                                    {{ Form::textarea('footer_description', null, ['class' => 'form-control', 'placeholder' => 'Enter Footer_description', 'id'=>'editor2']) }}
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-12" id="cms_pages_content_div">
                                                <div class="form-group">
                                                    {{ Form::label('footer_category_description', 'Footer Category title*') }}
                                                    {{ Form::text('footer_category_description', null, ['class' => 'form-control', 'placeholder' => 'Enter Footer Description']) }}
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-12">
                                                <div class="form-group">
                                                    {{ Form::label('footer_image1', 'Footer Above Category Image *') }}
                                                    <div class="custom-file">
                                                        {{ Form::file('footer_image1', ['class' => 'custom-file-input','id'=>'footer_image1']) }}
                                                        <label class="custom-file-label" for="footer_image1">Choose
                                                            file</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-1">
                                                <div class="col-xl-3 col-md-3 img-top-card">
                                                    <div class="card widget-img-top">
                                                        <div class="card-content">
                                                            <img class="card-img-top img-fluid mb-1"
                                                                 src="{{ asset('backend-assets/uploads/footer-assets/above_category_image')}}/{{ $footer->footer_image1 }}"
                                                                 alt="footer image1">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <fieldset class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            {{ Form::label('category_id', 'Category ',['class'=>'']) }}
                                                        </div>
                                                        {{ Form::select('category_id[]', $categoriesAll, $category_selected, ['class'=>'select2 form-control','id'=>'category','multiple'=>'multiple']) }}
                                                    </div>
                                                </fieldset>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <fieldset class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            {{ Form::label('sub_subcategory_id', 'Child Category ',['class'=>'']) }}
                                                        </div>
                                                        {{ Form::select('sub_subcategory_id[]', $sub_subcategoriesAll, $subcategory_selected,['class'=>'select2 form-control subsubcategory','id'=>'subsubcategory','multiple'=>'multiple']) }}
                                                    </div>
                                                </fieldset>
                                            </div>

                                            <div class="col-md-6 col-12" id="cat-sub-mapping">
                                            </div>


                                            <div class="col-md-12 col-12">
                                                <div class="form-group">
                                                    {{ Form::label('footer_image2', 'Footer Left Image 1 *') }}
                                                    <div class="custom-file">
                                                        {{ Form::file('footer_image2', ['class' => 'custom-file-input','id'=>'footer_image2']) }}
                                                        <label class="custom-file-label" for="footer_image1">Choose
                                                            file</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-1">
                                                <div class="col-xl-3 col-md-3 img-top-card">
                                                    <div class="card widget-img-top">
                                                        <div class="card-content">
                                                            <img class="card-img-top img-fluid mb-1"
                                                                 src="{{ asset('backend-assets/uploads/footer-assets/left_image1')}}/{{ $footer->footer_image2 }}"
                                                                 alt="footer image2">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-12">
                                                <div class="form-group">
                                                    {{ Form::label('Footer_image3', 'Footer Left Image 2 *') }}
                                                    <div class="custom-file">
                                                        {{ Form::file('footer_image3', ['class' => 'custom-file-input','id'=>'footer_image3']) }}
                                                        <label class="custom-file-label" for="footer_image1">Choose
                                                            file</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-1">
                                                <div class="col-xl-3 col-md-3 img-top-card">
                                                    <div class="card widget-img-top">
                                                        <div class="card-content">
                                                            <img class="card-img-top img-fluid mb-1"
                                                                 src="{{ asset('backend-assets/uploads/footer-assets/left_image2')}}/{{ $footer->footer_image3 }}"
                                                                 alt="footer Image3">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-12">
                                                <div class="form-group">
                                                    {{ Form::label('Footer_image4', 'Footer Right Image *') }}
                                                    <div class="custom-file">
                                                        {{ Form::file('footer_image4', ['class' => 'custom-file-input','id'=>'footer_image']) }}
                                                        <label class="custom-file-label" for="footer_image1">Choose
                                                            file</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-1">
                                                <div class="col-xl-3 col-md-3 img-top-card">
                                                    <div class="card widget-img-top">
                                                        <div class="card-content">
                                                            <img class="card-img-top img-fluid mb-1"
                                                                 src="{{ asset('backend-assets/uploads/footer-assets/right_image')}}/{{ $footer->footer_image4 }}"
                                                                 alt="footer Image4">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="col-12 d-flex justify-content-start mt-2">
                                                <!-- <button type="submit" class="btn btn-primary mr-1 mb-1">Update</button> -->
                                                {{ Form::submit('Update', array('class' => 'btn btn-primary mr-1 mb-1')) }}
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

            $("#category").change(function () {
                var category_id = $(this).val();

                subsubcategories(category_id);
            });
            $("#subsubcategory").change(function () {
                $('#cat-sub-mapping').empty();
                $('#subsubcategory :selected').each(function () {
                    var subsubcategory_id = $(this).val();
                    var subsubcategory_name = $(this).text();
                    $.ajax({
                        url: '{{url("admin/footer/getCategory")}}',
                        type: 'post',
                        data: {
                            subsubcategory_id: subsubcategory_id, _token: "{{ csrf_token() }}",
                        },
                        success: function (data) {
                            $('#cat-sub-mapping').append("<label class=\"col-lg-12 col-12\">" + data['category_name'] + " -> " + subsubcategory_name + " </label>");
                        }
                    });
                });
            });

            function subsubcategories(category_id) {
                $.ajax({
                    url: '{{url("admin/footer/getsubsubcategory")}}',
                    type: 'post',
                    data: {
                        category_id: category_id, _token: "{{ csrf_token() }}",
                    },
                    success: function (data) {
                        //console.log(data);
                        $('.subsubcategory').html(data);
                    },
                });
            }


        });
    </script>


@endsection
