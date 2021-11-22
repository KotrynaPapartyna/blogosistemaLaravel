@extends('layouts.app')


@section("content")
    <div class="container">


        @if ($errors->any())
            @foreach ($errors->all() as $error)
            <div class="alert alert-danger">
                <ul>
                    <li>{{$error}}</li>
                </ul>
            </div>
            @endforeach
        @endif


        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('EDIT/CHANGE INFORMATION ABOUT POST') }}</div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('post.update', [$post]) }}" enctype="multipart/form-data">
                            @csrf

                            {{--postTitle--}}
                            <div class="form-group row">
                                <label for="postTitle" class="col-md-4 col-form-label text-md-right">{{ __('POST TITLE') }}</label>

                                <div class="col-md-6">
                                    <input id="postTitle" type="text" class="form-control @error('postTitle') is-invalid @enderror" name="postTitle">

                                    @error('postTitle')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{--postExcerpt--}}
                            <div class="form-group row">
                                <label for="postExcerpt" class="col-md-4 col-form-label text-md-right">{{ __('POST EXCERPT') }}</label>

                                <div class="col-md-6">
                                    <input id="postExcerpt" type="text" class="form-control @error('postExcerpt') is-invalid @enderror" name="postExcerpt">

                                    @error('postExcerpt')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{--postDescription--}}
                            <div class="form-group row">
                                <label for="postDescription" class="col-md-4 col-form-label text-md-right">{{ __('POST DESCRIPTION') }}</label>

                                <div class="col-md-6">
                                    <textarea id="postDescription" name="postDescription" class="summernote form-control @error('postDescription') is-invalid @enderror">

                                    </textarea>
                                    @error('postDescription')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                           {{--postContent--}}
                            <div class="form-group row">
                                <label for="postContent" class="col-md-4 col-form-label text-md-right">{{ __('POST CONTENT') }}</label>

                                <div class="col-md-6">
                                    <input id="postContent" type="text" class="form-control @error('postContent') is-invalid @enderror" name="postContent">

                                    @error('postContent')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{--postCategory--}}
                            <div class="form-group row postCategory">
                                <label for="postCategory" class="col-md-4 col-form-label text-md-right">{{ __('CHOOSE EXISTING POST CATEGORY') }}</label>

                                <div class="col-md-6">

                                    <select id="postCategory" class="form-control @error('postCategory') is-invalid @enderror" name="postCategory">
                                        @foreach ($categories as $category)
                                            <option value="{{$category->id}}"> {{$category->title}}</option>
                                        @endforeach
                                    </select>
                                    @error('postCategory')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('SAVE') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</div>

<script>
    $(document).ready(function() {
    $('.summernote').summernote();
    });
</script>

@endsection
