@extends('layouts.app')

@section('content')

<div class="container">

    {{--error zinute jeigu negalima istrinti--}}
    @if(session()->has('error_message'))
    <div class="alert alert-danger">
        {{session()->get("error_message")}}
    </div>
    @endif

    {{--sekmingo istrynimo zinute--}}
    @if(session()->has('success_message'))
    <div class="alert alert-success">
        {{session()->get("success_message")}}
    </div>
    @endif

    {{--MYGTUKU LAUKAS--}}
    <table>
        <tr>
        {{--SUKURIMO MYGTUKAS--}}
        <th>
            <form method="GET" action="{{route('category.create') }}">
                @csrf
                <button class="btn btn-success" type="submit">CREATE NEW CATEGORY</button>
            </form>
        </th>


        {{--POSTS MYGTUKAS--}}
        <th>
            <form method="GET" action="{{route('post.index') }}">
                @csrf
                <button class="btn btn-warning" type="submit">ALL POSTS LIST</button>
            </form>
        </th>

        </tr>
    </table>



    <table class="table table-striped">
        <tr>
            <th>@sortablelink('id', 'ID')</th>
            <th>@sortablelink('title', 'TITLE' )</th>
            <th>@sortablelink('excerpt','EXCERPT') </th>
            <th>@sortablelink('description', 'DESCRIPTION')</th>
            <th>@sortablelink('categoryPosts', 'TOTAL POSTS')</th>
            <th>ACTIONS</th>
        </tr>

        @foreach ($categories as $category)
            <tr>
                <td>{{$category->id}}</td>
                <td>{{$category->title}}</td>
                <td>{{$category->excerpt}}</td>
                <td>{{$category->description}}</td>
                <td>{{$category->categoryPosts->count()}} </td>
                <td>
                    <a href="{{route('category.show',[$category])}}" class="btn btn-primary">SHOW </a>

                    <a class="btn btn-info" href="{{route('category.edit', [$category]) }}">EDIT</a>

                    <form method="POST" action="{{route('category.destroy', [$category]) }}">

                        @csrf
                        <button class="btn btn-danger" type="submit">Delete</button>
                    </form>

                </td>
            </tr>
        @endforeach
    </table>

    {!! $categories->appends(Request::except('page'))->render() !!}

</div>



@endsection
