@extends('backend.layouts.inner')
@section('title')
Create new Gst
@stop

@section('content')

    {!! Form::open(['url' => 'admin/gst', 'class' => 'form-horizontal']) !!}

    <div class="form-group {{ $errors->has('gst_name') ? 'has-error' : ''}}">
    {!! Form::label('gst_name', 'Name: ', ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-6">
        {!! Form::text('gst_name', null, ['class' => 'form-control']) !!}
        {!! $errors->first('gst_name', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group {{ $errors->has('gst_percent') ? 'has-error' : ''}}">
    {!! Form::label('gst_percent', 'GST Percent (%): ', ['class' => 'col-sm-3 control-label']) !!}
    <div class="col-sm-6">
        {!! Form::number('gst_percent', null, ['class' => 'form-control']) !!}
        {!! $errors->first('gst_percent', '<p class="help-block">:message</p>') !!}
    </div>
</div>


    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-3">
            {!! Form::submit('Create', ['class' => 'btn btn-primary form-control']) !!}
        </div>
    </div>
    {!! Form::close() !!}

@endsection
