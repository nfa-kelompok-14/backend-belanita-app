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
            'date' => '2022-03-18',
            'phone' => '08137324',
            'image' => 'pengaduan/pengaduan-1.jpg',
            'status' => 'processed',
            'user_id' => 1
        ]);

        Complaint::create([
            'subject' => 'Tetangga Berisik',
            'description' => 'Tetangga memutar musik keras hingga tengah malam.',
            'location' => 'Bandung',
            'date' => '2022-04-05',
            'phone' => '08213456',
            'image' => 'pengaduan/pengaduan-2.jpg',
            'status' => 'pending',
            'user_id' => 1
        ]);

        Complaint::create([
            'subject' => 'Lampu Jalan Mati',
            'description' => 'Lampu jalan di depan rumah mati total, jalan jadi gelap dan rawan.',
            'location' => 'Surabaya',
            'date' => '2022-05-10',
            'phone' => '08129876',
            'image' => 'pengaduan/pengaduan-3.jpg',
            'status' => 'processed',
            'user_id' => 2
        ]);

        Complaint::create([
            'subject' => 'Sampah Menumpuk',
            'description' => 'Sampah di TPS RT 05 tidak diangkut selama seminggu.',
            'location' => 'Bekasi',
            'date' => '2022-06-12',
            'phone' => '08345678',
            'image' => 'pengaduan/pengaduan-4.jpg',
            'status' => 'completed',
            'user_id' => 1
        ]);

        Complaint::create([
            'subject' => 'Pohon Tumbang',
            'description' => 'Pohon besar di jalan utama tumbang dan menghalangi jalan.',
            'location' => 'Depok',
            'date' => '2022-07-20',
            'phone' => '08111222',
            'image' => 'pengaduan/pengaduan-5.jpg',
            'status' => 'pending',
            'user_id' => 2
        ]);

        Complaint::create([
            'subject' => 'Air PAM Mati',
            'description' => 'Air PAM tidak mengalir sejak 3 hari lalu.',
            'location' => 'Tangerang',
            'date' => '2022-08-15',
            'phone' => '08223344',
            'image' => 'pengaduan/pengaduan-6.jpg',
            'status' => 'processed',
            'user_id' => 1
        ]);
    }
}