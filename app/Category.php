<?php

namespace App;
use App\Post;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Category extends Model
{

    use Sortable;

    protected $table="categories";

    protected $fillable=["title", "excerpt", "description"];

    public $sortable= ["id", "title", "excerpt", "description"]; // galima pajungti ir posts


    public function categoryPosts() {
        return $this->hasMany(Post::class, 'category_id', 'id');
    }
}
