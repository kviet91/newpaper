@extends('pages.index')

@section('title', '|Home')

@section('stylesheet')
    <link href="{{ asset('css/style_home.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style_show_posts.css') }}" rel="stylesheet">
    <link href="{{ asset('bower_components/Font-Awesome/web-fonts-with-css/css/fontawesome-all.min.css') }}" rel="stylesheet">
@endsection

    
@section('content')
<div class="container">
    @foreach($categories as $category)
    <div class="row">
        <h1 class="category"><a href="{{ route('home.posts', ['id' => $category->id, 'slug' => str_slug($category->name)]) }}" >{{ $category->name }}</a></h1>
        <p class="sub_cat">
                @if($category->childrens->count() > 0 )
                <i class="fas fa-angle-double-right finger"></i>
            @foreach($category->childrens as $sub_cat)
                <a href="{{ route('home.posts', ['id' => $sub_cat->id, 'slug' => str_slug($sub_cat->name)]) }}" class="category">{{ $sub_cat->name }}</a>
            @endforeach
                @else
                @endif
        </p>
    </div>
    @if(isset($data[$category->id]))
        <div class="row">
            <div class="col-md-5 col-lg-5">
                <!-- artigo em destaque -->
                @foreach ($data1 as $key1 => $value1)

                    @if($value1 != null)
                        @if($key1 == $category->id)
                        <div class="row-post">
                            <div class="post">
                                <img src="{{ asset('/images/'.$value1->image) }}" alt="Notebook" style="width:100%; height:100%;"/>
                                <div class="content">
                                    <h6 class="title"><a href="{{ route('home.single', ['slug' => str_slug($value1->slug)]) }}">{{ substr(strip_tags($value1->title),0,20) }}{{ strlen(strip_tags($value1->title))>20 ? "..." : "" }}</a></h6>
                                    <h6>{{ $value1->created_at }}</h6>
                                    <p>{!! substr(strip_tags($value1->body), 0, 70) !!}{{ strlen(strip_tags($value1->body))>70 ? "..." : ""}}</p>

                                </div>
                            </div>
                        </div>
                        @else
                        @endif
                    @else
                    @endif
                @endforeach
                <!-- /.featured-article -->
            </div>
            <div class="col-md-7 col-lg-7  posts">
                <ul class="media-list main-list">
                    @foreach ($data as $key => $value)
                        @if($key == $category->id)
                            @foreach($value as $post)
                                <li class="media">
                                    <a class="pull-left" href="{{ route('home.single', ['slug' => str_slug($post->slug)]) }}">
                                    <img src="{{ \Storage::disk('img-post')->url($post->image) }}" alt="" class="media-object image">
                                    </a>
                                    <div class="">
                                        <h6 class="title-right"><a href="{{ route('home.single', ['slug' => str_slug($post->slug)]) }}">{{ substr(strip_tags($post->title),0,30) }}{{ strlen(strip_tags($post->title))>20 ? "..." : "" }}</a></h6>

                                        <h6>{{ $post->created_at }}</h6>
                                        <p class="by-author">{!! substr(strip_tags($post->body), 0, 70) !!}{{ strlen(strip_tags($post->body))>70 ? "..." : ""}}</p>

                                    </div>
                                </li>
                            @endforeach
                        @else
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
    <br>
    @include('pages.tag')
    {{-- <div class="row">
         <small>
            <span class="btn-group">
                @foreach($tagHomes as $tag)
                    <button class="btn btn-mini">{{ $tag->name }}</button>
                @endforeach
            </span>
        </small>
    </div> --}}
    <br>
    <br>
    @endforeach
    <div class="row">
        <div class="text-center">
                {!! $categories->links(); !!}
        </div>
    </div>
</div>
@endsection

