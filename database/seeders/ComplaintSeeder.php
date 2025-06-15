<?php

namespace Database\Seeders;

use App\Models\Complaint;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ComplaintSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Complaint::create([
            'subject' => 'KDRT',
            'description' => 'KDRT yang dilakukan oleh kucing peliharaan dengan luka cakar sepanjang 10cm.',
            'location' => 'Jakarta',
            'image' => 'pengaduan/pengaduan-1.jpg',
            'status' => 'processed',
            'user_id' => 1
        ]);
    }
}
