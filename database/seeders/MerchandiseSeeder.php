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
            'image' => 'merch/tshirt.png',
            'description' => 'Kaos yang terbuat dari bahan katun berwarna hitam.',
            'price' => 35000,
            'stock' => 10,
            'merchandise_categories_id' => 1
        ]);
    }
}
