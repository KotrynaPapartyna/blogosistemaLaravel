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
                    <div class="card-header">{{ __('EDIT/CHANGE INFORMATION ABOUT CATEGORY') }}</div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('category.update', [$category]) }}" enctype="multipart/form-data">
                            @csrf

                            {{--title--}}
                            <div class="form-group row">
                                <label for="categoryTitle" class="col-md-4 col-form-label text-md-right">{{ __('CATEGORY TITLE') }}</label>

                                <div class="col-md-6">
                                    <input id="categoryTitle" type="text" class="form-control @error('categoryTitle') is-invalid @enderror" name="categoryTitle" required>

                                    @error('categoryTitle')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{--excerpt--}}
                            <div class="form-group row">
                                <label for="excerpt" class="col-md-4 col-form-label text-md-right">{{ __('CATEGORY EXCERPT') }}</label>

                                <div class="col-md-6">
                                    <input id="excerpt" type="text" class="form-control @error('excerpt') is-invalid @enderror" name="excerpt" required>

                                    @error('excerpt')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{--descr--}}
                            <div class="form-group row">
                                <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('CATEGORY DESCRIPTION') }}</label>

                                <div class="col-md-6">
                                    <textarea id="description" name="categoryDescription" class="summernote form-control @error('description') is-invalid @enderror" required>

                                    </textarea>
                                    @error('description')
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
