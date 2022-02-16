<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Category;
use App\Models\Department;
use App\Models\Document;
use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});

$factory->define(Document::class, function (Faker $faker) {
    return [
        'document_title' => $faker->file('resources/js', 'public/assets/files', false),
        'category_id' => $faker->numberBetween(1,10),
        'department_id' => $faker->numberBetween(1,10),
        'document_file_path' => $faker->imageUrl(400,400,null,true),
    ];
});

$factory->define(Category::class, function (Faker $faker) {
    return [
        'category_name' => $faker->text(20),
    ];
});

$factory->define(Department::class, function (Faker $faker) {
    return [
        'department_name' => $faker->text(10),
    ];
});
