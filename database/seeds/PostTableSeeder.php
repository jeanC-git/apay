<?php

use Illuminate\Database\Seeder;
use App\User;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;
class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker= Faker::create();
        foreach (range(1,100) as $index) {
            $user = User::create([
                'name' => $faker->firstname,
                'lastname'=>$faker->lastName,
                'password'=>Hash::make('12345678'),
                'email' => $faker->unique()->freeEmail,
            ]);
            $user->assignRole('consumidor');
        }
        $user = User::create([
            'name' => $faker->firstname,
            'lastname'=>$faker->lastName,
            'password'=>Hash::make('12345678'),
            'email' => 'admin@admin.com',
        ]);
        $user->assignRole('administrador');

        foreach (range(1,100) as $index) {
            $user = User::create([
                'name' => $faker->firstname,
                'lastname'=>$faker->lastName,
                'password'=>Hash::make('12345678'),
                'email' => $faker->unique()->freeEmail,
            ]);
            $user->assignRole('comerciante');
        }
    }
}