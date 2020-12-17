@extends('layouts.app')

@section('stylesheet')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet"/>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Gallery- create</div>

                    <div class="card-body">
                        {!! Form::open(['route' => 'galleries.store', 'enctype' => 'multipart/form-data']) !!}
                        <div class="form-group @if($errors->has('image_url')) has-error @endif">
                            {!! Form::label('Image url', null, ['style' => 'display:block;']) !!}

                            {!! Form::file('image_url[]', ['multiple' => 'multiple']) !!}
                            @if ($errors->has('image_url'))
                                <span class="help-block">{!! $errors->has('image_url') !!}</span>@endif
                        </div>
                        {!! Form::submit('Upload',['class' => 'btn btn-sm btn-primary']) !!}
                    {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
            integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function () {
            CKEDITOR.replace('details');
        });
    </script>
@endsection
