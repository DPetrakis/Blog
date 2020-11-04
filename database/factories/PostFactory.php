<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Post::class, function (Faker $faker) {
    
    $categories = App\Category::pluck('id')->toArray();
    $admins = App\Admin::pluck('id')->toArray();

    return [
        
        'title' => $faker->text(20),
        'description' => $faker->text(100),
        'image' => $faker->text(10),
        'category_id' => $faker->randomElement($categories),
        'admin_id' => $faker->randomElement($admins)
    ];
});
