@extends('backend.layouts.app')
@section('title', 'Create Special Deals')

@section('content')

    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-12 mb-2 mt-1">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h5 class="content-header-title float-left pr-1 mb-0">Create Special Deals</h5>
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
            <section id="multiple-column-form">
                <div class="row match-height">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <a href="{{ route('admin.footer') }}" class="btn btn-outline-secondary float-right"><i class="bx bx-arrow-back"></i><span class="align-middle ml-25">Back</span></a>
                                <h4 class="card-title">Create Special Deals</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    @include('backend.includes.errors')
                                    <form method="POST" action="{{ route('admin.specialdeals.store') }}" class="form" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-md-6 col-12">
                                                    <fieldset class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                {{ Form::label('category_id', 'Category ',['class'=>'']) }}
                                                            </div>
                                                            {{ Form::select('category_id[]', $category_list, request()->category_id, ['class'=>'select2 form-control','id'=>'category','multiple'=>'multiple'])}}
                                                        </div>
                                                    </fieldset>
                                                </div>

                                                <div class="col-md-6 col-12">
                                                    <fieldset class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                {{ Form::label('product_id', 'Product Title ',['class'=>'']) }}
                                                            </div>
                                                            {{ Form::select('product_id[]', $product_list, request()->product_id,['class'=>'select2 form-control product','id'=>'product','multiple'=>'multiple']) }}
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

                                                <div class="col-md-6 col-12" id="cat-sub-mapping">
                                                </div>
                                                <div class="col-12 d-flex justify-content-start mt-2">
                                                    <button type="submit" class="btn btn-primary mr-1 mb-1">Submit</button>
                                                    <button type="reset" class="btn btn-light-secondary mr-1 mb-1">Reset</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            if ($("#category").val() != '')
            {
                productlist($("#category").val());
            }
            $("#category").change(function(){
                var category_id = $(this).val();

                productlist(category_id);
            });

            function productlist(category_id)
            {
                $.ajax({
                    url: '{{url("admin/specialdeals/getproduct")}}',
                    type: 'post',
                    data: {
                        category_id: category_id , _token: "{{ csrf_token() }}",
                    },
                    success: function (data) {
                        console.log(data);
                        $('.product').html(data);
                    },
                    error: function (err) {
                        console.log(err);
                    }
                });
            }


        });
    </script>



@endsection
