@extends('backend.layouts.app')
@section('title', 'Update FA Questions')

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
                <h5 class="content-header-title float-left pr-1 mb-0">Update FA Questions</h5>
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
                  <a href="{{ url('admin/faquestions/index/'.$fa_question->faq_id) }}" class="btn btn-outline-secondary float-right"><i class="bx bx-arrow-back"></i><span class="align-middle ml-25">Back</span></a>
                  <h4 class="card-title">Update FA Questions</h4>
                </div>
                <div class="card-content">
                  <div class="card-body">
                    @include('backend.includes.errors')
                    {!! Form::model($fa_question, [
                        'method' => 'POST',
                        'url' => ['admin/faquestions/update'],
                        'class' => 'form'
                    ]) !!}
                      <div class="form-body">
                        <div class="row">
                          <div class="col-md-12 col-12">
                            <div class="form-label-group">
                              {{ Form::hidden('fa_question_id', $fa_question->fa_question_id) }}
                              {{ Form::hidden('faq_id', $fa_question->faq_id) }}
                              {{ Form::text('fa_question', null, ['class' => 'form-control', 'placeholder' => 'Enter FA Questions ', 'required' => true]) }}
                              {{ Form::label('fa_question', 'FA Questions  *') }}
                            </div>
                          </div>
                          <div class="col-lg-12 col-md-12">
                            {{ Form::label('fa_question_ans', 'FAQ Answer *') }}
                            <fieldset class="form-group">
                                {{ Form::textarea('fa_question_ans', null, ['class' => 'form-control char-textarea', 'placeholder' => 'Enter FAQ Answer', 'required' => true, 'rows'=>3, 'id'=>'editor']) }}
                            </fieldset>
                          </div>
                          <div class="col-md-6 col-6">
                            {{ Form::label('visibility', 'Show / Hide') }}
                            <fieldset>
                              <div class="radio radio-success">
                                {{ Form::radio('visibility','1',true,['id'=>'radioshow']) }}
                                {{ Form::label('radioshow', 'Yes') }}
                              </div>
                            </fieldset>
                            <fieldset>
                              <div class="radio radio-danger">
                                {{ Form::radio('visibility','0',false,['id'=>'radiohide']) }}
                                {{ Form::label('radiohide', 'No') }}
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
@endsection
