@extends('backend.layouts.inner')
@section('title')
Edit {{$cmspages->cms_pages_title}} Page
@stop

@section('content')

{!! Form::model($cmspages, [
    'method' => 'PATCH',
    'url' => ['admin/cmspages', $cmspages->cms_pages_id],
    'class' => 'form-horizontal'
]) !!}
<div class="row">


  <div class="form-group col-lg-12 col-md-12">
      {{ Form::label('cms_pages_title', 'Page Title') }}
      {{ Form::text('cms_pages_title', Request('cms_pages_title'), array('class' => 'form-control')) }}
  </div>
  <div class="form-group col-lg-12 col-md-12">
      {{ Form::label('cms_pages_content', 'Page Content') }}
      {{ Form::textarea('cms_pages_content', Request('cms_pages_content'), array('class' => 'form-control','id'=>'editor1')) }}
  </div>
  <div class="form-group col-md-4 col-lg-4 ">
    {{ Form::label('cms_pages_top', 'Display At Top') }}
    {{ Form::select('cms_pages_top', ['1'=>'Yes','0'=>'No'],Request('cms_pages_top'),['class'=>'form-control']) }}
  </div>
  <div class="form-group col-md-4 col-lg-4 ">
    {{ Form::label('cms_pages_footer', 'Display At Footer') }}
    {{ Form::select('cms_pages_footer', ['1'=>'Yes','0'=>'No'],Request('cms_pages_footer'),['class'=>'form-control']) }}
  </div>
    <div class="form-group col-md-4 col-lg-4 ">
  {!! Form::label('show_hide', 'Show Hide: ', ['class' => ' control-label']) !!}

      {{ Form::select('show_hide', ['1'=>'Show','0'=>'Hide'],Request('show_hide'),['class'=>'form-control']) }}
      {!! $errors->first('show_hide', '<p class="help-block">:message</p>') !!}
  </div>
  <div class="form-group col-lg-3 col-md-3 col-sm-3">

  {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}
</div>
</div>
{{ Form::close() }}

@endsection
