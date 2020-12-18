@extends('webapp.template.major')

@section('content')
<!-- Page Header -->
  <header class="masthead" style="background-image: url({{ asset('webapp/img/home-bg.jpg') }})">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="site-heading">
            <h1>Blog</h1>
            <span class="subheading mb-5">Welcome to the blog. Blog your life here!</span>
           <a href="{{ route('posts.index') }}"> <button class="btn btn-outline-primary btn-light">  Get started</button>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
          @foreach($thePosts as $posts)
        <div class="post-preview">
          <a href="{{ url('post/'. $posts->slug)}}">
            <h2 class="post-title">
                {{$posts->title}}
            </h2>
            <h3 class="post-subtitle">
              {{ $posts->sub_title}}
            </h3>
          </a>
          <p class="post-meta">Posted by
            <a href="#"> {{ $posts->user->name  }}</a>
           
            on {{ date('M d, Y', strtotime($posts->created_at )) }}

              @if(is_countable($posts->categories) && count($posts->categories) > 0)

              <span class="post-category">

                category:
                  @foreach($posts->categories as $cate)
                  <!--  the post related to this category should be written above-->
                    <a href="{{ url('category/'. $cate->slug) }}">
                     {{ $cate->name}}
                   </a>,
                  @endforeach
              </span>
                  @endif
          </p>
        </div>
        <hr>
      @endforeach
        <!-- Pager -->
        <div class="clearfix mt-4">

       {{ $thePosts->links() }}
          
        </div>
      </div>

        <div class="col-lg-4 col-md-4">
            <div class="category">
                <h2 class="category-title">Category</h2>
                <ul class="category-list">
                      @foreach($cat as $cats)
                        <li><a href="{{ url('category/'. $cats->slug) }}">{{ $cats->name }}</a></li>
                      @endforeach
                </ul>
            </div>
        </div>
    </div>
  </div>



  
@endsection()
