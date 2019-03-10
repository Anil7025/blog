@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">View Post</div>

                <div class="card-body">
                    <div class="row">
                   <div class="col-md-4">
                       @if (count($categories)>0)
                           @foreach ($categories->all() as $category)
                                <ul class="list-group">
                                    <li class="list-group-item"><a href="{{ url('/category/'.$category->id) }}">{{ $category->category }}</a></li>
                                </ul>
                           @endforeach
                        @else
                        <P>Categories is not found</P>
                       @endif

                   </div>

                   <div class="col-md-8">
                        @if (count($posts) > 0)
                            @foreach ($posts->all() as $post)
                                <h4>{{ $post->post_title }}</h4>
                                <img src="{{ $post->post_image }}" alt="" style="width: 100%; height:300px">
                                <p>{{$post->post_body }}</p>
                                <ul class="nav nav-pills">
                                    <li role="presentation">
                                        <a href="{{ url('/like/'.$post->id) }}">Like</a>
                                    </li>
                                    <li class="ml-2" role="presentation">
                                        <a href="{{ url('/dislike/'.$post->id) }}">Dislike</a>
                                    </li>
                                    <li class="ml-2" role="presentation">
                                        <a href="{{ url('/comment/'.$post->id) }}">Comment</a>
                                    </li>
                                </ul>

                               @endforeach
                                @else
                                <p>This is not post Avalable</p>
                            @endif
                   </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
