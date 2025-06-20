<?php

namespace Database\Seeders;

use App\Models\Merchandise;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MerchandiseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Merchandise::create([
            'name' => 'Kaos Hitam XL',
            'slug' => Str::slug('Kaos Hitam XL'),
            'image' => 'merchandises/tshirt.png',
            'description' => 'Kaos yang terbuat dari bahan katun berwarna hitam. Cocok untuk aktivitas sehari-hari dan hangout.',
            'price' => 50000,
            'stock' => 20,
            'merchandise_category_id' => 1
        ]);

        Merchandise::create([
            'name' => 'Tumbler Pink',
            'slug' => Str::slug('Tumbler Pink'),
            'image' => 'merchandises/tumbler-pink.jpg',
            'description' => 'Tumbler berwarna pink berukuran 600ml. Dengan bahan BPA-Free dan tahan air panas juga dingin.',
            'price' => 100000,
            'stock' => 17,
            'merchandise_category_id' => 4
        ]);

        Merchandise::create([
            'name' => 'Smiley Keychain Acrilic',
            'slug' => Str::slug('Smiley Keychain Acrilic'),
            'image' => 'merchandises/smiley-keychain.jpg',
            'description' => 'Gantungan smiley berbahan akrilik cocok untuk aksesoris di berbagai fashion. Pita ini sudah sampai diajang pameran nasional',
            'price' => 20000,
            'stock' => 52,
            'merchandise_category_id' => 2
        ]);

        Merchandise::create([
            'name' => 'Words Keychain Kulit',
            'slug' => Str::slug('Words Keychain Kulit'),
            'image' => 'merchandises/words-keychain.jpg',
            'description' => 'Gantungan kunci dengan kata-kata motivasi dengan bahan kulit, cocok untuk gaya formal.',
            'price' => 15000,
            'stock' => 12,
            'merchandise_category_id' => 2
        ]);

        Merchandise::create([
            'name' => 'Notebook Kanvas Coklat',
            'slug' => Str::slug('Notebook Kanvas Coklat'),
            'image' => 'merchandises/notebook.jpg',
            'description' => 'Buku catatan dengan bahan kanvas berwarna coklat bertema vintage.',
            'price' => 45000,
            'stock' => 15,
            'merchandise_category_id' => 3
        ]);

        Merchandise::create([
            'name' => 'Flower Keychain Acrilic',
            'slug' => Str::slug('Flower Keychain Acrilic'),
            'image' => 'merchandises/flower-keychain.jpg',
            'description' => 'Gantungan kunci bunga asli yang dicetak akrilik dengan aksen kuning kehijauan.',
            'price' => 25000,
            'stock' => 8,
            'merchandise_category_id' => 2
        ]);

        Merchandise::create([
            'name' => 'Bantal Sofa The Future is Female',
            'slug' => Str::slug('Bantal Sofa The Future is Female'),
            'image' => 'merchandises/cushion.jpg',
            'description' => 'Bantal hias sofa yang lembut dan comfy seukuran 100x200cm.',
            'price' => 60000,
            'stock' => 6,
            'merchandise_category_id' => 5
        ]);

        Merchandise::create([
            'name' => 'Mug Custom Ukuran 100ml',
            'slug' => Str::slug('Mug Custom Ukuran 100ml'),
            'image' => 'merchandises/mug-custom.jpg',
            'description' => 'Mug berukuran 100ml yang bisa dikustomisasi dengan request.',
            'price' => 50000,
            'stock' => 10,
            'merchandise_category_id' => 4
        ]);

        Merchandise::create([
            'name' => 'Parfum Musk France 50ml',
            'slug' => Str::slug('Parfum Musk France 50ml'),
            'image' => 'merchandises/parfum-vante.jpg',
            'description' => 'Parfum dengan wangi musk yang diimport dari Perancis dengan Netto 50ml.',
            'price' => 120000,
            'stock' => 11,
            'merchandise_category_id' => 6
        ]);

        Merchandise::create([
            'name' => 'Topi Hijau Nature',
            'slug' => Str::slug('Topi Hijau Nature'),
            'image' => 'merchandises/topi-hijau.jpg',
            'description' => 'Penutup kepala anti panas terik matahari, warna hijau, dan adjustable.',
            'price' => 65500,
            'stock' => 24,
            'merchandise_category_id' => 1
        ]);
    }
}
