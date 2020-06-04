<?php

use Illuminate\Database\Seeder;
use App\User;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            ['name' => 'administrador','guard_name' =>'web'],
            ['name' => 'consumidor','guard_name' =>'web'],
            ['name' => 'comerciante','guard_name' =>'web'],
        ]);

        $faker= Faker::create();
        foreach (range(1,100) as $index) {
            $user = User::create([
                'name' => $faker->firstname,
                'lastname'=>$faker->lastName,
                'password'=>Hash::make('12345678'),
                'email' => $faker->unique()->freeEmail,
            ]);
            DB::table('consumidores')->insert([
                'id_user' => $user->id,
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
            DB::table('comerciantes')->insert([
                'id_user' => $user->id,
            ]);
            $user->assignRole('comerciante');
        }
    }
}