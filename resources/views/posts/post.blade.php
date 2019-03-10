@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add Posts</div>

                <div class="card-body">
                        <form method="POST" action="{{ url('/addPost') }}" enctype="multipart/form-data">
                                @csrf

                                <div class="form-group row">
                                    <label for="post_title" class="col-md-4 col-form-label text-md-right">{{ __('Post Title') }}</label>

                                    <div class="col-md-6">
                                        <input id="post_title" type="text" class="form-control{{ $errors->has('post_title') ? ' is-invalid' : '' }}" name="post_title" value="{{ old('post_title') }}" required autofocus>

                                        @if ($errors->has('post_title'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('post_title') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="body" class="col-md-4 col-form-label text-md-right">{{ __('Post Body') }}</label>

                                    <div class="col-md-6">
                                        <textarea name="post_body" id="post_body" cols="30" rows="10" class="form-control{{ $errors->has('post_body') ? ' is-invalid' : '' }}" name="post_body" required>{{ old('post_body') }}</textarea>

                                        @if ($errors->has('post_body'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('post_body') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="category_id" class="col-md-4 col-form-label text-md-right">{{ __('Category') }}</label>

                                    <div class="col-md-6">
                                        <select id="category_id" type="text" class="form-control" name="category_id" required>
                                            <option value="">Select</option>
                                            @if (count($posts)>0)
                                                @foreach ($posts->all() as $post)
                                                    <option value="{{ $post->id }}">{{ $post->category }}</option>
                                                @endforeach
                                            @endif

                                        </select>

                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="post_image" class="col-md-4 col-form-label text-md-right">{{ __('Post Images') }}</label>

                                    <div class="col-md-6">
                                        <input id="post_image" type="file" class="form-control" name="post_image" required>
                                    </div>
                                </div>

                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            {{ __('Publish Post') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
