@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col">
      @if(Session::has('msg'))

      <div class="alert alert-success alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
          {{ Session('msg')}}
      </div>

      @endif
    </div>
  </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Latest Categories</div>

                <div class="card-body">
                		 <table class="table table-bordered mb-0">
                          <thead>
                            <tr>
                                <th scope="col" width="60">#</th>
                                <th scope="col" width="60">Name</th>
                                <th scope="col" width="200">Created By</th>
                            </tr>
                          </thead>      
                            <tbody>
                            	@foreach($categories as $category)
                                   <tr>
	                                  <td> {{ $category->id }} </td>
	                                  <td> {{ $category->name }} </td>
	                                  <td> {{ $category->user->name }} </td>
	                                  <td></td>
                                  </tr>
                           		@endforeach
                            </tbody>
                       </table>
                </div>
            </div>

            <div class="card mt-4">
                <div class="card-header">Latest Post</div>
                <div class="card-body">
                		 <table class="table table-bordered mb-0">
                          <thead>
                            <tr>
                                <th scope="col" width="60">#</th>
                                <th scope="col" width="60">Title</th>
                                <th scope="col" width="200">Created By</th>
                            </tr>
                          </thead>      
                            <tbody>
                            	@foreach($posts as $post)
                                   <tr>
	                                  <td> {{ $post->id }} </td>
	                                  <td> {{ $post->title }} </td>
	                                  <td> {{ $post->user->name }} </td>
	                                  <td></td>
                                  </tr>
                           		@endforeach
                            </tbody>
                       </table>
                </div>
            </div>


            <div class="card mt-4">
                <div class="card-header">Latest Pages</div>
                <div class="card-body">
                		 <table class="table table-bordered mb-0">
                          <thead>
                            <tr>
                                <th scope="col" width="60">#</th>
                                <th scope="col" width="60">Title</th>
                                <th scope="col" width="200">Created By</th>
                            </tr>
                          </thead>      
                            <tbody>
                            	@foreach($pages as $page)
                                   <tr>
	                                  <td> {{ $page->id }} </td>
	                                  <td> {{ $page->name }} </td>
	                                  <td> {{ $page->user->name }} </td>
	                                  <td></td>
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
