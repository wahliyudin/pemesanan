<?php

namespace Database\Seeders;

use App\Models\Account;
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
        $accounts = [
            [
                'code' => '100-110-1',
                'nama' => 'Bank BCA',
            ],
            [
                'code' => '100-110-2',
                'nama' => 'Kas',
            ],
        ];

        foreach ($accounts as $account) {
            Account::create($account);
        }
    }
}
