<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;

use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $postTitle = $request->postTitle; // pavadinimas
        $postCategory = $request->postCategory;

        $filterPosts = Post::all();
        $categories = Category::all();

        $collumnName=$request->collumnname;
        $sortby=$request->sortby;

        if (!$collumnName && !$sortby) {
           $collumnName='id';
            $sortby='asc';
        }

        $posts=Post::orderBy( $collumnName, $sortby)->paginate(5);

        if ($postCategory) {
            $posts = Post::sortable()->where('category_id', $postCategory)->paginate(10);
        }else {
            $posts = Post::sortable()->paginate(10);
        }

        return view('post.index', ['posts'=>$posts, 'postTitle'=>$postTitle, 'postCategory'=> $postCategory, 'categories'=>$categories, 'filterPosts'=>$filterPosts, 'sortby'=>$sortby]);
    }
        //$posts = Post::all();
        //return view('post.index',['posts'=> $posts]);
        //}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view("post.create", ['categories'=> $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $categoryNew = $request->categoryNew;

        if($categoryNew == "1") {
            $category = new Category;

            $category->title =  $request->categoryTitle;
            $category->excerpt = $request->categoryExcerpt;
            $category->description = $request->categoryDescription;

            $category->save();

            $categoryId = $category->id;
        } else {
            $categoryId = $request->postCategory;
        }


        $post = new Post;

        $post-> title = $request->postTitle;
        $post-> excerpt = $request->postExcerpt;
        $post->description = $request->postDescription;
        $post->content = $request->postContent;
        $post->category_id = $categoryId;

        $post->save();

        return redirect()->route('post.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        $categories=$post->postCategories;

        return view("post.show",["post"=>$post, "categories"=> $categories]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories=$post->postCategories;
        return view("post.edit", ["post"=>$post, "categories"=>$categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {

        // neveikia- sutvarkyti

        // $post-> title = $request->postTitle;
        // $post-> excerpt = $request->postExcerpt;
        // $post->description = $request->postDescription;
        // $post->content = $request->postContent;
        // $post->category_id= $request->postCategory;

        // $post->save();

        // return redirect()->route('post.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route("post.index")->with('success_message','The Post was successfully deleted');
    }

    public function destroyAjax(Post $post)
    {

        $category_id = $post->category_id;

        $post->delete();

        $postsLeft = Post::where('category_id', $category_id)->get() ;
        $postsCount = $postsLeft->count();


        $success = [
            "success" => "THE POST DELETED SUCCESSFULY",
            "postsCount" => $postsCount
        ];
        $success_json = response()->json($success);

        return $success_json;
    }
}
