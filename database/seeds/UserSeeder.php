<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

use app\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
 
        // Creamos un bucle para cubrir 5 fabricantes:
        for ($i=0; $i<4; $i++)
        {
            // Cuando llamamos al método create del Modelo User 
            // se está creando una nueva fila en la tabla.
            App\User::create(
                [
                    'name'=>$faker->userName(),
                    'email'=>$faker->email(),
                    'password'=>$faker->password(),
                    'activity'=>$faker->word(),
                    'avatar'=>$faker->image($dir='/tmp', $width='150', $height='150', 'cats'),
                    'bio'=>$faker->realText(45), 
                    'member_since'=>$faker->date($format = 'Y-m-d', $max = 'now')
                ]
            );
        }
    }
}
