@extends('backend.layouts.app')
@section('title', 'Create Filter')

@section('content')
@php

@endphp
<div class="app-content content">
  <div class="content-overlay"></div>
    <div class="content-wrapper">
      <div class="content-header row">
          <div class="content-header-left col-12 mb-2 mt-1">
            <div class="row breadcrumbs-top">
              <div class="col-12">
                <h5 class="content-header-title float-left pr-1 mb-0">Create Filter</h5>
                <div class="breadcrumb-wrapper col-12">
                  <ol class="breadcrumb p-0 mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard')}}"><i class="bx bx-home-alt"></i></a>
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
                  <a href="{{ route('admin.filters') }}" class="btn btn-outline-secondary float-right"><i class="bx bx-arrow-back"></i><span class="align-middle ml-25">Back</span></a>
                  <h4 class="card-title">Create Filter</h4>
                </div>
                <div class="card-content">
                  <div class="card-body">
                    @include('backend.includes.errors')
                    <form method="POST" action="{{ route('admin.filters.store') }}" class="form">
                      {{ csrf_field() }}
                      <div class="form-body">
                        <div class="row">
                          <div class="col-md-12 col-12">
                            <div class="form-label-group">
                              {{ Form::text('filter_name', null, ['class' => 'form-control', 'placeholder' => 'Enter Filter Name', 'required' => true]) }}
                              {{ Form::label('filter_name', 'Filter Name *') }}
                            </div>
                          </div>
                          <div class="col-md-12 col-12">
                            <div class="form repeater-default">
                              <div data-repeater-list="group-a">
                                <div data-repeater-item>
                                  <div class="row justify-content-between">
                                    <div class="col-md-2 col-sm-12 form-group">
                                      <label for="filter_value">Values </label>
                                      <input type="text" class="form-control" id="filter_value" placeholder="Enter Value">
                                    </div>

                                    <div class="col-md-2 col-sm-12 form-group d-flex align-items-center pt-2">
                                      <button class="btn btn-danger text-nowrap px-1" data-repeater-delete type="button"> <i
                                          class="bx bx-x"></i>
                                        Delete
                                      </button>
                                    </div>
                                  </div>
                                  <hr>
                                </div>
                              </div>
                              <div class="form-group">
                                <div class="col p-0">
                                  <button class="btn btn-primary" data-repeater-create type="button"><i class="bx bx-plus"></i>
                                    Add
                                  </button>
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="col-12 d-flex justify-content-start">
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
@endsection
