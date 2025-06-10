<?php

namespace Database\Seeders;

use App\Models\Merchandise;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MerchandiseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Merchandise::create([
            'name' => 'T-shirt',
            'image' => 'merch/t-shirt.jpg',
            'description' => 'Kaos yang terbuat dari bahan katun berwarna ungu.',
            'price' => 35000,
            'stock' => 10,
            'merchandise_categories_id' => 1
        ]);
        Merchandise::create([
            'name' => 'Yellow Tumbler',
            'image' => 'merch/t-shirt.jpg',
            'description' => 'Tumbler berwarna kuning berukuran 600ml.',
            'price' => 90000,
            'stock' => 4,
            'merchandise_categories_id' => 4
        ]);
        Merchandise::create([
            'name' => 'Ribbon Keychain',
            'image' => 'merch/t-shirt.jpg',
            'description' => 'Gantungan pita berbahan akrilik cocok untuk aksesoris di berbagai fashion.',
            'price' => 25000,
            'stock' => 50,
            'merchandise_categories_id' => 2
        ]);
    }
}
