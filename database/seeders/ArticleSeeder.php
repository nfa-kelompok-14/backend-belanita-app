<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Article::create([
            'title' => 'Perempuan Cerdas Keuangan, Menuju Kesetaraan Finansial',
            'image' => 'image.jpg',
            'content' => 'Upaya mengangkat derajat kesetaraan ataupun emansipasi wanita masih menjadi topik yang selalu didengung-dengungkan di banyak ruang-ruang publik sampai saat ini.',
            'status' => 'published',
            'users_id' => 2
        ]);
    }
}
