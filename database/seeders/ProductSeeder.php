<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            [
                'nama' => "Mie Jablay Lv1 - 3",
                'keterangan' => "Mie dengan bumbu khas mie jablay dengan sensasi pedas di setiap gigitannya",
                'harga' => 15_000,
                'photo' => 'http://restaurant.loc/storage/thumbnail/1653875866.jpeg',
                'category_id' => 1
            ],
            [
                'nama' => "Mie Jablay Lv4 - 5",
                'keterangan' => "Mie dengan bumbu khas mie jablay dengan sensasi pedas di setiap gigitannya",
                'harga' => 15_000,
                'photo' => 'http://restaurant.loc/storage/thumbnail/1653875879.jpeg',
                'category_id' => 1
            ],
            [
                'nama' => "Mie Pnis (Pedas Manis) Lv1 - 3",
                'keterangan' => "Mie dengan bumbu khas mie Jablay dengan sensasi pedas tetapi ada manis-manisnya",
                'harga' => 15_000,
                'photo' => 'http://restaurant.loc/storage/thumbnail/1653875892.jpeg',
                'category_id' => 1
            ],
            [
                'nama' => "Mie Pnis (Pedas Manis) Lv4 - 5",
                'keterangan' => "Mie dengan bumbu khas mie Jablay dengan sensasi pedas tetapi ada manis-manisnya",
                'harga' => 15_000,
                'photo' => 'http://restaurant.loc/storage/thumbnail/1653875906.jpeg',
                'category_id' => 1
            ],
            [
                'nama' => "Mie Docil (Duo Chilie)",
                'keterangan' => "Mie dengan bumbu khas mie Jablay",
                'harga' => 15_000,
                'photo' => 'http://restaurant.loc/storage/thumbnail/1653875917.jpeg',
                'category_id' => 1
            ],
            [
                'nama' => "Siomay Goreng Ayam",
                'keterangan' => "Siomay dengan bumbu khas mie Jablay",
                'harga' => 11_000,
                'photo' => 'http://restaurant.loc/storage/thumbnail/1653875846.jpeg',
                'category_id' => 2
            ],
            [
                'nama' => "Siomay Goreng Udang",
                'keterangan' => "Siomay dengan bumbu khas mie Jablay",
                'harga' => 11_000,
                'photo' => 'http://restaurant.loc/storage/thumbnail/1653875931.jpeg',
                'category_id' => 2
            ],
            [
                'nama' => "Siomay Goreng Mozzarella",
                'keterangan' => "Siomay dengan bumbu khas mie Jablay",
                'harga' => 11_000,
                'photo' => 'http://restaurant.loc/storage/thumbnail/1653875945.jpeg',
                'category_id' => 2
            ],
            [
                'nama' => "Ebi Furai",
                'keterangan' => "Ebi dengan bumbu khas mie Jablay",
                'harga' => 15_000,
                'photo' => 'http://restaurant.loc/storage/thumbnail/1653875955.jpeg',
                'category_id' => 2
            ],
            [
                'nama' => "Egg Roll",
                'keterangan' => "Egg Roll dengan bumbu khas mie Jablay",
                'harga' => 15_000,
                'photo' => 'http://restaurant.loc/storage/thumbnail/1653875975.jpeg',
                'category_id' => 2
            ],
            [
                'nama' => "Ekado",
                'keterangan' => "Ekado dengan bumbu khas mie Jablay",
                'harga' => 15_000,
                'photo' => 'http://restaurant.loc/storage/thumbnail/1653875988.jpeg',
                'category_id' => 2
            ],
            [
                'nama' => "Siomay Kukus Ayam",
                'keterangan' => "Siomay Kukus Ayam dengan bumbu khas mie Jablay",
                'harga' => 11_000,
                'photo' => 'http://restaurant.loc/storage/thumbnail/1653876001.jpeg',
                'category_id' => 3
            ],
            [
                'nama' => "Siomay Kukus Udang",
                'keterangan' => "Siomay Kukus Udang dengan bumbu khas mie Jablay",
                'harga' => 11_000,
                'photo' => 'http://restaurant.loc/storage/thumbnail/1653876017.jpeg',
                'category_id' => 3
            ],
            [
                'nama' => "Siomay Kukus Mozzarella",
                'keterangan' => "Siomay Kukus Mozzarella dengan bumbu khas mie Jablay",
                'harga' => 11_000,
                'photo' => 'http://restaurant.loc/storage/thumbnail/1653876031.jpeg',
                'category_id' => 3
            ],
            [
                'nama' => "Mineral Water",
                'keterangan' => "Mineral Water dengan bumbu khas mie Jablay",
                'harga' => 5_000,
                'photo' => 'http://restaurant.loc/storage/thumbnail/1653876044.jpeg',
                'category_id' => 4
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
