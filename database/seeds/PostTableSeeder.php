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
        foreach (range(1,10) as $index) {
            $user = User::create([
                'name' => $faker->firstname,
                'lastname'=>$faker->lastName,
                'dni' => '123456780',
                'password'=>Hash::make('12345678'),
                'email' => $faker->unique()->freeEmail,
                'dni'   => rand ( 1000000, 9999999 )
            ]);
            DB::table('consumidores')->insert([
                'id_user' => $user->id,
            ]);
            $user->assignRole('consumidor');
        }
        foreach (range(1,10) as $index) {
            $user = User::create([
                'name' => $faker->firstname,
                'lastname'=>$faker->lastName,
                'dni' => '123456780',

                'password'=>Hash::make('12345678'),
                'email' => $faker->unique()->freeEmail,
                'dni'   =>rand ( 1000000, 9999999 )
            ]);
            DB::table('comerciantes')->insert([
                'id_user' => $user->id,
            ]);
            $user->assignRole('comerciante');
        }

        // USUARIO ADMINISTRADOR
        $user = User::create([
            'name' => $faker->firstname,
            'lastname'=>$faker->lastName,
            'dni' => '123456780',

            'password'=>Hash::make('12345678'),
            'email' => 'admin@admin.com',
            'dni'   =>rand ( 1000000, 9999999 )
        ]);
        $user->assignRole('administrador');

        // USUARIO COMERCIANTE
        $user_comerciante = User::create([
            'name' => $faker->firstname,
            'lastname'=>$faker->lastName,
            'dni' => '123456780',

            'password'=>Hash::make('12345678'),
            'email' => 'comerciante@comerciante.com',
            'dni'   =>rand ( 1000000, 9999999 )
        ]);
        $user_comerciante->assignRole('comerciante');

        // USUARIO CONSUMIDOR
        $user_consumidor = User::create([
            'name' => $faker->firstname,
            'lastname'=>$faker->lastName,
            'dni' => '123456780',

            'password'=>Hash::make('12345678'),
            'email' => 'consumidor@consumidor.com',
            'dni'   =>rand ( 1000000, 9999999 )
        ]);
        $user_consumidor->assignRole('consumidor');
    }
}
