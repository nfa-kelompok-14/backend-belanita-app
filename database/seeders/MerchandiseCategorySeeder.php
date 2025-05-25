<?php

namespace Database\Seeders;

use App\Models\MerchandiseCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MerchandiseCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MerchandiseCategory::create([
            'name' => 'Apparel'
        ]);

        MerchandiseCategory::create([
            'name' => 'Accessories'
        ]);

        MerchandiseCategory::create([
            'name' => 'Stationery'
        ]);

        MerchandiseCategory::create([
            'name' => 'Drinkware/Kitchenware'
        ]);

        MerchandiseCategory::create([
            'name' => 'Home & Living'
        ]);
    }
}
