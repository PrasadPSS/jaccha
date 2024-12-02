@extends('backend.layouts.app')
@section('title', 'Update Special Deals')

@section('content')

    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-12 mb-2 mt-1">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h5 class="content-header-title float-left pr-1 mb-0">Update Special Deals</h5>
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
                                <a href="{{ route('admin.specialdeals') }}" class="btn btn-outline-secondary float-right"><i
                                            class="bx bx-arrow-back"></i><span
                                            class="align-middle ml-25">Back</span></a>
                                <h4 class="card-title">Update Special Deals</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    @include('backend.includes.errors')
                                    {!! Form::model($specialdeal, [
                                        'method' => 'POST',
                                        'url' => ['admin/specialdeals/update'],
                                        'class' => 'form',
                                        'enctype' => 'multipart/form-data'
                                    ]) !!}
                                    <div class="form-body">
                                        <div class="row">
                                            
                                            <div class="col-md-6 col-12">
                                                <fieldset class="form-group">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                    {{ Form::hidden('deals_id', $specialdeal->id) }}
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
                                                            {{ Form::label('product_id', 'Product Title ',['class'=>'']) }}
                                                        </div>
                                                        {{ Form::select('product_id[]', $productsAll, $product_selected,['class'=>'select2 form-control product','id'=>'product','multiple'=>'multiple']) }}
                                                    </div>
                                                </fieldset>
                                            </div>
                                            

                                           

                                            <div class="col-md-6 col-12" id="start_date_div">
                                                {{ Form::label('start_date', 'Start Date ') }}
                                                <fieldset class="form-group position-relative has-icon-left">
                                                  {{ Form::text('start_date', null, ['class' => 'form-control pickadate', 'placeholder' => 'Select Date', 'required' => true]) }}
                                                  <div class="form-control-position">
                                                    <i class='bx bx-calendar'></i>
                                                  </div>
                                                </fieldset>
                                              </div>

                                              <div class="col-md-6 col-12" id="end_date_div">
                                                {{ Form::label('end_date', 'End Date ') }}
                                                <fieldset class="form-group position-relative has-icon-left">
                                                  {{ Form::text('end_date', null, ['class' => 'form-control pickadate', 'placeholder' => 'Select Date', 'required' => true]) }}
                                                  <div class="form-control-position">
                                                    <i class='bx bx-calendar'></i>
                                                  </div>
                                                </fieldset>
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
