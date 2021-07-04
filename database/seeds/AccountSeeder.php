<?php

use App\Account;
use Illuminate\Database\Seeder;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //php artisan db:seed --class=AccountSeeder
        Account::create([
            'user_id' => 1,
            'social_reason' => "Razão Social",
            'fantasy_name' => "Nome FAntasia",
            'agency' => 1,
            'number' => 20211,
            'amount' => 500.0,
            'status' => 'accept',
            'digit' => 21,
            'type_account' => 'company',
        ]);
    }
}
