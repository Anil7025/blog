@extends('layouts.app')
 <style>
     .avatar{
         border-radius: 100%;
         width: 150px;
         height: 150px;

     }
 </style>
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-4">
                            Dashboard
                        </div>
                        <div class="col-md-8">
                            <form action="{{ url('/search') }}" method="post">
                            @csrf
                                <div class="input-group">
                                    <input type="text" name="search" class="form-control" placeholder="search for...">
                                    <span class="input-group-btn">
                                        <button type="submit" class="btn btn-default">Go!</button>
                                    </span>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                   <div class="col-md-4">
                    @if (!empty($profile))
                        <img src="{{ $profile->profile_pic }}" class="avatar" alt="profile" >
                       @else
                        <img src="{{ url('images/avatar.png') }}" class="avatar" alt="profile" >
                    @endif
                    @if (!empty($profile))
                            <p class="lead">{{ $profile->name }}</p>
                        @else
                            <p></p>
                    @endif
                    @if (!empty($profile))
                            <p class="lead">{{ $profile->designation }}</p>
                        @else
                            <p></p>
                    @endif
                   </div>

                   <div class="col-md-8">
                        @if (count($posts) > 0)
                            @foreach ($posts->all() as $post)
                                <h4>{{ $post->post_title }}</h4>
                                <img src="{{ $post->post_image }}" alt="" style="width: 100%; height:300px">
                                <p>{{ substr($post->post_body, 0, 150) }}</p>
                                <ul class="nav nav-pills">
                                    <li role="presentation">
                                        <a href="{{ url('/view/'.$post->id) }}">View</a>
                                    </li>
                                    <li class="ml-2" role="presentation">
                                        <a href="{{ url('/edit/'.$post->id) }}">Edit</a>
                                    </li>
                                    <li class="ml-2" role="presentation">
                                        <a href="{{ url('/deletePost/'.$post->id) }}">Delete</a>
                                    </li>
                                </ul>
                                <city>Posted On : {{ date('M D , Y : H . I',strToTime($post->updated_at)) }}</city>
                                <hr/>
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
