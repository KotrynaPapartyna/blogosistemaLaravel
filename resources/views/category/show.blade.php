@extends('layouts.app')

@section('content')

<div class="container container-show">

    <div class="card">
        <div class="card-body">
            <h2 class="card-title">{{$category->id}}. {{$category->title}}</h2>
            <p class="card-text">{{$category->excerpt}} </p>
            <p class="card-text">{{$category->description }} </p>
        </div>
    </div>


    @if ($postsCount != 0)
        <h3 class="posts-list">POSTS LIST</h3>

        <table class="posts table table-striped">
            <tr>
                <th>ID</th>
                <th>TITLE</th>
                <th>EXCERPT</th>
                <th>DESCRIPTION</th>
                <th>CONTENT</th>
                <th>Actions</th>
            </tr>

            @foreach ($posts as $post)

            <tr class="post">
                <td>{{$post->id}}</td>
                <td>{{$post->title}}</td>
                <td>{{$post->excerpt}}</td>
                <td>{{$post->description}}</td>
                <td>{{$post->content}}</td>

                <td>
                    <form method="POST" action="{{route('post.destroy',[$post])}}">
                        @csrf
                        <button type="submit" class="btn btn-primary">DELETE POST</button>
                    </form>

                    <button class="btn btn-danger postDelete" data-postid="{{$post->id}}">DELETE POST WITH AJAX</button>
                </td>
            </tr>
            @endforeach
        </table>

    @else
        <div class="alert alert-danger">
            <p>CATEGORY HAS NO POSTS</p>
        </div>
    @endif

</div>

<script>
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content') // formos apsauga
        }
    });


    $(document).ready(function() {
        $(".postDelete").click(function() {
            var postID = $(this).attr("data-postid");
            $(this).parents(".post").remove();

            $.ajax({
                type: 'POST',
                url: '/posts/deleteAjax/' + postID ,
                success: function(data) {
                    alert(data.success);
                    //console.log(data.clientsCount);
                    if(data.postsCount == 0) {
                        $(".posts").remove();
                        $(".posts-list").remove();
                        $(".container-show").append("<div class='alert alert-danger'><p>CATEGORY HAS NO POSTS</p></div> ")
                        //
                    }
                }
            });
        });
    });
</script>

@endsection
