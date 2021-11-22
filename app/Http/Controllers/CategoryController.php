<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $collumnName=$request->collumnname;
        $sortby=$request->sortby;

        if (!$collumnName && !$sortby) {
           $collumnName='id';
            $sortby='asc';
        }

        $categories=Category::orderBy( $collumnName, $sortby)->paginate(10);

        return view('category.index', ['categories'=>$categories, 'collumnName'=>$collumnName, 'sortby'=>$sortby]);

    }
        //$categories = Category::all();
        //return view('category.index', ['categories'=>$categories]);
        //}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("category.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $postsNew = $request->postsNew;

        $category = new Category;

        $category->title = $request->categoryTitle;
        $category->excerpt = $request->categoryExcerpt;
        $category->description = $request->categoryDescription;

        $category->save();

        $postsInputCount = count($request->postTitle);

        if($postsNew == "1") {

            for($i = 0 ; $i < $postsInputCount ; $i++) {
                $post = new Post;
                $post->title = $request->postTitle[$i];
                $post->excerpt = $request->postExcerpt[$i];
                $post->description = $request->postDescription[$i];
                $post->content = $request->postContent[$i];
                $post->category_id = $category->id;
                $post->save();
            }
        }
        return redirect()->route("category.index");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        $posts = $category->categoryPosts;
        $postsCount = $posts->count();

        return view("category.show",['category' => $category, 'posts'=>$posts, 'postsCount'=> $postsCount]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view("category.edit", ["category"=>$category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $validateVar = $request->validate([

            'title' => 'required|min:2|max:15|alpha',
            'excerpt' => 'required|min:2|max:15|alpha',

        ]);


        $category->title = $request->categoryTitle;
        $category->excerpt = $request->categoryExcerpt;
        $category->description = $request->categoryDescription;

        $category->save();


        return redirect()->route("category.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        // suskaiciuoja kiek knygu turi autorius
        $postsCount = $category->categoryPosts->count();

        // jeigu autorius turi bent viena knyga- turi neleisti istrinti
        if($postsCount!=0) {
            return redirect()->route("category.index")->with('error_message','The Category cannot be deleted because he has a post');
        }

        $category->delete();
        return redirect()->route("category.index")->with('success_message','The Category was successfully deleted');

    }
}
