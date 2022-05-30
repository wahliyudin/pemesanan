<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\OrderUser;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(CategorySeeder::class);
        $this->call(AccountSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(ProductSeeder::class);
    }
}
