<?php

namespace Database\Seeders;

use App\Models\Merchandise;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MerchandiseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Merchandise::create([
            'name' => 'T-shirt',
            'image' => 'merch/t-shirt.jpg',
            'description' => 'Kaos yang terbuat dari bahan katun berwarna ungu.',
            'price' => 35000,
            'stock' => 10,
            'merchandise_categories_id' => 1
        ]);

        Merchandise::create([
            'name' => 'Keychain',
            'image' => 'merch/keychain.jpg',
            'description' => 'Gantungan kunci lucu dan unik.',
            'price' => 15000,
            'stock' => 20,
            'merchandise_categories_id' => 2
        ]);

        Merchandise::create([
            'name' => 'Notebook',
            'image' => 'merch/notebook.jpg',
            'description' => 'Buku catatan dengan desain menarik.',
            'price' => 25000,
            'stock' => 15,
            'merchandise_categories_id' => 3
        ]);
        
        Merchandise::create([
            'name' => 'Tumbler',
            'image' => 'merch/tumbler.jpg',
            'description' => 'Botol minum tahan panas dan dingin.',
            'price' => 55000,
            'stock' => 8,
            'merchandise_categories_id' => 4
        ]);

        Merchandise::create([
            'name' => 'Cushion',
            'image' => 'merch/cushion.jpg',
            'description' => 'Bantal hias lembut dan nyaman.',
            'price' => 60000,
            'stock' => 6,
            'merchandise_categories_id' => 5
        ]);
    }

}
