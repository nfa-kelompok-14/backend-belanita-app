<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MerchandiseOrder;
use App\Models\User;
use App\Models\Merchandise;

class MerchandiseOrderSeeder extends Seeder {
    
    public function run(): void {
        // Ambil user dan merchandise pertama (pastikan sudah ada di DB)
        $user = User::first();
        $merchandise = Merchandise::first();

        if (!$user || !$merchandise) {
            $this->command->warn('User atau Merchandise belum ada. Seeder MerchandiseOrder tidak dijalankan.');
            return;
        }

        // data dummy
        MerchandiseOrder::create([
            'quantity' => 2,
            'total_price' => $merchandise->price * 2,
            'status' => 'pending',
            'user_id' => $user->id,
            'merchandise_id' => $merchandise->id,
        ]);
    }
}
