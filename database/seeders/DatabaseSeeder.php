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
        // User::factory(10)->create();
        $this->call(CategorySeeder::class);
        $this->call(AccountSeeder::class);
        // Product::factory(10)->create();
        // Order::factory(10)->create();

        // OrderProduct::factory(20)->create();
        // $this->call(LaratrustSeeder::class);
        $this->call(RoleSeeder::class);
    }
}
