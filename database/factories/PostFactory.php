<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use App\Category;

use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title'=>$faker->sentence(1),
        'excerpt'=>$faker->sentence(2),
        'description'=>$faker->sentence(3),
        'content'=>$faker->sentence(1),
        'category_id'=>factory(Category::class)->create()->id,
        'created_at' => \Carbon\Carbon::now(),
        'updated_at' => \Carbon\Carbon::now(),
    ];
});
