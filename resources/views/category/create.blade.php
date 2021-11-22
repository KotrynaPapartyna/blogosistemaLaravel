@extends('layouts.app')

@section('content')

<div class="container">
    <form method="POST" action="{{ route('category.store') }}">
        @csrf

        {{-- KATEGORIJOS PAVADINIMAS--}}
        <div class="form-group row">
            <label for="categoryTitle" class="col-md-4 col-form-label text-md-right">{{ __('CATEGORY TITLE') }}</label>

            <div class="col-md-6">
                <input id="categoryTitle" type="text" class="form-control @error('categoryTitle') is-invalid @enderror" name="categoryTitle" >

                @error('categoryTitle')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        {{-- KATEGORIJOS MAZASIS APRASYMAS--}}
        <div class="form-group row">
            <label for="categoryExcerpt" class="col-md-4 col-form-label text-md-right">{{ __('CATEGORY EXCERPT') }}</label>

            <div class="col-md-6">
                <input id="categoryExcerpt" type="text" class="form-control @error('categoryExcerpt') is-invalid @enderror" name="categoryExcerpt">

                @error('categoryExcerpt')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        {{-- KATEGORIJOS APRASYMAS--}}
        <div class="form-group row">
            <label for="categoryDescription" class="col-md-4 col-form-label text-md-right">{{ __('CATEGORY DESCRIPTION') }}</label>

            <div class="col-md-6">
                <textarea id="categoryDescription" name="categoryDescription" class="summernote form-control @error('categoryDescription') is-invalid @enderror">

                </textarea>
                @error('categoryDescription')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>


        {{--MYGTUKAS DAUGIAU POSTU PRIDEJIMUI--}}
        <div class="form-group row">
            <div class="col-md-4">
            </div>
            <div class="col-md-4">
                <input type="checkbox" id="postsNew" name="postsNew" value="1" />
                <span>WHANT TO ADD MORE POST FOR CATEGORY?</span>
            </div>
        </div>

        {{-- naujo posto pridejimo templatet'as--}}
        <div class="posts-info d-none">
            <div class="form-group row">
                <div class="col-md-4">
                </div>
                <div class="col-md-6">
                    <button type="button" class="btn btn-success" id="add-more-posts">ADD MORE POSTS FOR CATEGORY</button>
                </div>
            </div>

            {{--tevinis elementas postams--}}
            <div class="post">
                {{--post title--}}
                <div class="form-group row">
                    <label for="postTitle" class="col-md-4 col-form-label text-md-right">{{ __('POST TITLE') }}</label>

                    <div class="col-md-6">
                        <input type="text" class="form-control" name="postTitle[]">
                    </div>
                </div>

                {{--post excerpt--}}
                <div class="form-group row">
                    <label for="postExcerpt" class="col-md-4 col-form-label text-md-right">{{ __('POST EXCERPT') }}</label>

                    <div class="col-md-6">
                        <input type="text" class="form-control" name="postExcerpt[]">
                    </div>
                </div>

                 {{--post DESCRIPTION--}}
                <div class="form-group row">
                    <label for="postDescription" class="col-md-4 col-form-label text-md-right">{{ __('POST DESCRIPTION') }}</label>
                    <div class="col-md-6">
                        <textarea name="postDescription[]" class="summernote form-control">
                        </textarea>
                    </div>
                </div>

                {{--post excerpt--}}
                <div class="form-group row">
                    <label for="postContent" class="col-md-4 col-form-label text-md-right">{{ __('POST CONTENT') }}</label>

                    <div class="col-md-6">
                        <input type="text" class="form-control" name="postContent[]">
                    </div>
                </div>
            </div>

        </div>

        <div class="form-group row mb-0">
            <div class="col-md-8 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    {{ __('Add') }}
                </button>
            </div>
        </div>
    </form>

    {{-- naujo posto sablonas--}}
    <div class="post-template d-none">
        <div class="post">

            {{--post title--}}
            <div class="form-group row">
                <label for="postTitle" class="col-md-4 col-form-label text-md-right">{{ __('POST TITLE') }}</label>

                <div class="col-md-4">
                    <input type="text" class="form-control" name="postTitle[]">
                </div>
            </div>

            {{--post excerpt--}}
            <div class="form-group row">
                <label for="postExcerpt" class="col-md-4 col-form-label text-md-right">{{ __('POST EXCERPT') }}</label>

                <div class="col-md-4">
                    <input type="text" class="form-control" name="postExcerpt[]">
                </div>

            {{--pridedama istrynimo mygtukas dizainiskai tinkamoje vietoje--}}
                <div class="col-md-2">
                    <button type="button" class="btn btn-danger removePost">REMOVE POST</button>
                </div>
            </div>

            {{--post description--}}
            <div class="form-group row">
                <label for="postDescription" class="col-md-4 col-form-label text-md-right">{{ __('POST DESCRIPTION') }}</label>
                <div class="col-md-4">
                    <textarea name="postDescription[]" class="summernote form-control">
                    </textarea>
                </div>
            </div>

            {{--post CONTENT--}}
            <div class="form-group row">
                <label for="postContent" class="col-md-4 col-form-label text-md-right">{{ __('POST CONTENT') }}</label>

                <div class="col-md-4">
                    <input type="text" class="form-control" name="postContent[]">
                </div>
            </div>

        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $("#postsNew").click(function() { // paspaudziamas mygtukas naujo posto sukurimui- atsiranda forma
            $(".posts-info").toggleClass("d-none"); // kol nepaspaustas- paslepiamas
        });
        $("#add-more-posts").click(function() {
            $(".posts-info").append($(".post-template").html()); // pridedami inputai- post ivedimui- paruosta forma
        })

        $(document).on("click", ".removePost", function() { // paspaudus forma panaikinama
            $(this).parents('.post').remove();
        });
    });
</script>


<script>
    $(document).ready(function() {
        $('.summernote').summernote();
    });
</script>

@endsection
