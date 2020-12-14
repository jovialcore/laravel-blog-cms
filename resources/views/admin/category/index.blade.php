@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header clearfix">
                  Category -List
                  <a href="{{ route('categories.create') }}" class="btn btn-sm float-right" style="background: navy-blue"> Add New category </a>
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
                            	@foreach($categories as $category)
                                   <tr>
	                                  <td> {{ $category->id }} </td>
	                                  <td> {{ $category->name }} </td>
	                                  <td> {{ $category->user->name }} </td>
	                                  <td>
                                     <a href=" {{ route('categories.edit', $category->id) }}" class="btn btn-outline-dark text-dark btn-primary"> Edit </a>

                                     {!! Form::open(['route' => ['categories.destroy', $category->id], 'method' => 'delete', 'style'=> 'display:inline']) !!} 

                                     {!! Form::submit('Delete', ['class' => 'btn btn-sm', 'style' => 'background-color:red']) !!}

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
