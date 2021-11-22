<?php

namespace App;
use App\Category;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Post extends Model
{
    use Sortable;

    protected $table="posts";

    protected $fillable=["title", "excerpt", "description"]; // kol kas nereikalingas

    public $sortable= ["id", "title", "excerpt", "description", "content", "categoryTitle", 'postCategory' ];

    public function postCategory() {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

}
