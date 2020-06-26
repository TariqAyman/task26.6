<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = \Faker\Factory::create();

        \App\User::create([
            'name' => $faker->name('male'),
            'email' => $faker->email,
            'password' => \Illuminate\Support\Facades\Hash::make('123456'),
        ]);
    }
}
