<?php

namespace Database\Seeders;

use App\Models\EmergencyRequest;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmergencyRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        EmergencyRequest::create([
            'contacted_via' => 'message',
            'user_id' => '1'
        ]);
        EmergencyRequest::create([
            'contacted_via' => 'call',
            'user_id' => '1'
        ]);
        EmergencyRequest::create([
            'contacted_via' => 'call',
            'user_id' => '2'
        ]);
    }
}
