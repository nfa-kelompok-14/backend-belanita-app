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
            'user_id' => 2,
            'notification_status' => 'unread',
            'status' => 'in_progress',
        ]);

        EmergencyRequest::create([
            'contacted_via' => 'call',
            'user_id' => 2,
            'notification_status' => 'unread',
            'status' => 'in_progress',
        ]);

        EmergencyRequest::create([
            'contacted_via' => 'call',
            'user_id' => 3,
            'notification_status' => 'read',
            'status' => 'completed',
        ]);

        EmergencyRequest::create([
            'contacted_via' => 'message',
            'user_id' => 3,
            'notification_status' => 'read',
            'status' => 'completed',
        ]);
    }
}
