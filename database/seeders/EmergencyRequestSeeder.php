<?php

namespace Database\Seeders;

use App\Models\EmergencyRequest;
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
            'user_id' => 1,
            'lat' => -6.2000000,
            'long' => 106.8166667,
            'notification_status' => 'pending',
        ]);

        EmergencyRequest::create([
            'contacted_via' => 'call',
            'user_id' => 1,
            'lat' => -6.2100000,
            'long' => 106.8200000,
            'notification_status' => 'notified',
        ]);

        EmergencyRequest::create([
            'contacted_via' => 'call',
            'user_id' => 2,
            'lat' => -6.2200000,
            'long' => 106.8300000,
            'notification_status' => 'resolved',
        ]);
    }
}