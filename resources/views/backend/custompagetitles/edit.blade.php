@extends('backend.layouts.app')
@section('title', 'Update Custom Page Title')

@section('content')
@php
$custom_page_title_types = ['default'=>'Default','price'=>'Price','color'=>'Color','size'=>'Size'];
$pages = ['home'=>'Home','list1'=>'Category','list2'=>'Sub Category','list3'=>'Child Category','product'=>'Product','cms'=>'CMS'];
@endphp
<div class="app-content content">
  <div class="content-overlay"></div>
    <div class="content-wrapper">
      <div class="content-header row">
          <div class="content-header-left col-12 mb-2 mt-1">
            <div class="row breadcrumbs-top">
              <div class="col-12">
                <h5 class="content-header-title float-left pr-1 mb-0">Update Custom Page Title</h5>
                <div class="breadcrumb-wrapper col-12">
                  <ol class="breadcrumb p-0 mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
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
                  <a href="{{ route('admin.custompagetitles') }}" class="btn btn-outline-secondary float-right"><i class="bx bx-arrow-back"></i><span class="align-middle ml-25">Back</span></a>
                  <h4 class="card-title">Update Custom Page Title</h4>
                </div>
                <div class="card-content">
                  <div class="card-body">
                    @include('backend.includes.errors')
                    {!! Form::model($custom_page_title, [
                        'method' => 'POST',
                        'url' => ['admin/custompagetitles/update'],
                        'class' => 'form'
                    ]) !!}
                      <div class="form-body">
                        <div class="row">
                          {{ Form::hidden('custom_page_title_id', $custom_page_title->custom_page_title_id) }}
                          <div class="col-md-12 col-12">
                            <div class="form-group">
                              {{ Form::label('custom_page_title_name', 'Custom Page Title Name *') }}
                              {{ Form::text('custom_page_title_name', null, ['class' => 'form-control', 'placeholder' => 'Enter Custom Page Title Name', 'required' => true]) }}
                            </div>
                          </div>
                          <!-- <div class="col-md-6 col-12">
                            <fieldset class="form-group">
                              <div class="input-group">
                                <div class="input-group-prepend">
                                  {{ Form::label('custom_page_title_code', 'Select Page ',['class'=>'']) }}
                                </div>
                                {{ Form::select('custom_page_title_code', $pages, null,['class'=>'select2 form-control', 'placeholder' => 'Please Select Page']) }}
                              </div>
                            </fieldset>
                          </div> -->
                          <div class="col-md-12 col-12">
                            <div class="form-group">
                                @if($custom_page_title->custom_page_title_code == 'list1')
                                    <ul>
                                        <li>Use <code>{#category}</code> to add Category name in title</li> 
                                        <li>Use <code>{#categorydescription}</code> to add Category Description in title</li> 
                                    </ul>
                                    <p>Example: <code>{#categorydescription}</code> - Shop <code>{#category}</code> Clothing Online in India  </p>
                                @elseif($custom_page_title->custom_page_title_code == 'list2')
                                    <ul>
                                        <li>Use <code>{#category}</code> to add Category name in title</li> 
                                        <li>Use <code>{#subcategory}</code> to add Sub Category name in title</li>
                                        <li>Use <code>{#subcategorydescription}</code> to add Sub Category Description in title</li> 
                                    </ul>
                                    <p>Example: <code>{#subcategorydescription}</code>  - Buy <code>{#subcategory}</code> for <code>{#category}</code> at the best price.</p>
                                @elseif($custom_page_title->custom_page_title_code == 'list3')
                                    <ul>
                                        <li>Use <code>{#category}</code> to add Category name in title</li> 
                                        <li>Use <code>{#subcategory}</code> to add Sub Category name in title</li>
                                        <li>Use <code>{#childcategory}</code> to add Child Category name in title</li>
                                        <li>Use <code>{#childcategorydescription}</code> to add Child Category Description in title</li> 
                                    </ul>
                                    <p>Example: <code>{#childcategory}</code>  - Buy <code>{#subcategory}</code> for <code>{#category}</code> Online at Dadreeios.</p>
                                @elseif($custom_page_title->custom_page_title_code == 'product')
                                    <ul>
                                        <li>Use <code>{#category}</code> to add Category name in title</li> 
                                        <li>Use <code>{#subcategory}</code> to add Sub Category name in title</li>
                                        <li>Use <code>{#childcategory}</code> to add Child Category name in title</li>
                                        <li>Use <code>{#childcategorydescription}</code> to add Child Category Description in title</li> 
                                    </ul>
                                    <p>Example: <code>{#childcategory}</code> for <code>{#category}</code> - Shop <code>{#category}</code> <code>{#childcategory}</code> Online in India | Dadreeios</p>
                                @elseif($custom_page_title->custom_page_title_code == 'cms')
                                    <ul>
                                        <li>Use <code>{#pagename}</code> to add Page name in title</li> 
                                    </ul>
                                    <p>Example: <code>{#pagename}</code> - Dadreeios Online Shopping Site</p>
                                @endif
                            </div>
                          </div>
                          {{ Form::hidden('custom_page_title_code', $custom_page_title->custom_page_title_code) }}
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
@endsection
