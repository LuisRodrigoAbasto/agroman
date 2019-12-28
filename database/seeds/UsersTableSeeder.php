<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'=>'Soporte Sistemas',
            'email'=>'soporte.sistemas@ag.com.bo',
            'password'=>bcrypt('Sistemas1'),
            // 'password_office'=>'Sistemas123',
            // 'celular'=>'65067421',
            // 'celular_corto'=>'8009',
            // 'tipo'=>'ADMINISTRADOR',
            // 'estado'=>'1'
            ]);
    }
}
