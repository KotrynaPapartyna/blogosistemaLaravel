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
            <form method="GET" action="{{route('post.create') }}">
                @csrf
                <button class="btn btn-success" type="submit">CREATE NEW POST</button>
            </form>
        </th>

        {{--CATEGORIES MYGTUKAS--}}
        <th>
            <form method="GET" action="{{route('category.index') }}">
                @csrf
                <button class="btn btn-warning" type="submit">ALL CATEGORIES LIST</button>
            </form>
        </th>

        {{--filtravimo mygtukas--}}
        <th>
            <form method="GET" action="{{route('post.index')}}">
                    @csrf
                    <select name="postCategory">
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}"> {{$category->postCategory}}</option>
                        @endforeach
                    </select>
                    <button type="submit">Filter</button>
            </form>
         </th>

        <th>
            <a href="{{route('post.index')}}" class="btn btn-info">CLEAR FILTER</a>
        </th>



        </tr>
    </table>



    <table class="table table-striped">
        <tr>
            <th>@sortablelink('id','ID')</th>
            <th>@sortablelink('title','TITLE')</th>
            <th>@sortablelink('excerpt','EXCERPT')</th>
            <th>@sortablelink('description','DESCRIPTION')</th>
            <th>@sortablelink('content','CONTENT')</th>
            <th>@sortablelink('category_id','CATEGORY')</th>
            <th>ACTIONS</th>
        </tr>


        @foreach ($posts as $post)
            <tr>
                <td>{{$post->id}}</td>
                <td>{{$post->title}}</td>
                <td>{{$post->excerpt}}</td>
                <td>{{$post->description}}</td>
                <td>{{$post->content}}</td>
                <td>{{$post->postCategory->title}}</td>

                <td>
                    <a href="{{route('post.show',[$post])}}" class="btn btn-primary">SHOW </a>

                    <a class="btn btn-info" href="{{route('post.edit', [$post]) }}">EDIT</a>

                    <form method="POST" action="{{route('post.destroy', [$post]) }}">

                        @csrf
                        <button class="btn btn-danger" type="submit">DELETE</button>
                    </form>

                </td>


            </tr>
        @endforeach

    </table>
    {!! $posts->appends(Request::except('page'))->render() !!}
</div>



@endsection
