@extends('layouts.app')

@section('content')


<div class="container">

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('INFORMATION ABOUT POST') }}</div>

                <div class="card-body">

                    <div class="form-group row">
                        <label for="post_id" class="col-sm-3 col-form-label" >{{ __('POST ID') }}</label>
                    <div class="col-md-6">
                            <p>{{$post->id}}</p>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="postTitle" class="col-sm-3 col-form-label" >{{ __('POST TITLE') }}</label>
                        <div class="col-md-6">
                            <p>{{$post->title}}</p>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="postExcerpt" class="col-sm-3 col-form-label" >{{ __('POST EXCERPT') }}</label>
                        <div class="col-md-6">
                            <p>{{$post->excerpt}}</p>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="postDescription" class="col-sm-3 col-form-label" >{{ __('POST DESCRIPTION') }}</label>
                        <div class="col-md-6">
                            <p>{{$post->description}}</p>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="postContent" class="col-sm-3 col-form-label" >{{ __('POST CONTENT')}}</label>
                        <div class="col-md-6">
                            <p>{{$post->content}}</p>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="category_id" class="col-sm-3 col-form-label" >{{ __('CATEGORY TITLE')}}</label>
                        <div class="col-md-6">
                            <p>{{$post->postCategory->title}}</p>
                        </div>
                    </div>


                    {{--gryzimas i visa sarasa --}}
                    <a class="btn btn-info" href="{{route('post.index') }}">BACK TO POSTS LIST</a>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
