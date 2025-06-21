<?php

namespace Database\Seeders;

use App\Models\MerchandiseOrder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MerchandiseOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MerchandiseOrder::create([
            'order_number' => 'ORD-0001',
            'total_price' => 50000,
            'status' => 'paid',
            'quantity' => '1',
            'user_id' => 1,
            'merchandise_id' => 1
        ]);
    }
}
