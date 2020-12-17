@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                @if(Session::has('msg'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {{Session('msg')}}
                    </div>
                @endif

                @if(Session::has('del-msg'))
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        {{Session('del-msg')}}
                    </div>
                @endif
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Gallery - list
                        <a href="{{ route('galleries.create') }}" class="btn btn-sm btn-primary float-right">Add
                            New</a>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered mb-0">
                            <thead>
                            <tr>
                                <th scope="col" width="60">#</th>
                                <th scope="col">url</th>
                                <th scope="col" width="200">Created By</th>
                                <th scope="col" width="129">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($galleries as $gallery)
                                <tr>
                                    <th scope="row">{{ $gallery->id }}</th>
                                    <td>{{ asset('storage/galleries/'. $gallery->image_url)}}</td>
                                    <td>{{ $gallery->user->name }}</td>
                                    <td>
                                      
                                        {!! Form::open(['route' => ['galleries.destroy', $gallery->id], 'method' => 'delete', 'style' => 'display:inline']) !!}
                                        {!! Form::submit('Delete',['class' => 'btn btn-block btn-danger']) !!}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
