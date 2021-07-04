<?php

use App\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //php artisan db:seed --class=AdminSeeder
        User::create([
            'name' => 'Adolfo Augusto',
            'email' => 'adolfoaugustor@gmail.com',
            'password' => bcrypt('augustod2'),
            'surname' => "Rodrigues",
            'cellphone' => '85997072316',
            'cpf_cnpj' => '86252555000146'
        ]);
    }
}
