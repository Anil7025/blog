@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
                @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <div class="card">
                <div class="card-header">Profile</div>

                <div class="card-body">

                    <form method="POST" action="{{ url('addProfile') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Enter Name</label>

                            <div class="col-md-6">
                                <input id="text" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                                <label for="designation" class="col-md-4 col-form-label text-md-right">Designation</label>

                                <div class="col-md-6">
                                    <input id="text" type="text" class="form-control{{ $errors->has('designation') ? ' is-invalid' : '' }}" name="designation" value="{{ old('designation') }}" required autofocus>

                                    @if ($errors->has('designation'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('designation') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                    <label for="profile_pic" class="col-md-4 col-form-label text-md-right">Profile_pic</label>

                                    <div class="col-md-6">
                                        <input id="text" type="file" class="form-control{{ $errors->has('profile_pic') ? ' is-invalid' : '' }}" name="profile_pic" value="{{ old('profile_pic') }}" required autofocus>

                                        @if ($errors->has('profile_pic'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('profile_pic') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Add Profile
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
