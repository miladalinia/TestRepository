<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Customer;
use App\Product;
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

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'user_id' => factory('App\User')->create()->id,
        'author' => $faker->name,
        'publisher' => $faker->name,
        'publish_year' => Str::random(4),
        'product_code' => $faker->numberBetween(0, 5),
        'type' => $faker->sentence,
        'category' => $faker->company,
        'weight' => $faker->numberBetween(0, 5),
        'price' => $faker->numberBetween(0, 5),
        'image' => url('https://via.placeholder.com/150'),
    ];
});

$factory->define(Customer::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'city' => $faker->city,
        'address' => $faker->address,
        'postal_code' => $faker->postcode,
        'country' => $faker->country
    ];
});
