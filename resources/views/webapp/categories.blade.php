@extends('webapp.template.major')

@section('content')


<!-- Page $categoryHeader -->
  <header class="masthead" style="background-image: url({{ $category->thumbnail }})">
    <div class="overlay"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
          <div class="site-heading">
            <h1>{{ $category->name }}</h1>
          </div>
        </div>
      </div>
    </div>
  </header>

  <!-- Main Content -->
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-md-10 mx-auto">
          @foreach($postsRelatedToCatgories as $pRTC)
        <div class="post-preview">
          <a href="{{ url('post/'. $pRTC->slug)}}">
            <h2 class="post-title">
                {{$pRTC->title}}
            </h2>
            <h3 class="post-subtitle">
              {{ $pRTC->sub_title}}
            </h3>
          </a>
          <p class="post-meta">Posted by
            <a href="#"> {{ $pRTC->user->name  }}</a>
           
            on {{ date('M d, Y', strtotime($pRTC->created_at )) }}

              @if(is_countable($pRTC->categories) && count($pRTC->categories) > 0)

              <span class="post-category">

                category:
                  @foreach($pRTC->categories as $cate)
                  <!--  the post related to this category should be written above-->
                    <a href="{{ url('category/'.$cate->slug) }}">
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

       {{ $postsRelatedToCatgories->links() }}
          
        </div>
      </div>

     
    </div>
  </div>

@endsection()