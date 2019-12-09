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
        ser::create([
            'name'=>'Soporte Sistemas',
            'email'=>'soporte.sistemas@ag.com.bo',
            'password'=>bcrypt('12345678')
            ]);
    }
}
