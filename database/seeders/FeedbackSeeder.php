<?php

namespace Database\Seeders;

use App\Models\Complaint;
use App\Models\Feedback;
use App\Models\User;
use Illuminate\Database\Seeder;

class FeedbackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::where('role', 'admin')->first();

        if (!$admin) {
            $this->command->warn('No admin found, skipping FeedbackSeeder.');
            return;
        }

        $complaints = Complaint::all();

        foreach ($complaints as $complaint) {
            Feedback::create([
                'user_id' => $admin->id,
                'complaint_id' => $complaint->id,
                'message' => 'Terima kasih atas pengaduannya. Kami sedang memprosesnya.'
            ]);
        }

    }
}