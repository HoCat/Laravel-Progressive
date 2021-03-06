<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

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
//    return [
//        'username' => 'task',
//        'nickname' => 'task',
//        'education'=> 0,
//        'avatar' => '2019/09/17/20190917101457715060.jpeg',
//        'email' => $faker->unique()->safeEmail,
//        'last_token' => '12312.123123.123-123-123',
//        'password' => '$10$A.HHtNW/qtidz2IBLXtR9.qVzHnUtfyDU2mxS.XK96KXQjylLDvGu', // password
//        'created_at' => now(),
//        'updated_at' => now(),
//    ];
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$10$Jj8B6kLc88XxYxSPvuBhLe5Se8SY64QICGfKYm7AAQByiZ8XZrHi6', // password
        'remember_token' => Str::random(10),
    ];
});
