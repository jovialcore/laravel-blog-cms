@extends('layouts.app')

@section('content')
<div class="container">
     <div class="row">
          <div class="col">
            @if(Session::has('msg'))
            <div class="alert alert-success alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
              {{ Session('msg') }}
            </div>
            @endif

              @if(Session::has('del-msg'))
            <div class="alert alert-danger alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
              {{ Session('del-msg') }}
            </div>
            @endif

               @if(Session::has('update-msg'))
            <div class="alert alert-success alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
              {{ Session('update-msg') }}
            </div>
            @endif
          </div>
        </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header clearfix">
                  Posts -List
                  <a href="{{ route('posts.create') }}" class="btn btn-sm float-right" style="background: navy-blue"> Add New Post </a>
                </div>

                <div class="card-body">
                		 <table class="table table-bordered mb-0">
                          <thead>
                            <tr>
                                <th scope="col" width="60">#</th>
                                <th scope="col" >Name</th>
                                <th scope="col" width="200">Created By</th>
                                <th scope="col" width="129">Action</th>
                            </tr>
                          </thead>      
                            <tbody>
                            	@foreach($allPost as $post)
                                   <tr>
	                                  <td> {{ $post->id }} </td>
	                                  <td> {{ $post->title }} </td>
	                                  <td> {{ $post->user->name }} </td>
	                                  <td>
                                     <a href=" {{ route('posts.edit', $post->id) }}" class="btn btn-outline-dark text-dark btn-success btn-sm"> Edit</a>
                                        
                                     {!! Form::open(['route' => ['posts.destroy', $post->id], 'method' => 'delete', 'style'=> 'display:inline']) !!} 

                                     {!! Form::submit('Delete', ['class' => 'btn btn-sm btn-danger ']) !!}
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
