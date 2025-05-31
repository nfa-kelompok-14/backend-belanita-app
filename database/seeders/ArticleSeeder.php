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
            'image' => 'article/article-1.jpg',
            'content' => 'Upaya mengangkat derajat kesetaraan ataupun emansipasi wanita masih menjadi topik yang selalu didengung-dengungkan di banyak ruang-ruang publik sampai saat ini.',
            'status' => 'published',
            'user_id' => 1
        ]);
        Article::create([
            'title' => 'Lorem ipsum dolor sit amet consectetur.', 
            'image' => 'article/article-2.jpg',
            'content' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Nisi pariatur eveniet perspiciatis modi facilis quos error cumque, asperiores omnis quae.',
            'status' => 'published',
            'user_id' => 2
        ]);
        Article::create([
            'title' => 'Perempuan Cerdas Keuangan, Menuju Kesetaraan Finansial',
            'image' => 'article/article-3.jpg',
            'content' => 'Upaya mengangkat derajat kesetaraan ataupun emansipasi wanita masih menjadi topik yang selalu didengung-dengungkan di banyak ruang-ruang publik sampai saat ini.',
            'status' => 'published',
            'user_id' => 3
        ]);
    }
}
