<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $statuses = ['cont', 'emp', 'not_act'];
        $genders = ['male', 'female'];

        for ($i = 0; $i < 49; $i++) {
            DB::table('users')->insert([
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'gender' => $faker->randomElement($genders),
                'address' => $faker->address,
                'DOB' => $faker->date(),
                'dept_id' => $faker->numberBetween(1, 9),
                'status' => $faker->randomElement($statuses),
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password123'),                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        DB::table('users')->insert([
            'position' => 'admin',
            'first_name' => "Angga",
            'last_name' => "Dev",
            'gender' => "male",
            'address' => $faker->address,
            'DOB' => $faker->date(),
            'dept_id' => 3,
            'status' => $faker->randomElement($statuses),
            'email' => "angga@gmail.com",
            'password' => Hash::make('password123'),    
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
